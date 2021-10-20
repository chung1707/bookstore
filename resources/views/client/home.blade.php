@extends('layouts.bookstore')

@section('content')
<div class="intro-section bg-lighter pt-5 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                    <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false,
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            }
                                        }
                                    }'>
                        <div class="intro-slide">
                            <figure class="slide-image">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="storage/images/slider/slide-1-480w.jpg">
                                    <img src="{{ asset('storage/bookstore_img/home/ads.jpg')}}" alt="Image Desc">
                                </picture>
                            </figure><!-- End .slide-image -->

                            <div class="intro-content">
                                <h3 class="intro-subtitle">Bộ sưu tập mới<i></i></h3><!-- End .h3 intro-subtitle -->
                                <h1 class="intro-title">Molla BooK<br>Collection<br></h1><!-- End .intro-title -->
                                <a href="category.html" class="btn btn-outline-white">
                                    <span>Khám phá</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->

                        <div class="intro-slide">
                            <figure class="slide-image">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="storage/images/slider/">
                                    <img src="{{ asset('storage/bookstore_img/home/banner-1.jpg')}}" alt="Image Desc">
                                </picture>
                            </figure><!-- End .slide-image -->

                            <div class="intro-content" >
                                <h3 class="intro-subtitle">Best Sellers</h3><!-- End .h3 intro-subtitle -->
                                <h1 class="intro-title">Bán chạy<br>nhất</h1><!-- End .intro-title -->

                                <a href="#trendy-all-tab" class="btn btn-outline-white">
                                    <span>Khám phá</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->

                        <div class="intro-slide">
                            <figure class="slide-image">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="storage/images/slider/">
                                    <img src="{{ asset('storage/bookstore_img/home/banner-4.jpg')}}" alt="Image Desc">
                                </picture>
                            </figure><!-- End .slide-image -->

                            <div class="intro-content">
                                <h3 class="intro-subtitle">News & inspiration</h3><!-- End .h3 intro-subtitle -->
                                <h1 class="intro-title">Tin tức<br>cảm hứng</h1><!-- End .intro-title -->

                                <a href="category.html" class="btn btn-outline-white">
                                    <span>Khám phá</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->
                    </div><!-- End .intro-slider owl-carousel owl-simple -->

                    <span class="slider-loader"></span><!-- End .slider-loader -->
                </div><!-- End .intro-slider-container -->
            </div><!-- End .col-lg-8 -->
            <div class="col-lg-4">
                <div class="intro-banners">
                    <div class="row row-sm">
                        <div class="col-md-6 col-lg-12">
                            <div class="banner banner-display">
                                <a href="#">
                                    <img src="{{ asset('storage/bookstore_img/blog/post-2.jpg')}}" style="max-height: 213px;" alt="Banner">
                                </a>

                                <div class="banner-content">
                                    <h4 class="banner-subtitle text-darkwhite"><a href="#">our story</a></h4><!-- End .banner-subtitle -->
                                    <a href="#" class="btn btn-outline-white banner-link">Khám phá<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-6 col-lg-12 -->

                        <div class="col-md-6 col-lg-12">
                            <div class="banner banner-display mb-0">
                                <a href="#">
                                    <img src="{{ asset('storage/bookstore_img/blog/blog-1-720x480.jpg')}}" style="max-height: 213px;" alt="Banner">
                                </a>

                                <div class="banner-content">
                                    <h4 class="banner-subtitle text-darkwhite"><a href="#">Reviews</a></h4><!-- End .banner-subtitle -->
                                    <a href="#" class="btn btn-outline-white banner-link">Khám phá<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-6 col-lg-12 -->
                    </div><!-- End .row row-sm -->
                </div><!-- End .intro-banners -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->

        <div class="mb-6"></div><!-- End .mb-6 -->

        <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
            @foreach($suppliers as $supplier)
            <a href="#" class="brand">
                <img src="{{ asset('storage/thumbnails/'.$supplier->logo)}}" alt="Brand Name">
            </a>
            @endforeach
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
</div><!-- End .bg-lighter -->

<div class="mb-6"></div><!-- End .mb-6 -->

