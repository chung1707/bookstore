@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Đơn hàng đã hủy</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách đơn đã hủy -- </h3>
                @if (!isset($search))
                <h4 class="card-title">
                    Trang: {{ $orders->currentPage() }} / {{$orders->lastPage()}}
                </h4>
                @endif
                <div class="card-tools">
                    <form action="{{ route('canceled_orders') }}" method="get">
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
                            <th>Thời gian tạo</th>
                            <th>Mã đơn hàng</th>
                            <th>Tổng tiền</th>
                            <th>Xem chi tiết</th>
                            <th colspan="2">Thao tác</th>
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
                                <delete :item="{{ json_encode($order) }}" :link="{{json_encode($linkDelete)}}"></delete>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!isset($search))
                <div style="padding-top: 20px;
                                margin: 0px auto;">
                {{ $orders->links() }}
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
