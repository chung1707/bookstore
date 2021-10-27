@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Danh sách Admin</h1>
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách tài khoản admin --</h3>
                    @if (!isset($search))
                    <h4 class="card-title">
                        Trang: {{ $admins->currentPage() }} / {{$admins->lastPage()}}
                    </h4>
                    @endif
                    <div class="card-tools">
                        <form action="{{ route('admin.admin_accounts') }}" method="get">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="tableSearch" class="form-control float-right" placeholder="Search" value="@if (isset($search)){{ $search }} @endif"/>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
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
                                <td><a href="{{ route('admin.showUser',['user' =>$admin]) }}"  class="btn btn-info">Xem chi tiết</a></td>
                                <td class="table__content">
                                    <delete :item="{{ json_encode($admin) }}" :link="{{json_encode($linkDelete)}}"></delete>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (!isset($search))
                <div style="padding-top: 20px;
                            margin: 0px auto;">
                    {{ $admins->links() }}
                </div>
                @endif
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
