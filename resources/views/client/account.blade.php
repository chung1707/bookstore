@extends('layouts.bookstore')

@section('content')
<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Tài khoản của tôi<span>Molla BooK</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <aside class="col-md-4 col-lg-3">
                    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Đơn hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-infos-link" data-toggle="tab" href="#tab-infos" role="tab" aria-controls="tab-infos" aria-selected="false">Thông tin tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Sửa thông tin vận chuyển</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Đổi mật khẩu</a>
                        </li>
                    </ul>
                </aside><!-- End .col-lg-3 -->

                <div class="col-md-8 col-lg-9 ">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                            @if(!isset($orders))
                            <div>
                                <p>Bạn chưa có đơn hàng nào</p>
                                <a href="category.html" class="btn btn-outline-primary-2"><span>Tiếp tục mua sắm</span><i class="icon-long-arrow-right"></i></a>
                            </div>
                            @else
                            <div class="col-lg-9 ">
                                @foreach($orders as $order)
                                <div style=" border-radius: 10px;
                                            background-color: #f9f9f9;
                                            padding: 30px;
                                            margin-bottom: 50px;
                                            box-shadow: 0px 5px 10px rgb(165 165 165 / 50%);">
                                    <p>Mã đơn hàng: {{$order->transaction_id}}</p>
                                    @if($order->pending)
                                    <p>Trạng thái đơn hàng: Đang chờ cửa hàng xác nhận</p>
                                    <form action="{{route('mark_canceled',['order' => $order])}}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-outline-primary-2" type='submit'>Hủy</button>
                                    </form>
                                    @elseif($order->processing)
                                    <p>Trạng thái đơn hàng: Đang giao hàng</p>
                                    @elseif($order->delivered)
                                    <p>Trạng thái đơn hàng: Đã giao hàng</p>
                                    @else
                                    <p>Trạng thái đơn hàng: Đơn hàng đã hủy</p>
                                    @endif
                                    <p>thời gian tạo: {{ $order->created_at }}</p>
                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm chọn mua</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($order->books as $book)
                                            <tr>
                                                <td>
                                                    <a href="#">{{ $book->name }}</a>
                                                </td>
                                                <th>{{ $book->pivot->quantity }}</th>
                                                <th>{{ $book->price }}</th>
                                                <td>{{ $book->pivot->price *  $book->pivot->quantity }}</td>
                                            </tr>
                                            @endforeach
                                            <tr class="summary-subtotal">
                                                <td>Mã giảm giá</td>
                                                @if(isset($order->discountCode))
                                                <td>{{$order->discountCode->discount}} %</td>
                                                @else
                                                <td>0%</td>
                                                @endif
                                            </tr>
                                            <!-- End .summary-subtotal -->
                                            <tr class="summary-total">
                                                <td>Tổng hóa đơn:</td>
                                                <td>{{$order->totalPrice}}</td>
                                            </tr>
                                            <!-- End .summary-total -->
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                            {{$orders->links() }}
                            @endif
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-infos" role="tabpanel" aria-labelledby="tab-address-link">
                            <h4>Thông tin người dùng</h4>
                            <label>Tên người dùng</label>
                            <input type="text" class="form-control" required="" value="{{ $user->name }}" disabled>
                            <small class="form-text">Đây sẽ là tên của bạn sẽ được hiển thị trong phần tài khoản và trong các bài đánh giá</small>

                            <label>Địa chỉ Email</label>
                            <input type="email" class="form-control" required="" value="{{ $user->email }}" disabled>

                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" required="" value="{{ $user->phone }}" disabled>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Phường (Xã)</label>
                                    @if(isset($user->ward))
                                    <input type="text" class="form-control" required="" value="{{ $user->ward->name }}" disabled>
                                    @else
                                    <input type="text" class="form-control" required="" placeholder="Bạn chưa chọn xã phường" disabled>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Quận (Huyện)</label>
                                    @if(isset($user->district))
                                    <input type="text" class="form-control" required="" placeholder="Bạn chưa chọn quận huyện" disabled>
                                    @else
                                    <input type="text" class="form-control" required="" disabled>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Tỉnh (Thành phố)</label>
                                    @if(isset($user->province))
                                    <input type="text" class="form-control" required="" value="{{ $user->province->name }}" disabled>
                                    @else
                                    <input type="text" class="form-control" required="" placeholder="Bạn chưa chọn thành phố" disabled>
                                    @endif
                                </div>
                            </div>

                            <label>Địa chỉ nhận hàng chi tiết</label>
                            @if(isset($user->address))
                            <input type="text" class="form-control" required="" value="{{ $user->address}}" disabled>
                            @else
                            <input type="text" class="form-control" required="" placeholder="Bạn chưa điền địa chỉ chi tiết" disabled>
                            @endif
                                <button class="btn btn-outline-primary-2">
                                <a href="profile">Cập nhập thông tin</a>
                            </button>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                            <update-infos></update-infos>
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                            <change-password>
                            </change-password>
                        </div><!-- .End .tab-pane -->
                    </div>
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .dashboard -->
</div><!-- End .page-content -->

@endsection
