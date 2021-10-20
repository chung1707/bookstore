@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Sản phẩm trong kho')

@section('content_header')
<h1>Danh sách sản phẩm</h1>
@stop

@section('content')
<div class="container-fluid">
<section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            @if(isset($book->thumbnails[0]))
                <thumbnail_display :book="{{ json_encode($book) }}"></thumbnail_display>
            @else
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{$book->name}}</h3>
              <div class="col-12">
                <img src="{{asset('storage/thumbnails/'.$book->thumbnails[0]->img)}}" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="" alt="Product Image"></div>
                <div class="product-image-thumb"><img src="" alt="Product Image"></div>
              </div>
            </div>
            @endif
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$book->name}}</h3>
              <p>{{$book->description}}</p>

              <hr>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Giá sản phẩm: {{$book->price}} VNĐ
                </h2>
                <h4 class="mt-0">
                  <small>Số lượng: {{$book->quantity}} cuốn </small>
                </h4>
                <h4 class="mt-0">
                  <small>Số lượng đã bán: {{$book->sold}} cuốn </small>
                </h4>
                <h4 class="mt-0">
                  <small>Khuyến mại: {{$book->discount}} % </small>
                </h4>
              </div>

              <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat">
                <i class="fas fa-wrench"></i>
                <a class="btn-primary" href="{{ route('book.edit',['book' => $book]) }}">Sửa thông tin sản phẩm</a>
                </div>

                <div class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-undo fa-lg mr-2"></i>
                  <a class="btn-primary" href="{{ route('books_list') }}">Quay lại</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Thể loại</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Nhà cung cấp</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Tác giả</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                @foreach($book->categories as $category)
                <p>
                    {{$category->name}}
                </p>
                @endforeach
              </div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                  <p>Nhà cung cấp: {{ $book->supplier->name }}</p>
                  <p>Số điện thoại: {{ $book->supplier->phone }}</p>
                  <p>Email: {{ $book->supplier->email }}</p>
              </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                  <p> {{ $book->author }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
