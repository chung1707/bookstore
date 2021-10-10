@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Đơn hàng đang xử lý</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách đơn hàng đang được xử lý -- </h3>
                <h4 class="card-title">
                    Trang: {{ $orders->currentPage() }} / {{$orders->lastPage()}}
                </h4>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" />

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
                            <th>Thời gian tạo</th>
                            <th>Mã đơn hàng</th>
                            <th>Tổng tiền</th>
                            <th>Xem chi tiết</th>
                            <th colspan="3">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->transaction_id }}</td>
                            <td>{{ $order->totalPrice }}</td>
                            <td><a href="{{ route('order.show',['order' => $order]) }}" class="btn-flat btn-info btn-sm">Xem chi tiết</a></td>
                            <td class="table__content">
                                <form action="{{route('mark_delivered',['order' => $order])}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn-flat btn-secondary btn-sm" type='submit'>Đã giao hàng</button>
                                </form>
                            </td>
                            <td class="table__content">
                                <form action="{{route('mark_canceled',['order' => $order])}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn-flat btn-danger btn-sm" type='submit'>Hủy</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding-top: 20px;
                            margin: 0px auto;">
                {{ $orders->links() }}
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

@stop
