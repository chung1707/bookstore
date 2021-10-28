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
                @if (!isset($search))
                    <h4 class="card-title">
                        Trang: {{ $users->currentPage() }} / {{$users->lastPage()}}
                    </h4>
                @endif
                    <div class="card-tools">
                        <form action="{{ route('admin.user_accounts') }}" method="get">
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
                            <th>Xem chi tiết</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('admin.showUser',['user' =>$user]) }}" class="btn-flat btn-default btn-sm">Xem chi tiết</a></td>
                            <td>
                                <block-user :user="{{ json_encode($user) }}"></block-user>
                            </td>
                            <td class="table__content">
                                <delete :item="{{ json_encode($user) }}" :link="{{json_encode($linkDelete)}}"></delete>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!isset($search))
                <div style="padding-top: 20px;
                            margin: 0px auto;">
                    {{ $users->links() }}
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
