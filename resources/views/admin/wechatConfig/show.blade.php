@extends('admin.layouts.admin')

@section('title', '公众号详情')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">公众号详情</h3>
                    <a href="{{url('admin/wechatConfig')}}" class='btn btn-default btn-xs pull-right'>返回上页</a>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="introduction" class="col-md-3 control-label">AppID</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> AppID }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">AppSecret</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> AppSecret }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">URL</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> URL }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Token</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> Token }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">EncodingAESKey</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> EncodingAESKey }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="created_at" class="col-md-3 control-label">创建时间</label>
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