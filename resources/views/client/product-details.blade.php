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
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-accordion" id="review-link">( 2 Reviews )</a>
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
                                            <a href="#" style="
                                                        font-family: 'molla';
                                                        font-size: 16px;"
                                            >|{{$category->name}}</a>
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

                                    <div class="accordion accordion-plus product-details-accordion" id="product-accordion">
                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-desc-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-desc" aria-expanded="false" aria-controls="product-accordion-desc">
                                                        Mô tả
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-desc" class="collapse" aria-labelledby="product-desc-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>{!! $book->description !!}</p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-info-heading">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#product-accordion-info" aria-expanded="true" aria-controls="product-accordion-info">
                                                        Thông tin thêm
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-info" class="collapse show" aria-labelledby="product-info-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                                                        <h3>Fabric & care</h3>
                                                        <ul>
                                                            <li>100% Polyester</li>
                                                            <li>Do not iron</li>
                                                            <li>Do not wash</li>
                                                            <li>Do not bleach</li>
                                                            <li>Do not tumble dry</li>
                                                            <li>Professional dry clean only</li>
                                                        </ul>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-shipping-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-shipping" aria-expanded="false" aria-controls="product-accordion-shipping">
                                                        Giao hàng và đổi trả
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-shipping" class="collapse" aria-labelledby="product-shipping-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                                        We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-review-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-review" aria-expanded="false" aria-controls="product-accordion-review">
                                                        Đánh giá
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-review" class="collapse" aria-labelledby="product-review-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="reviews">
                                                        <div class="review">
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <h4><a href="#">Samanta J.</a></h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                                        </div><!-- End .ratings -->
                                                                    </div><!-- End .rating-container -->
                                                                    <span class="review-date">6 days ago</span>
                                                                </div><!-- End .col -->
                                                                <div class="col">
                                                                    <h4>Good, perfect size</h4>

                                                                    <div class="review-content">
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                                                    </div><!-- End .review-content -->

                                                                    <div class="review-action">
                                                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                    </div><!-- End .review-action -->
                                                                </div><!-- End .col-auto -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .review -->

                                                        <div class="review">
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <h4><a href="#">John Doe</a></h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                                        </div><!-- End .ratings -->
                                                                    </div><!-- End .rating-container -->
                                                                    <span class="review-date">5 days ago</span>
                                                                </div><!-- End .col -->
                                                                <div class="col">
                                                                    <h4>Very good</h4>

                                                                    <div class="review-content">
                                                                        <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                                                    </div><!-- End .review-content -->

                                                                    <div class="review-action">
                                                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                    </div><!-- End .review-action -->
                                                                </div><!-- End .col-auto -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .review -->
                                                    </div><!-- End .reviews -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->
                                    </div><!-- End .accordion -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <hr class="mt-3 mb-5">

                    <h2 class="title text-center mb-4">Những cuốn sách cùng thể loại</h2><!-- End .title text-center -->
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
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
                                <span class="product-label label-new">New</span>
                                <span class="product-label label-top">Top</span>
                                <span class="product-label label-out">Out of Stock</span>
                                <a href="{{ route('books.show',['book' =>$relatedBook]) }}">
                                    <img src="{{ asset('storage/thumbnails/'.$relatedBook->thumbnails[0]->img)}}" alt="Product image" class="product-image">
                                </a>
                                <div class="product-action">
                                    <add-to-cart :book="{{ $relatedBook }}"></add-to-cart>
                                </div><!-- End .product-action -->
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
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->


                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .owl-carosel -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->

@endsection
