@extends('admin.layouts.admin')

@section('title', '微信公众号列表')

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
                "sAjaxSource": "/adminApi/preConfig",
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
                    [4]
                ],
                "aoColumns": [
                    { "data": "id" },
                    { "data": "encryptionvalue", "bSortable": false },
                    { "data": "apiurls", "bSortable": false },
                    { "data": "groups", "bSortable": false },
                    { "data": "actions", "bSortable": false },
                    { "data": "switch" , "bSortable": false},
                    { "data": "id", "bSortable": false }
                ],
                "columnDefs" : [

                    //操作
                    {
                        "render" : function(data, type, row) {
                         if(data==1){
                             return "开";
                         }else{
                             return "关";
                         }
                        },
                        "targets": 5
                    },
                    //操作
                    {
                        "render" : function(data, type, row) {
                            var opt_html = '';
                            {{--@if(adminAuth('admin.wechatConfig.show'))
                                    opt_html += "<a href='{{ url('admin/wechatConfig') }}/"+data+"' class='X-Small btn-xs text-info'><i class='fa fa-send'></i> 详情</a>";
                            @endif--}}
                            @if(adminAuth('admin.preConfig.edit'))
                                    opt_html += "<a href='{{ url('admin/preConfig') }}/"+data+"/edit' class='X-Small btn-xs text-success'><i class='fa fa-edit'></i> 编辑</a>";
                            @endif
                            {{--        @if(adminAuth('admin.wechatConfig.delete'))
                                    opt_html += "<a href='javascript:;' onclick='delData("+data+")' class='X-Small btn-xs text-danger'><i class='fa fa-times-circle'></i> 删除</a>";
                            @endif--}}
                            return opt_html;
                        },
                        "targets": 6
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
            fc_confirm("您要确认删除该公众号么?", function(){
                fc_ajax("/adminApi/wechatConfig/"+id, {_method:'delete'}, 'post', 'json', function(res){
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
            <h3 class="box-title">前置机列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="7">
                        {{--@if(adminAuth('admin.wechatConfig.create'))
                            <a href="{{ url('admin/wechatConfig/create') }}" class='btn btn-success btn-sm'>添加公众号</a>
                        @endif--}}
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>用户数据传输加密</th>
                    <th>前置机web地址</th>
                    <th>控制器</th>
                    <th>方法</th>
                    <th>开关</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>用户数据传输加密</th>
                    <th>前置机web地址</th>
                    <th>控制器</th>
                    <th>方法</th>
                    <th>开关</th>
                    <th>操作</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection