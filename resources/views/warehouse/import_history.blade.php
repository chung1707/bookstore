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
                @if (!isset($search))
                <h4 class="card-title">
                    Trang: {{ $importBills->currentPage() }} / {{$importBills->lastPage()}}
                </h4>
                @endif
                <div class="card-tools">
                    <form action="{{ route('import_bills.index') }}" method="get">
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
                            <th>Mã giao dịch</th>
                            <th>Người nhập</th>
                            <th>Nhà cung cấp</th>
                            <th>Tổng giá</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($importBills as $importBill)
                        <tr>
                            <td>{{ $importBill->transaction_id }}</td>
                            <td>{{ $importBill->user->name }}</td>
                            <td>{{ $importBill->supplier->name }}</td>
                            <td>{{ $importBill->totalPrice }}</td>
                            <td><a href="{{ route('import_bills.show',['importBill' => $importBill]) }}" class="btn-flat btn-default btn-sm">Xem chi tiết</a></td>
                            <td>

                            </td>
                            <td class="table__content">
                                <delete :item="{{ json_encode($importBill) }}" :link="{{json_encode($linkDelete)}}"></delete>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!isset($search))
            <div style="padding-top: 20px;
                            margin: 0px auto;">
                {{ $importBills->links() }}
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
