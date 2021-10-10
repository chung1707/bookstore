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
                    Trang: {{ $importBills->currentPage() }} / {{$importBills->lastPage()}}
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
                                <form action="" method="post">
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
                {{ $importBills->links() }}
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
