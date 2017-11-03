@extends('admin.layouts.admin')

@section('title', '添加医院')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加医院</h3>
                    <a href="{{url('admin/hospitalInfo')}}" class='btn btn-default btn-xs pull-right'>返回上页</a>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ url('adminApi/hospital/create') }}" method="POST">
                        @include('admin.hospital._formadd', ['form_type' => 'create'])

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">创建</button>
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