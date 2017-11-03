@extends('admin.layouts.admin')

@section('title', '书籍列表')

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
                "sAjaxSource": "/adminApi/book",
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
                    [6]
                ],
                "aoColumns": [
                    { "data": "id" },
                    { "data": "name", "bSortable": false },
                    { "data": "author", "bSortable": false },
                    { "data": "publisher", "bSortable": false },
                    { "data": "version", "bSortable": false },
                    { "data": "class", "bSortable": false },
                    { "data": "updated_at" },
                    { "data": "id", "bSortable": false }
                ],
                "columnDefs" : [
                    //操作
                    {
                        "render" : function(data, type, row) {
                            var opt_html = '';
                            @if(adminAuth('admin.book.show'))
                                opt_html += "<a href='{{ url('admin/book') }}/"+data+"' class='X-Small btn-xs text-info'><i class='fa fa-send'></i> 详情</a>";
                            @endif
                            @if(adminAuth('admin.book.edit'))
                                opt_html += "<a href='{{ url('admin/book') }}/"+data+"/edit' class='X-Small btn-xs text-success'><i class='fa fa-edit'></i> 编辑</a>";
                            @endif
                            @if(adminAuth('admin.book.delete'))
                                opt_html += "<a href='javascript:;' onclick='delData("+data+")' class='X-Small btn-xs text-danger'><i class='fa fa-times-circle'></i> 删除</a>";
                            @endif
                            return opt_html;
                        },
                        "targets": 7
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
            fc_confirm("您要确认删除该书籍么?", function(){
                fc_ajax("/adminApi/book/"+id, {_method:'delete'}, 'post', 'json', function(res){
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
            <h3 class="box-title">书籍列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="7">
                        @if(adminAuth('admin.book.create'))
                            <a href="{{ url('admin/book/create') }}" class='btn btn-success btn-sm'>添加书籍</a>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>书籍名</th>
                    <th>作者</th>
                    <th>发行商</th>
                    <th>发行版本</th>
                    <th>类型</th>
                    <th>编辑时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>书籍名</th>
                    <th>作者</th>
                    <th>发行商</th>
                    <th>发行版本</th>
                    <th>类型</th>
                    <th>编辑时间</th>
                    <th>操作</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection