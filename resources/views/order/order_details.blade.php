@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Chi tiết đơn hàng -- {{ $order->transaction_id }}</h1>
@stop

@section('content')
<div class="container-fluid">
<div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Ghi chú của đơn hàng:</h5>
              {{$order->note}}
            </div>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-book"></i> Molla Book
                    <small class="float-right">Ngày lập: {{ $order->created_at }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Molla Book</strong><br>
                    Số 1 Hà Nội<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <h5>Người đặt hàng</h5>
                  <address>
                    <strong>{{$order->user->name}}</strong><br>
                    {{$order->dispatch}}<br>
                    {{$order->ward->name}} - {{$order->district->name}} - {{$order->province->name}}<br>
                    Số điện thoại: {{$order->phone_number}}<br>
                    Email: {{$order->user->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Nhà vận chuyển</b><br>
                  <b>Tên nhà vận chuyển</b> {{$order->transporter->name}}<br>
                  <b>Email: </b> {{$order->transporter->email}}<br>
                  <b>Số điện thoại:</b> {{$order->transporter->phone}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Ảnh</th>
                      <th>Mã sản phẩm</th>
                      <th>Tên sản phẩm</th>
                      <th>Số lượng</th>
                      <th>Giá thành</th>
                      <th>Khuyến mãi</th>
                      <th>Tổng giá sản phẩm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->books as $book)
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
                        <td>{{$book->pivot->discount}} %</td>
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
                    <p class="lead">Phương thức thanh toán: {{$order->payment_methods}}</p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                            @isset($order->discountCode->discount)
                            <th style="width:50%">Giảm giá trên hóa đơn:</th>
                            <td>{{$order->discountCode->discount}} %</td>
                            @endisset
                        </tr>
                        <tr>
                            <th>Phí vận chuyển:</th>
                            <td>{{$order->transporter->postage}} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Tổng hóa đơn:</th>
                            <td>{{ $order->totalPrice }} VNĐ</td>
                        </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-success float-right"><i class="fas fa-undo"></i>Quay lại
                  </a>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Xuất ra file PDF
                  </button>
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
