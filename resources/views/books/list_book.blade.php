@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Sản phẩm trong kho')

@section('content_header')
<h1>Danh sách sản phẩm</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row" style="justify-content: center;">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng số sản phẩm</span>
                    <span class="info-box-number">
                        {{$totalBooks}}
                        <small>Sản phẩm</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sản phẩm bán chạy nhất</span>
                    <span class="info-box-number">{{$bestSellingBook->name}}<small>-{{$bestSellingBook->sold}} cuốn</small> </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tổng sản phẩm đã bán</span>
                    <span class="info-box-number">{{$totalSold}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <admin-cart-icon></admin-cart-icon>
        <!-- /.col -->
        <!-- /.col -->
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách sản phẩm --</h3>
                @if (!isset($search))
                <h4 class="card-title">
                    Trang: {{ $books->currentPage() }} / {{$books->lastPage()}}
                </h4>
                @endif
                <div class="card-tools">
                    <form action="{{ route('books_list') }}" method="get">
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
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá thành</th>
                            <th>Ảnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->book_code }}</td>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>{{ $book->price }}</td>
                            <td>
                                @if(isset($book->thumbnails[0]->img))
                                <img src="{{ asset('storage/thumbnails/'.$book->thumbnails[0]->img) }}" alt="Banner" style="width:80px;">
                                @endif
                            </td>
                            <td><a href="{{route('book.admin_show',['book' => $book])}}" class="btn btn-info">Xem chi tiết</a></td>
                            <td>
                                <add_to_admin_cart :book="{{ json_encode($book) }}"></add_to_admin_cart>
                            </td>
                            @if(auth()->user()->role->name == 'admin')
                            <td class="table__content">
                                <delete :item="{{ json_encode($book) }}" :link="{{json_encode($linkDelete)}}"></delete>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!isset($search))
            <div style="padding-top: 20px;
                            margin: 0px auto;">
                {{ $books->links() }}
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
