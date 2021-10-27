@extends('layouts.bookstore')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sticky Info</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="product-details-top">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-separated">
                        @if($book->discount!=0)
                        <span class="product-label label-sale">Sale {{$book->discount}}%</span>
                        @endif
                        @foreach($book->thumbnails as $thumbnail)
                        <figure class="product-separated-item">
                            <img src="{{ asset('storage/thumbnails/'.$thumbnail->img)}}" alt="product image">
                        </figure>
                        @endforeach
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="product-details sticky-content">
                        <h1 class="product-title">{{$book->name}}</h1><!-- End .product-title -->
                        <div class="ratings-container">

                            <rating :book="{{ json_encode($book) }}" :star_size="{{ json_encode(20)}}"></rating>

                        </div>
                        <div class="product-price">
                            @if($book->discount!=0)
                            <span class="new-price">{{$book->price-($book->price * $book->discount)/ 100}} VNĐ </span>
                            <span class="old-price">{{$book->price}} VNĐ</span>
                            @else
                            <span class="new-price">{{$book->price}} VNĐ</span>
                            @endif
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            <p>{{ Str::limit($book->description, 150) }}</p>
                        </div><!-- End .product-content -->

                        <div class="product-details-action">
                            <add-to-cart-details :book="{{ $book }}"></add-to-cart-details>
                        </div><!-- End .product-details-action -->

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                @foreach ($book->categories as $category)
                                <a href="#"
                                    style="
                                    font-family: 'molla';
                                    font-size: 16px;">
                                    |{{$category->name}}</a>
                                @endforeach
                            </div><!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div>
                        </div><!-- End .product-details-footer -->
                        <comment :bought="{{ json_encode($bought) }}"  :book="{{ json_encode($book) }}"></comment>
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->

        <hr class="mt-3 mb-5">

        <h2 class="title text-center mb-4">Những cuốn sách cùng thể loại</h2><!-- End .title text-center -->
        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
            @foreach($relatedBooks as $relatedBook)
            <div class="product product-7">
                <figure class="product-media">
                    @if($relatedBook->quantity < 1)
                    <span class="product-label label-out">Hết hàng</span>
                    @endif
                    @if($relatedBook->quantity < 10)
                    <span class="product-label label-out">Chỉ còn lại {{$relatedBook->quantity}} cuốn</span>
                    @endif
                    <a href="{{ route('books.show',['book' =>$relatedBook]) }}">
                        <img src="{{ asset('storage/thumbnails/'.$relatedBook->thumbnails[0]->img)}}" alt="Product image" class="product-image">
                    </a>
                    @if($relatedBook->quantity > 1)
                    <div class="product-action">
                        <add-to-cart :book="{{ $relatedBook }}"></add-to-cart>
                    </div><!-- End .product-action -->
                    @endif
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="{{ route('books.show',['book' =>$relatedBook]) }}">{{ $relatedBook->author }}</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="{{ route('books.show',['book' =>$relatedBook]) }}">{{ $relatedBook->name }}</a></h3><!-- End .product-title -->
                    <div class="product-price">
                        {{ $relatedBook->price }} VNĐ
                    </div><!-- End .product-price -->

                    <div class="ratings-container">
                        <rating :book="{{ json_encode($relatedBook) }}"  :star_size="{{ json_encode(15)}}"></rating>
                    </div><!-- End .rating-container -->


                </div><!-- End .product-body -->
            </div><!-- End .product -->
            @endforeach
        </div><!-- End .owl-carosel -->
    </div><!-- End .container -->
</div><!-- End .page-content -->

@endsection
