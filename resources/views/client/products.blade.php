@extends('layouts.bookstore')

@section('content')
<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Molla BooK<span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Grid 3 Columns</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            Đã xem <span>{{ count($books)*($books->currentPage()) }} trên {{ count($books)*($books->lastPage()) }}</span> sản phẩm
                        </div><!-- End .toolbox-info -->
                    </div><!-- End .toolbox-left -->
                    <form action="">
                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="popularity" selected="selected">Most Popular</option>
                                    <option value="rating">Most Rated</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div><!-- End .toolbox-sort -->
                    </div><!-- End .toolbox-right -->
                    </form>
                </div><!-- End .toolbox -->

                <div class="products mb-3">
                    <div class="row justify-content-center">
                        @foreach($books as $book)
                        <div class="col-6 col-md-4 col-lg-4">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">Mới</span>
                                    <a href="{{ route('books.show',['book' =>$book]) }}">
                                        <img style="max-height: 277px;" src="{{ asset('storage/thumbnails/'.$book->thumbnails[0]->img)}}" alt="Product image" class="product-image">
                                    </a>
                                    <div class="product-action">
                                        <add-to-cart :book="{{ $book }}" ></add-to-cart>
                                    </div>
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#"
                                        style="
                                            font-size: 16px;
                                            font-family: 'molla';">{{ $book->author}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('books.show',['book' =>$book]) }}">{{ $book->name }}</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        {{ $book->price }} VNĐ
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-thumbs">
                                        @foreach ($book->thumbnails as $thumbnail)
                                            <a href="#" class="active">
                                                <img src="{{ asset('storage/thumbnails/'.$thumbnail->img)}}" alt="product desc">
                                            </a>
                                        @endforeach
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-lg-4 -->

                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .products -->

                <nav aria-label="Page navigation">
                    <div class="pagination justify-content-center">
                        {{ $books->links()}}
                    </div>
                </nav>
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                        <label>Filters:</label>
                        <a href="#" class="sidebar-filter-clear">Clean All</a>
                    </div><!-- End .widget widget-clean -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                Category
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    <form action="">
                                    @foreach($categories as $category)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{$category->id}}">
                                                <label class="custom-control-label" for="{{$category->id}}">{{ $category->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{   count($category->books) }}</span>
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                    </form>
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->


                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                Brand
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">
                                    <form action="">
                                    @foreach($suppliers as $supplier)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{$supplier->id}}">
                                                <label class="custom-control-label" for="{{ $supplier->id }}">{{ $supplier->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                    </form>
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                </div><!-- End .sidebar sidebar-shop -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->
@endsection
