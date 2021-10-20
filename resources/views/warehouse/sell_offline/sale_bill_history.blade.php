@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Danh sách hóa đơn nhập</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách hóa đơn nhập --</h3>
                <h4 class="card-title">
                    Trang: {{ $saleBills->currentPage() }} / {{$saleBills->lastPage()}}
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
                            <th>Mã giao dịch</th>
                            <th>Người bán hàng</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Tổng giá</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saleBills as $saleBill)
                        <tr>
                            <td>{{ $saleBill->transaction_id }}</td>
                            <td>{{ $saleBill->user->name }}</td>
                            <td>{{ $saleBill->name }}</td>
                            <td>{{ $saleBill->phone }}</td>
                            <td>{{ $saleBill->totalPrice }}</td>
                            <td><a href="{{route('export_bill_show',[ 'bill'=>$saleBill ])}}" class="btn-flat btn-default btn-sm">Xem chi tiết</a></td>
                            <td class="table__content">
                                <form action="{{ route('export_bill_delete',['bill' => $saleBill]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn-flat btn-default btn-sm" type='submit'>Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding-top: 20px;
                            margin: 0px auto;">
                {{ $saleBills->links() }}
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
