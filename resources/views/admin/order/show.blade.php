@extends('admin.layouts.admin')

@section('title', '订单详情')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">订单详情</h3>
                    <a href="{{url('admin/order')}}" class='btn btn-default btn-xs pull-right'>返回上页</a>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="introduction" class="col-md-3 control-label">his订单号</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> his_order_number }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">商户订单号</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> out_trade_no }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">总金额</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> total_fee    }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">实际支付金额</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> cash_fee }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">交易id</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> transaction_id }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="created_at" class="col-md-3 control-label">身份证号</label>
                            <div class="col-md-5">
                                <span class="form-control-show">{{ $info -> IDCardNo }}</span>
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