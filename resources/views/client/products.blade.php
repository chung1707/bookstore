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
                                    @if($book->quantity < 10 && $book->quantity >1)
                                    <span class="product-label label-new">C??n: {{$book->quantity}} Cu???n</span>
                                    @endif
                                    @if($book->quantity < 1)
                                    <span class="product-label label-new">C??n: {{$book->quantity}} H???t h??ng</span>
                                    @endif
                                    <a href="{{ route('books.show',['book' =>$book]) }}">
                                        <img style="max-height: 277px;" src="{{ asset('storage/thumbnails/'.$book->thumbnails[0]->img)}}" alt="Product image" class="product-image">
                                    </a>
                                    @if($book->quantity > 1)
                                    <div class="product-action">
                                        <add-to-cart :book="{{ $book }}" ></add-to-cart>
                                    </div>
                                    @endif
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
                                        {{ $book->price }} VN??
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
                        @if(!isset($SupplierChecked[0])&&!isset($CategoryChecked[0]))
                            {{ $books->links()}}
                        @endif
                    </div>
                </nav>
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                        <label>B??? l???c:</label>
                        <a href="{{ route('books.index',['CategorySearch'=>[],'CategorySearch'=>[]]) }}" class="sidebar-filter-clear">B??? l???c</a>
                    </div><!-- End .widget widget-clean -->
                    <form action="">
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                Th??? lo???i
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach($categories as $category)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{$category->name}}" name="CategorySearch[]"
                                                value="{{$category->id}}"
                                                @if(isset($CategoryChecked[0])&&in_array($category->id, $CategoryChecked)) {{ $checked }} @endif>
                                                <label class="custom-control-label" for="{{$category->name}}">{{ $category->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{   count($category->books) }}</span>
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->


                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                Nh?? xu???t b???n
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($suppliers as $supplier)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{$supplier->name}}" name="SupplierSearch[]" value="{{$supplier->id}}" @if(isset($SupplierChecked[0])&&in_array($supplier->id, $SupplierChecked)) {{ $checked }} @endif>
                                                <label class="custom-control-label" for="{{ $supplier->name }}">{{ $supplier->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    @endforeach

                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                        <input type="submit" value="L???c" class="btn btn-outline-secondary">
                    </div><!-- End .widget -->
                    </form>
                </div><!-- End .sidebar sidebar-shop -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->
@endsection
