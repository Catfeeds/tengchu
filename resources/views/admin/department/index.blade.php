@extends('admin.layouts.admin')

@section('title', '科室列表')

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
                "dom": '<l<t>ip>',  //dom定位隐藏搜索框
                "bServerSide": true,
                "bSort": true,
                "sAjaxSource": "/adminApi/department",
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
                    [10]
                ],
                "aoColumns": [
                    { "data": "id" },

                    { "data": "deptName", "bSortable": false },
                    { "data": "districtId", "bSortable": false },
                    { "data": "deptIntro", "bSortable": false },
                    { "data": "deptIntroUrl", "bSortable": false },
                    { "data": "deptAddress", "bSortable": false },
                    { "data": "deptPosition", "bSortable": false },
                    { "data": "deptTel", "bSortable": false },
                    { "data": "name", "bSortable": false },
                    { "data": "deptSort", "bSortable": false },
                    { "data": "id", "bSortable": false },

                ],
                "columnDefs" : [
                    //操作
                    {
                        "render" : function(data, type, row) {
                            var opt_html = '';
                            {{--@if(adminAuth('admin.hospital.show'))
                                opt_html += "<a href='{{ url('admin/hospital') }}/"+data+"' class='X-Small btn-xs text-info'><i class='fa fa-send'></i> 详情</a>";
                            @endif--}}
                                    @if(adminAuth('admin.department.edit'))
                                    opt_html += "<a href='{{ url('admin/department') }}/"+data+"/edit' class='X-Small btn-xs text-success'><i class='fa fa-edit'></i> 编辑</a>";
                            @endif
                            {{--        @if(adminAuth('admin.department.delete'))
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
         * 自定义搜索
         */
        $(document).on("click","#btn_search",function(){
            //自己定义的搜索框，可以是时间控件，或者checkbox 等等

            var args1 = $("#deptName").val();
            var args2 = $("#hos_id").val();


            dataTable.search(args1+'/'+args2).draw();
            //dataTable.search(args1).draw(false);//保留分页，排序状态

        });


        /**
         * 删除数据
         * @param $id
         */
        function delData(id)
        {
            id = parseInt(id);
            fc_confirm("您要确认删除该科室么?", function(){
                fc_ajax("/adminApi/department/"+id, {_method:'delete'}, 'post', 'json', function(res){
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
            <h3 class="box-title">科室列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="7">
                        {{--@if(adminAuth('admin.department.create'))
                            <a href="{{ url('admin/department/create') }}" class='btn btn-success btn-sm'>添加科室</a>
                        @endif--}}

                        <div class="ibox-tools">

                            <label style="margin-left: 15px;">科室名称:</label><span style="margin-left: 10px;"><input id="deptName" type="search" value=""></span>
                            <label style="margin-left: 15px;">医院:</label><span style="margin-left: 10px;">
                                <select id="hos_id">
                                    <option value=""></option>
                                    @foreach($hospital as $key => $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach

                                </select>
                            </span>
                            <a class="btn btn-primary btn-sm" title='搜索' id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>部门名称</th>
                    <th>院区</th>
                    <th>科室介绍</th>
                    <th>科室url</th>
                    <th>科室地址</th>
                    <th>科室经纬度</th>
                    <th>科室电话</th>
                    <th>医院名称</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>

                    <th>部门名称</th>
                    <th>院区</th>
                    <th>科室介绍</th>
                    <th>科室url</th>
                    <th>科室地址</th>
                    <th>科室经纬度</th>
                    <th>科室电话</th>
                    <th>医院名称</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection