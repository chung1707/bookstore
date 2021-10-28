@extends('layouts.bookstore')

@section('content')

<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Blog Listing<span>Blog</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listing</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <article class="entry entry-list">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <figure class="entry-media">
                                <a href="single.html">
                                    <img src="{{ asset('storage/images/blog/listing/post-4.jpg')}}" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-7">
                            <div class="entry-body">
                                <div class="entry-meta">
                                    <span class="entry-author">
                                        by <a href="#">Jane Doe</a>
                                    </span>
                                    <span class="meta-separator">|</span>
                                    <a href="#">Nov 12, 2018</a>
                                    <span class="meta-separator">|</span>
                                    <a href="#">4 Comments</a>
                                </div><!-- End .entry-meta -->

                                <h2 class="entry-title">
                                    <a href="single.html">Fusce pellentesque suscipit.</a>
                                </h2><!-- End .entry-title -->

                                <div class="entry-cats">
                                    in <a href="#">Travel</a>
                                </div><!-- End .entry-cats -->

                                <div class="entry-content">
                                    <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat eget felis ... </p>
                                    <a href="single.html" class="read-more">Continue Reading</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </article><!-- End .entry -->

                <article class="entry entry-list">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <figure class="entry-media">
                                <a href="single.html">
                                    <img src="{{ asset('storage/images/blog/listing/post-5.jpg')}}" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-7">
                            <div class="entry-body">
                                <div class="entry-meta">
                                    <span class="entry-author">
                                        by <a href="#">John Doe</a>
                                    </span>
                                    <span class="meta-separator">|</span>
                                    <a href="#">Nov 11, 2018</a>
                                    <span class="meta-separator">|</span>
                                    <a href="#">0 Comments</a>
                                </div><!-- End .entry-meta -->

                                <h2 class="entry-title">
                                    <a href="single.html">Donec nec justo eget felis facilisis fermentum.</a>
                                </h2><!-- End .entry-title -->

                                <div class="entry-cats">
                                    in <a href="#">Hobbies</a>
                                </div><!-- End .entry-cats -->

                                <div class="entry-content">
                                    <p>Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. Phasellus ultrices nulla quis nibh. Quisque lectus. Donec consectetuer ligula vulputate sem ...</p>
                                    <a href="single.html" class="read-more">Continue Reading</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </article><!-- End .entry -->

                <article class="entry entry-list">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <figure class="entry-media">
                                <a href="single.html">
                                    <img src="{{ asset('storage/images/blog/listing/post-6.jpg')}}" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-7">
                            <div class="entry-body">
                                <div class="entry-meta">
                                    <span class="entry-author">
                                        by <a href="#">Hans Doe</a>
                                    </span>
                                    <span class="meta-separator">|</span>
                                    <a href="#">Nov 10, 2018</a>
                                    <span class="meta-separator">|</span>
                                    <a href="#">0 Comments</a>
                                </div><!-- End .entry-meta -->

                                <h2 class="entry-title">
                                    <a href="single.html">Quisque volutpat mattiseros.</a>
                                </h2><!-- End .entry-title -->

                                <div class="entry-cats">
                                    in <a href="#">Travel</a>,
                                    <a href="#">Hobbies</a>
                                </div><!-- End .entry-cats -->

                                <div class="entry-content">
                                    <p>Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. Phasellus ultrices nulla quis nibh. Quisque lectus. Donec consectetuer ...</p>
                                    <a href="single.html" class="read-more">Continue Reading</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </article><!-- End .entry -->


                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                            </a>
                        </li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item">
                            <a class="page-link page-link-next" href="#" aria-label="Next">
                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div><!-- End .col-lg-9 -->

            <aside class="col-lg-3">
                <div class="sidebar">
                    @if(isset(auth()->user()->id))
                    @if(auth()->user()->role->name == 'author'||auth()->user()->role->name == 'admin')
                    <div class="widget widget-text">
                        <a class="btn btn-outline-primary-2 " href="/blog-create">
                        <span class="">Tạo bài viết</span>
                        </a>
                    </div><!-- End .widget -->
                    @endif
                    @endif
                    <div class="widget widget-cats">
                        <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

                        <ul>
                            <li><a href="#">Lifestyle<span>3</span></a></li>
                            <li><a href="#">Shopping<span>3</span></a></li>
                            <li><a href="#">Fashion<span>1</span></a></li>
                            <li><a href="#">Travel<span>3</span></a></li>
                            <li><a href="#">Hobbies<span>2</span></a></li>
                        </ul>
                    </div><!-- End .widget -->
                </div><!-- End .sidebar -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->

@endsection
