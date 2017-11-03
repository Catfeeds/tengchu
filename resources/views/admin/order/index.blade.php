@extends('admin.layouts.admin')

@section('title', '订单列表')

@section('css')
    <link rel="stylesheet" href="{{ asset('static/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('js')
    <script src="{{ asset('static/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        var dataTable = null;
        $(function(){

            //数据表格
            dataTable = $("#dataTable").DataTable({
                //配置
                "bServerSide": true,
                "bSort": true,
                "sAjaxSource": "/adminApi/order",
                "iDisplayLength": 10,
                "oLanguage": {
                    "sProcessing": "正在加载中...",
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "抱歉, 没有匹配的数据",
                    "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                    "sInfoEmpty": "没有数据",
                    "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
                    "sSearch": "搜索",
                    "sLengthMenu": "_MENU_ 页/条",
                    "oPaginate": {
                        "sFirst": "首页",
                        "sPrevious": "上一页",
                        "sNext": "下一页",
                        "sLast": "尾页"
                    },
                    "sZeroRecords": "没有检索到数据"
                },
                "aaSorting": [
                    [0, 'desc'],
                    [8]
                ],
                "aoColumns": [
                    { "data": "user_id" },
                    { "data": "type", "bSortable": false },
                    { "data": "cardId", "bSortable": false },
                    { "data": "updated_at", "bSortable": false },
                    { "data": "pay_type", "bSortable": false },
                    { "data": "state", "bSortable": false },
                    { "data": "out_trade_no", "bSortable": false },
                    { "data": "total_fee", "bSortable": false },
                    { "data": "states", "bSortable": false },
                    { "data": "cash_fees", "bSortable": false },
                    { "data": "user_id", "bSortable": false },

                ],
                "columnDefs" : [
                    //类型  1挂号，2支付宝，3银联
                    {
                        "render" : function(data, type, row) {
                            if (data == "1") {
                                return "挂号";
                            }else if(data == "2"){
                                return "缴费";
                            }else if(data == "3"){
                                return "住院";
                            }else{
                                return "";
                            }


                        },
                        "targets": 1
                    },
                    //支付方式  1微信,2支付宝,3银联,4其他支付方式
                    {
                        "render" : function(data, type, row) {
                            if (data == "1") {
                                return "微信";
                            }else if(data == "2"){
                                return "支付宝";
                            }else if(data == "3"){
                                return "银联";
                            }else {
                                return "其他支付方式";
                            }


                        },
                        "targets": 4
                    },
                    //状态  1未结算,2已结算,3已退费,4已取消
                    {
                        "render" : function(data, type, row) {
                            if (data == "1") {
                                return "未结算";
                            }else if(data == "2"){
                                return "已结算";
                            }else if(data == "3"){
                                return "已退费";
                            }else {
                                return "已取消";
                            }

                        },
                        "targets": 5
                    },
                    //状态  1未结算,2已结算,3已退费,4已取消
                    {
                        "render" : function(data, type, row) {
                            if (data == "1") {
                                return "是";
                            }else {
                                return "否";
                            }

                        },
                        "targets": 8
                    },
                    //操作
                    {
                        "render" : function(data, type, row) {
                            var opt_html = '';
                            @if(adminAuth('admin.order.show'))
                                opt_html += "<a href='{{ url('admin/order') }}/"+data+"' class='X-Small btn-xs text-info'><i class='fa fa-send'></i> 详情</a>";
                            @endif
                           {{--         @if(adminAuth('admin.doctor.edit'))
                                    opt_html += "<a href='{{ url('admin/doctor') }}/"+data+"/edit' class='X-Small btn-xs text-success'><i class='fa fa-edit'></i> 编辑</a>";
                            @endif--}}
                           {{--         @if(adminAuth('admin.doctor.delete'))
                                    opt_html += "<a href='javascript:;' onclick='delData("+data+")' class='X-Small btn-xs text-danger'><i class='fa fa-times-circle'></i> 删除</a>";
                            @endif--}}
                            return opt_html;
                        },
                        "targets": 10
                    }
                ],
            });

            dataTable.on('preXhr.dt', function () {
                loadShow();
            });
            dataTable.on('draw.dt', function () {
                loadShow(0);
            });
        })

        /**
         * 删除数据
         * @param $id
         */
        function delData(id)
        {
            id = parseInt(id);
            fc_confirm("您要确认删除该医生么?", function(){
                fc_ajax("/adminApi/doctor/"+id, {_method:'delete'}, 'post', 'json', function(res){
                    if(res.status == 'successful'){
                        //刷新数据
                        dataTable.ajax.reload();
                        fc_msg("删除成功!", 1);
                        return;
                    }
                    fc_msg(res.errors.message, 0);
                });
            });
        }
    </script>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">订单列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="7">
                        {{--@if(adminAuth('admin.doctor.create'))
                            <a href="{{ url('admin/doctor/create') }}" class='btn btn-success btn-sm'>添加医生</a>
                        @endif--}}
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>类型</th>
                    <th>就诊卡ID</th>
                    <th>更新时间</th>
                    <th>支付方式</th>
                    <th>状态</th>
                    <th>商户订单号</th>
                    <th>总金额</th>
                    <th>是否有退款</th>
                    <th>退款金额</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>类型</th>
                    <th>就诊卡ID</th>
                    <th>更新时间</th>
                    <th>支付方式</th>
                    <th>状态</th>
                    <th>商户订单号</th>
                    <th>总金额</th>
                    <th>是否有退款</th>
                    <th>退款金额</th>
                    <th>操作</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection