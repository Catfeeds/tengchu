@extends('admin.layouts.admin')

@section('title', '书籍详情')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">书籍详情</h3>
                    <a href="{{url('admin/book')}}" class='btn btn-default btn-xs pull-right'>返回上页</a>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="introduction" class="col-md-3 control-label">书籍名</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> name }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">作者</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> author }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">发行商</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> publisher    }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">发行版本</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> version }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">简介</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> intro }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="created_at" class="col-md-3 control-label">标签分类</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> class }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updated_at" class="col-md-3 control-label">接口数据</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> step     }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updated_at" class="col-md-3 control-label">创建时间</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> created_at }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updated_at" class="col-md-3 control-label">编辑时间</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> updated_at }}</span>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection