@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
    <h1>Đổi mật khẩu</h1>
@stop

@section('content')
<section class="content">
    <div class="container">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-8" style="margin: 0px auto;">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Đổi mật khẩu</h3>
                                </div>
                                    <admin-change-password :user="{{ json_encode(Auth::user()) }}"></admin-change-password>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@stop

@section('css')

@stop

@section('js')
@stop
