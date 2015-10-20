<html>
    <head>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
        <link rel="shortcut icon" type="image/png" href="{{ URL::asset('images/favicon.ico') }}"/>
        @yield('style')
    </head>
    <body>
        <div id="page" class="hfeed site">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div id="logo">
                            <span class="site-name">
                                <a class="navbar-brand" href="/" title="Dazzling Demo" rel="home">
                                    <img style="max-width:100px; margin-top: -7px;" src="{{ URL::asset('images/home/logo.jpg') }}">
                                </a>
                            </span>
                        </div><!-- end of #logo -->
                    </div>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul id="menu-all-pages" class="nav navbar-nav">
                            <li id="menu-item-1636" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active"><a title="Home" href="/">Home</a></li>
                            <li id="shop_menu_item" class="menu-item menu-item-type-post_type menu-item-object-page"><a title="Shop" href="/shop">Shop</a></li>
                            <li id="about_menu_item" class="menu-item menu-item-type-post_type menu-item-object-page"><a title="About" href="/about">About</a></li>
                            <li id="cart_menu_item" class="menu-item"><a class="woo-menu-cart" href="/my-cart" title="Start shopping"><i class="fa fa-shopping-cart"></i> <span class="itemCount">{{ $cartItemCount }}</span> items</a></li>
                        </ul>
                    </div>
                </div>
            </nav><!-- .site-navigation -->
            <div id="content" class="site-content container">
                @yield('content')
            </div>
            <div id="footer-area">
                <footer id="colophon" class="site-footer" role="contentinfo">
                    <div class="site-info container">
                        <nav role="navigation" class="col-md-6">
                            <ul id="menu-short-1" class="nav footer-nav clearfix"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1629"><a href="http://wpthemetestdata.wordpress.com/" onclick="__gaTracker('send', 'event', 'outbound-widget', 'http://wpthemetestdata.wordpress.com/', 'Home');">Home</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1761"><a href="https://colorlib.com/dazzling/page-a/">Shop</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1631"><a href="https://colorlib.com/dazzling/about/">About</a></li>
                            </ul>				</nav>
                        <div class="copyright col-md-6">
                            <a href="/about" title="Infinite Wonder">Infinite Wonder</a> All rights reserved.</a>
                        </div>
                    </div><!-- .site-info -->
                    <div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
                </footer><!-- #colophon -->
            </div>
        </div>
        <script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/validator.js') }}"></script>
        @yield('javascript')
    </body>
</html>
