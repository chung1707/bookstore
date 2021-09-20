@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Danh sách người dùng</h1>
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách tài khoản admin --</h3>
                    <h4 class="card-title">

                        Trang: {{ $admins->currentPage() }} / {{$admins->lastPage()}}
                        <span> -- Tổng tài khoản admin: {{ count($admins)* $admins->lastPage()+1 }}</span>
                    </h4>
                    <div class="card-tools">
                        <div
                            class="input-group input-group-sm"
                            style="width: 150px;"
                        >
                            <input
                                type="text"
                                name="table_search"
                                class="form-control float-right"
                                placeholder="Search"
                            />

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>email</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <span class="tag tag-success"
                                        >Hoạt động</span
                                    >
                                </td>
                                <td>Xem chi tiết</td>
                                <td>Xóa</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding-top: 20px;
                            margin: 0px auto;">
                    {{ $admins->links() }}
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
@stop
