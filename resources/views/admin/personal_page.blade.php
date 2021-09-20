@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Thông tin tài khoản</h1>
@stop

@section('content')
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/bookstore_img/products/product1.jpg')}}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

                        <p class="text-muted text-center">{{ auth()->user() ->role->name}}</p>
                        <a href="#" class="btn btn-primary btn-block"><b>Cập nhập ảnh đại diện</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin cá nhân</h3>
                                </div>
                                    <account-infos :user="{{ json_encode(Auth::user()) }}"></account-infos>
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
<script src="{{ asset('js/app.js') }}"></script>
@stop