<div class="container">
    <div class="heading heading-center mb-3">
        <h2 class="title-lg">Sản phẩm bán chạy</h2><!-- End .title -->

        <ul class="nav nav-pills justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab" aria-controls="trendy-all-tab" aria-selected="true">HOT</a>
            </li>
        </ul>
    </div><!-- End .heading -->

    <div class="tab-content tab-content-carousel">


        <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
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
                @foreach($trendBooks as $trendBook)
                <div class="product product-11 text-center">
                    @if(isset($trendBook->thumbnails[0]))
                    <figure class="product-media">
                        <a href="{{ route('books.show',['book' =>$trendBook]) }}">
                            <img src="{{ asset('storage/thumbnails/'.$trendBook->thumbnails[0]->img)}}" alt="Product image" class="product-image">
                            @isset($trendBook->thumbnails[0])
                            <img src="{{ asset('storage/thumbnails/'.$trendBook->thumbnails[1]->img)}}" alt="Product image" class="product-image-hover">
                            @endisset
                        </a>
                    </figure><!-- End .product-media -->
                    @else
                    <figure class="product-media">
                        <a href="{{ route('books.show',['book' =>$trendBook]) }}">
                            <img src="{{ asset('storage/thumbnails/product0.jpg')}}" alt="Product image" class="product-image">
                            <img src="{{ asset('storage/thumbnails/product0.jpg')}}" alt="Product image" class="product-image-hover">
                        </a>
                    </figure><!-- End .product-media -->
                    @endif
                    <div class="product-body">
                        <h3 class="product-title"><a href="{{ route('books.show',['book' =>$trendBook]) }}">{{ $trendBook->name }}</a></h3><!-- End .product-title -->
                        <div class="product-price" style=" color: #e68b7a;">
                            {{$trendBook->price}} VNĐ
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                    <div class="product-action">
                        <add-to-cart :book="{{ $trendBook }}" ></add-to-cart>
                    </div><!-- End .product-action -->
                </div><!-- End .product -->
                @endforeach
            </div>
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
</div><!-- End .container -->

<div class="container categories pt-6">
    <h2 class="title-lg text-center mb-4">Danh mục phổ biến</h2><!-- End .title-lg text-center -->

    <div class="row">
        @foreach ($trendCategories as $trendCategory)
        <div class="col-6 col-lg-4">
            <div class="banner banner-display banner-link-anim">
                @if(isset($trendCategory->books[1]))
                    @isset($trendCategory->books[1]->thumbnail[0])
                    <a href="#">
                        <img src="{{ asset('storage/thumbnails/'.$trendCategory->books[1]->thumbnails[0]->img) }}" alt="Banner">
                    </a>
                    @endisset
                @endif
                <div class="banner-content banner-content-center">
                    <h3 class="banner-title text-white">
                        <a href="#"
                        style=" font-size: 30px;
                            color: #ffffff;
                            font-family: 'molla';"
                        >{{ $trendCategory->name }}</a></h3><!-- End .banner-title -->
                    <a href="#" class="btn btn-outline-white banner-link">Khám phá<i class="icon-long-arrow-right"></i></a>
                </div><!-- End .banner-content -->
            </div><!-- End .banner -->
        </div><!-- End .col-sm-6 col-lg-3 -->
        @endforeach
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- End .mb-6 -->


<div class="container">
    <div class="heading heading-center mb-6">
        <h2 class="title">Sản phẩm gần đây</h2><!-- End .title -->

        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">News</a>
            </li>
        </ul>
    </div><!-- End .heading -->

    <div class="tab-content">
        <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
            <div class="products">
                <div class="row justify-content-center">
                    @foreach($newBooks as $newBook)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-11 mt-v3 text-center">
                            @if(isset($newBook->thumbnails[0]))
                            <figure class="product-media">
                                <a href="{{ route('books.show',['book' =>$newBook]) }}">
                                    <img src="{{ asset('storage/thumbnails/'.$newBook->thumbnails[0]->img)}}" alt="Product image" class="product-image">
                                    @isset($newBook->thumbnails[1])
                                    <img src="{{ asset('storage/thumbnails/'.$newBook->thumbnails[1]->img)}}" alt="Product image" class="product-image-hover">
                                    @endisset
                                </a>
                            </figure><!-- End .product-media -->
                            @else
                            <figure class="product-media">
                                <a href="{{ route('books.show',['book' =>$newBook]) }}">
                                    <img src="{{ asset('storage/thumbnails/product0.jpg')}}" alt="Product image" class="product-image">
                                    <img src="{{ asset('storage/thumbnails/product0.jpg')}}" alt="Product image" class="product-image-hover">
                                </a>
                            </figure><!-- End .product-media -->
                            @endif
                            <div class="product-body">
                                <h3 class="product-title"><a href="{{ route('books.show',['book' =>$newBook]) }}">{{ $newBook->name }}</a></h3><!-- End .product-title -->
                                <div class="product-price" style=" color: #e68b7a;">
                                    {{$newBook->price}} VNĐ
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->

                            <div class="product-action">
                                <add-to-cart :book="{{ $newBook }}" ></add-to-cart>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
    <div class="more-container text-center">
        <a href="{{ route('books.index') }}" class="btn btn-outline-darker btn-more"><span>Khám phá thêm</span><i class="icon-long-arrow-right"></i></a>
    </div><!-- End .more-container -->
