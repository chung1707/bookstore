@extends('layouts.bookstore')

@section('content')

<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Giỏ hàng<span>Molla BooK</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row" style="justify-content: space-around;">
                <product-list></product-list>
            </div>
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->
< @endsection
