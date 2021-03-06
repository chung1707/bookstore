@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Chi tiết đơn hàng -- {{ $bill->transaction_id }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Ghi chú của đơn hàng:</h5>
                {{$bill->note}}
            </div>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-book"></i> Molla Book
                            <small class="float-right">Ngày lập: {{ $bill->created_at }}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Cửa hàng nhập sách
                        <address>
                            <strong>Molla Book</strong><br>
                            Số 1 Hà Nội<br>
                        </address>
                    </div>
                    <!-- /.col -->

                    <div class="col-sm-4 invoice-col">
                        <b>Người bán hàng: </b><br>
                        <b>Nhân viên: </b> {{$bill->user->name}}<br>
                        <b>email nhân viên:</b> {{$bill->user->email}}
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <b>Người mua hàng</b><br>
                        <b>Mã đơn hàng</b> {{$bill->transaction_id}}<br>
                        <b>Khác hàng: </b> {{$bill->name}}<br>
                        <b>Số điện thoại:</b> {{$bill->phone}}
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row" style="margin-top: 30px;">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá thành</th>
                                    <th>Tổng giá sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bill->books as $book)
                                <tr>
                                    @if(isset($book->thumbnails[0]))
                                    <td>
                                        <a href="#">
                                            <img src="{{ asset('storage/thumbnails/'.$book->thumbnails[0]->img) }}" alt="Banner" style="width:80px;">
                                        </a>
                                    </td>
                                    @else
                                    <td>

                                    </td>
                                    @endif
                                    <td>{{$book->book_code}}</td>
                                    <td>{{$book->name}}</td>
                                    <td>{{$book->pivot->quantity}}</td>
                                    <td>{{$book->pivot->price}} VNĐ</td>
                                    <td>{{$book->pivot->price * $book->pivot->quantity * ((100 - $book->pivot->discount)/100)}} VNĐ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Hóa đơn được in tại cửa hàng Molla Book</p>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        @isset($bill->discountCode->discount)
                                        <th style="width:50%">Giảm giá trên hóa đơn:</th>
                                        <td>{{$bill->discountCode->discount}} %</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <th>Tổng hóa đơn:</th>
                                        <td>{{ $bill->totalPrice }} VNĐ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-success float-right"><i class="fas fa-undo"></i>Quay lại
                        </a>
                        <print></print>
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
