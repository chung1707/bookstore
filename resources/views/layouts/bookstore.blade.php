<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Molla BooK</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla BooK">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="storage/bookstore_img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="storage/bookstore_img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="storage/bookstore_img/icons/favicon-16x16.png">
    <link rel="manifest" href="storage/bookstore_img/icons/site.html">
    <link rel="mask-icon" href="storage/bookstore_img/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="storage/bookstore_img/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="storage/bookstore_img/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link href="{{ asset('css/book_css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('css/book_css/plugins/nouislider/nouislider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/book_css/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/book_css/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/book_css/style.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'molla' !important;
        }

        a {
            font-family: 'molla' !important;
        }

        .page-header {
            background-image: url('http://localhost:8000/storage/bookstore_img/home/page-header-bg.jpg') !important;
        }
    </style>


</head>

<body>
    <div class="page-wrapper" id="app">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <div class="header-dropdown">
                            <a href="#">Eng</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Việt Nam</a></li>
                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropdown -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    @guest
                                    @else
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Đăng xuất') }}
                                        </a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @endguest
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div>
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="{{route('home')}}" class="logo">
                            <img src="{{ asset('storage/bookstore_img/logo/logo.png') }}" alt="Molla BooK Logo" width="105" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li>
                                    <a href="category.html" class="sf-with-ul">Thể loại</a>
                                    <div class="megamenu megamenu-sm"
                                        style=" max-height: 400px;
                                                 overflow-x: scroll;">
                                        <categories-menu></categories-menu>
                                    </div><!-- End .megamenu megamenu-md -->
                                </li>
                                <li>
                                    <a href="product.html" class="sf-with-ul">Sản Phẩm</a>

                                    <div class="megamenu megamenu-sm"
                                        style=" max-height: 400px;
                                                overflow-x: scroll;">
                                        <products-menu></products-menu>
                                    </div><!-- End .megamenu megamenu-sm -->
                                </li>
                                <li>
                                    <a href="blog.html">Blog</a>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->

                        <div class="dropdown cart-dropdown">
                            <cart-icon></cart-icon>
                        </div><!-- End .cart-dropdown -->
                        <div>
                            @guest
                            <div class="account" style="margin-left: 20px;">
                                <a href="/login" title="Login">
                                    <div class="icon" style="height: 20px;">
                                        <i class="icon-user" style="
                                            margin-left: 18px;
                                            font-size: 3rem;
                                            color: #333;
                                            line-height: 1;">
                                        </i>
                                    </div>
                                    <p>Đăng nhập</p>
                                </a>
                            </div><!-- End .compare-dropdown -->
                            @elseif(auth()->user()->role->name == 'user'|| auth()->user()->role->name == 'author')
                            <user-icon :user="{{ json_encode(Auth::user()) }}"></user-icon>
                            @elseif(auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'employee')
                            <admin-icon :user="{{ json_encode(Auth::user()) }}"></admin-icon>
                            @endguest
                        </div>
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main" id="app">
            @yield('content')
        </main><!-- End .main -->

        <footer class="footer footer-dark">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="widget widget-about">
                                <h4 style="color: wheat;">Molla BooK</h4>
                                <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. </p>

                                <div class="social-icons">
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="about.html">About Molla BooK</a></li>
                                    <li><a href="#">How to shop on Molla BooK</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                    <li><a href="login.html">Log in</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Payment Methods</a></li>
                                    <li><a href="#">Money-back guarantee!</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Terms and conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Sign In</a></li>
                                    <li><a href="cart.html">View Cart</a></li>
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->
        </footer><!-- End .footer -->


    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li>
                        <a href="category.html">Shop</a>
                        <ul>
                            <li><a href="category-list.html">Shop List</a></li>
                            <li><a href="category-2cols.html">Shop Grid 2 Columns</a></li>
                            <li><a href="category.html">Shop Grid 3 Columns</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="product.html" class="sf-with-ul">Sản phẩm</a>
                        <ul>
                            <li><a href="product.html">Default</a></li>
                            <li><a href="product-centered.html">Centered</a></li>
                            <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="blog.html">About Us</a>
                    </li>
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->


    <!-- MODAL -->
    <!-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="storage/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla BooK eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="storage/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Plugins JS File -->



    <!-- Main JS File -->

    <script src="https://kit.fontawesome.com/05541ae56c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/book_js/jquery.min.js') }}"></script>
    <!-- <script src="{{ asset('js/book_js/bootstrap.bundle.min.js') }}" ></script> -->
    <script src="{{ asset('js/book_js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('js/book_js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/book_js/superfish.min.js') }}"></script>
    <script src="{{ asset('js/book_js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('js/book_js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/book_js/main.js') }}"></script>


</body>


</html>