</div><!-- End .container -->

<div class="container">
    <hr>
    <div class="row justify-content-center">
        <div class="col-lg-4 col-sm-6">
            <div class="icon-box icon-box-card text-center">
                <span class="icon-box-icon">
                    <i class="icon-rocket"></i>
                </span>
                <div class="icon-box-content">
                    <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                    <p>Free shipping for orders over $50</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-lg-4 col-sm-6 -->

        <div class="col-lg-4 col-sm-6">
            <div class="icon-box icon-box-card text-center">
                <span class="icon-box-icon">
                    <i class="icon-rotate-left"></i>
                </span>
                <div class="icon-box-content">
                    <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                    <p>Free 100% money back guarantee</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-lg-4 col-sm-6 -->

        <div class="col-lg-4 col-sm-6">
            <div class="icon-box icon-box-card text-center">
                <span class="icon-box-icon">
                    <i class="icon-life-ring"></i>
                </span>
                <div class="icon-box-content">
                    <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                    <p>Alway online feedback 24/7</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-lg-4 col-sm-6 -->
    </div><!-- End .row -->

    <div class="mb-2"></div><!-- End .mb-2 -->
</div><!-- End .container -->
<div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
    <div class="container">
        <h2 class="title-lg text-center mb-3 mb-md-4">From Our Blog</h2><!-- End .title-lg text-center -->

        <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
            <article class="entry entry-display">
                <figure class="entry-media">
                    <a href="single.html">
                        <img src="{{ asset('storage/images/blog/home/post-1.jpg')}}" alt="image desc">
                    </a>
                </figure><!-- End .entry-media -->

                <div class="entry-body pb-4 text-center">
                    <div class="entry-meta">
                        <a href="#">Nov 22, 2018</a>, 0 Comments
                    </div><!-- End .entry-meta -->

                    <h3 class="entry-title">
                        <a href="single.html">Sed adipiscing ornare.</a>
                    </h3><!-- End .entry-title -->

                    <div class="entry-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.<br>Pelletesque aliquet nibh necurna. </p>
                        <a href="single.html" class="read-more">Read More</a>
                    </div><!-- End .entry-content -->
                </div><!-- End .entry-body -->
            </article><!-- End .entry -->

            <article class="entry entry-display">
                <figure class="entry-media">
                    <a href="single.html">
                        <img src="{{ asset('storage/images/blog/home/post-2.jpg')}}" alt="image desc">
                    </a>
                </figure><!-- End .entry-media -->

                <div class="entry-body pb-4 text-center">
                    <div class="entry-meta">
                        <a href="#">Dec 12, 2018</a>, 0 Comments
                    </div><!-- End .entry-meta -->

                    <h3 class="entry-title">
                        <a href="single.html">Fusce lacinia arcuet nulla.</a>
                    </h3><!-- End .entry-title -->

                    <div class="entry-content">
                        <p>Sed pretium, ligula sollicitudin laoreet<br>viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis justo. </p>
                        <a href="single.html" class="read-more">Read More</a>
                    </div><!-- End .entry-content -->
                </div><!-- End .entry-body -->
            </article><!-- End .entry -->

            <article class="entry entry-display">
                <figure class="entry-media">
                    <a href="single.html">
                        <img src="{{ asset('storage/images/blog/home/post-3.jpg')}}" alt="image desc">
                    </a>
                </figure><!-- End .entry-media -->

                <div class="entry-body pb-4 text-center">
                    <div class="entry-meta">
                        <a href="#">Dec 19, 2018</a>, 2 Comments
                    </div><!-- End .entry-meta -->

                    <h3 class="entry-title">
                        <a href="single.html">Quisque volutpat mattis eros.</a>
                    </h3><!-- End .entry-title -->

                    <div class="entry-content">
                        <p>Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. </p>
                        <a href="single.html" class="read-more">Read More</a>
                    </div><!-- End .entry-content -->
                </div><!-- End .entry-body -->
            </article><!-- End .entry -->
        </div><!-- End .owl-carousel -->
    </div><!-- container -->

    <div class="more-container text-center mb-0 mt-3">
        <a href="blog.html" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
    </div><!-- End .more-container -->
</div>
<div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url(storage/images/backgrounds/cta/bg-6.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9 col-xl-8">
                <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                    <div class="col">
                        <h3 class="cta-title text-white">Sign Up & Get 10% Off</h3><!-- End .cta-title -->
                        <p class="cta-desc text-white">Molla presents the best in interior design</p><!-- End .cta-desc -->
                    </div><!-- End .col -->

                    <div class="col-auto">
                        <a href="login.html" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .col-auto -->
                </div><!-- End .row no-gutters -->
            </div><!-- End .col-md-10 col-lg-9 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .cta -->
@endsection
