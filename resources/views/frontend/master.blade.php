<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    @if($logo==null)
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/uploads/Configs/logo_03.png') }}">
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/uploads/'. $logo->value) }}">
    @endif
    <!-- All css here -->
    <link rel="stylesheet" href="{{ asset('/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/ie7.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/style1.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/frontend/starability-master/starability-minified/starability-fade.min.css') }}">
</head>

<body class="bg-white">
    <!-- Header Area Start -->
    <header class="header-area header-two header-sticky">
        <div class="header-container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-12">
                    <div class="logo text-center logo-img">
                        @if($logo==null)
                        <a href="{{ route('home') }}"><img src="{{ asset('/uploads/Configs/logo_03.png') }}"
                            alt="NatureCircle" class="w-25"></a>
                        @else
                        <a href="{{ route('home') }}"><img src="{{ asset('/uploads/'. $logo->value) }}"
                                alt="NatureCircle" class="w-25"></a>
                                @endif
                    </div>
                </div>
                {{-- menu --}}
                <div class="col-lg-8 display-none-md display-none-xs">
                    <div class="ht-main-menu justify-content-center">
                        <nav class="d-flex justify-content-center">
                            <ul>
                                <li class="active"><a href="{{ route('home') }}">Trang ch???</a></li>
                                <li><a href="{{ route('shop-new') }}">H??ng m???i v???</a></li>
                                <li><a href="{{ route('shop') }}">Tr??<i class="fa fa-angle-down"></i></a>
                                    <ul class="ht-mega-menu menu-con">
                                        @foreach ($category_pro as $value)
                                            <li>
                                                <ul>
                                                    @if ($value->parent_id == 0)
                                                        <li class="mega-menu-title">
                                                            {{-- {{ $value->name }}
                                                            --}}
                                                            <a
                                                                href="{{ route('danh-muc', ['slug' => $value->slug]) }}">{{ $value->name }}</a>
                                                        </li>
                                                        @foreach ($category_pa as $valu)
                                                            @if ($valu->parent_id == $value->id)
                                                                <li><a
                                                                        href="{{ route('danh-muc', ['slug' => $valu->slug]) }}">{{ $valu->name }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('blog') }}">Tin t???c</a></li>

                                <li><a href="{{ route('contact') }}">Li??n h???</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                {{-- end menu --}}
                <div class="col-lg-2 col-sm-8">
                    <div class="header-content d-flex justify-content-end">
                        <div class="search-wrapper">
                            <a href="#"><span class="icon icon-Search"></span></a>
                            <form action="{{route('search')}}" class="search-form" method="get">
                                @csrf
                                <input type="text" name="key" placeholder="Nh???p t??? t??m ki???m ...">
                                <button type="submit">T??m ki???m</button>
                            </form>
                        </div>
                        <div class="settings-wrapper">
                            <a href="#"><i class="icon icon-Settings"></i></a>
                            <div class="settings-content">
                                <h4>
                                    @if (Auth::check())
                                        {{ Auth::user()->email }}
                                        <i class="fa fa-angle-down"></i>
                                </h4>
                                <ul>
                                    <li><a href="{{ route('profile', Auth::user()->id) }}">T??i kho???n c???a t??i</a></li>
                                    <li><a href="{{ route('wishlist', Auth::user()->id) }}">S???n ph???m y??u th??ch</a></li>
                                    <li><a href="{{ route('order-frontend', Auth::user()->id) }}">????n mua</a></li>
                                    <li><a href="{{ route('order-history', Auth::user()->id) }}">L???ch s??? mua h??ng</a></li>
                                    <li><a href="{{ route('dang-xuat') }}">????ng xu???t</a></li>
                                </ul>
                                <h4>
                                @else
                                    My Account
                                    <i class="fa fa-angle-down"></i>
                                </h4>
                                <ul>
                                    <li><a href="{{ route('dang-ky') }}">????ng k??</a></li>
                                    <li><a href="{{ route('dang-nhap') }}">????ng nh???p</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="cart-wrapper">
                            <a href="#">
                                <i class="icon icon-FullShoppingCart"></i>
                                <span>{{ $carts->count() }}</span>
                            </a>
                            <div class="cart-item-wrapper">
                                @foreach ($carts as $cart)
                                    <div class="single-cart-item">
                                        <div class="cart-img img-pro">
                                            <a
                                                href="{{ route('product-detail', ['slug' => $cart->slug, 'id_detail' => $cart->id]) }}">
                                                <img src="{{ asset('/uploads/'. $cart->image) }}" alt=""
                                                    class="">
                                            </a>
                                        </div>
                                        <div class="cart-text-btn">
                                            <div class="cart-text">
                                                <h5><a
                                                        href="{{ route('product-detail', ['slug' => $cart->slug, 'id_detail' => $cart->id]) }}">{{ $cart->name }}</a>
                                                </h5>
                                                <span class="cart-qty col">??{{ $cart->qty }}</span>
                                                <span class="col">
                                                    {{ is_numeric($cart->options['size']) ? $cart->options['size'] . 'g' : $cart->options['size'] }}
                                                </span>
                                                <span class="cart-price">{{ number_format($cart->price) }} ??</span>
                                            </div>
                                            <a href="{{ route('remove-cart', $cart->rowId) }}"><i
                                                    class="fa fa-close"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="cart-price-total">
                                    <div class="cart-price-info d-flex justify-content-between">
                                        <span>Sub-Total :</span>
                                        <span> {{ number_format($subtotal) }} ??</span>
                                    </div>
                                    <div class="cart-price-info d-flex justify-content-between">
                                        <span>Ship :</span>
                                        <span>{{ number_format($fee_ship) }} ??</span>
                                    </div>
                                    <div class="cart-price-info d-flex justify-content-between">
                                        <span>Total :</span>
                                        <span>{{ number_format($subtotal + $fee_ship) }} ??</span>
                                    </div>
                                </div>
                                <div class="cart-links">
                                    <a href="{{ route('cart') }}">Xem gi??? h??ng</a>
                                    <a href="{{ route('checkout') }}">?????t h??ng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Area End -->
        <!-- Mobile Menu Area Start -->
        <div class="mobile-menu-area">
            <div class="mobile-menu container">
                <nav id="mobile-menu-active">
                    <ul class="menu-overflow">
                        <li class="active"><a href="{{ route('home') }}">Trang ch???</a></li>
                        <li><a href="{{ route('shop-new') }}">H??ng m???i v???</a></li>
                        <li><a href="{{ route('shop') }}">Tr??</a>
                        </li>
                        <li><a href="{{ route('blog') }}">Tin t???c</a></li>
                        <li><a href="{{ route('contact') }}">Li??n h???</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Mobile Menu Area End -->
    </header>
    <!-- Header Area End -->
    @yield('main');
    {{-- modal ????ng nh???p --}}
    <div id="dang-nhap" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close bg-green text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container p-5 text-center">
                        <h4>B???n ch??a ????ng nh???p</h4>
                        <a href="{{ route('dang-nhap') }}" class="btn btn-green text-white">????ng nh???p</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal ????ng nh???p --}}
    <!-- Footer Area Start -->
    <footer class="footer-area">
        <!-- Footer Top Area Start -->
        <div class="footer-top bg-4 pt-90 pb-120 ">
            <!-- Service Area Start -->
            <div class="service-area">
                <div class="container">
                    <div class="service-container">
                        <div class="service-content">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="single-service">
                                        <div class="service-image">
                                            <img src="{{ asset('/frontend/img/icon/rocket.png') }}" alt="">
                                        </div>
                                        <div class="service-text">
                                            <h3>Giao h??ng to??n qu???c</h3>
                                            <p>Giao h??ng tr??n to??n qu???c</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="single-service">
                                        <div class="service-image">
                                            <img src="{{ asset('/frontend/img/icon/money.png') }}" alt="">
                                        </div>
                                        <div class="service-text">
                                            <h3>Thanh to??n d??? d??ng</h3>
                                            <p>Thanh to??n khi nh???n h??ng</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="single-service">
                                        <div class="service-image">
                                            <img src="{{ asset('/frontend/img/icon/support.png') }}" alt="">
                                        </div>
                                        <div class="service-text">
                                            <h3>Hotline: 090 229 33 13</h3>
                                            <p>H??? tr??? t?? v???n 24/7</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Service Area End -->
            <!-- Footer Widget Area Start -->
            <div class="footer-widget-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget ft-logo">
                                <div class="footer-logo">
                                    @if($logo_footer==null)
                                    <a href="#"><img src="{{ asset('/uploads/Configs/logo_footer.png') }}" alt=""
                                        class="w-50"></a>
                                    @else
                                    <a href="#"><img src="{{ asset('/uploads/'. $logo_footer->value) }}" alt=""
                                            class="w-50"></a>
                                            @endif
                                </div>
                                @if($intro==null)
                                Gi???i thi???u v??? c??ng ty
                                @else
                                {!! $intro->value !!}
                                @endif
                                <div class="footer-text">
                                    <span><i class="icon icon-Pointer"></i>
                                        @if($address==null)
                                        Address : ?????a ch??? demo
                                        @else
                                        Address : {!! $address->value !!}
                                        @endif
                                    </span>
                                    <span><i class="icon icon-Phone"></i>
                                        @if($phone==null)
                                        Phone : ?????a ch??? demo
                                        @else
                                        Phone : {!! $phone->value !!}
                                        @endif
                                    </span>
                                    <span><i class="icon icon-Mail"></i>
                                        @if($email==null)
                                        Email : ?????a ch??? demo
                                        @else
                                        email : {!! $email->value !!}
                                        @endif
                                    </span>
                                </div>
                                {{-- <div class="social-icon">
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                    <a href="#"><i class="fa fa-flickr"></i></a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="single-footer-widget">
                                <h3>S???n ph???m</h3>
                                <ul class="footer-widget-list">
                                    <li><a href="">S???n ph???m m???i nh???t</a></li>
                                    {{-- <li><a href="shop.html">Best sales</a></li>
                                    --}}
                                    <li><a href="{{ route('shop') }}">C???a h??ng</a></li>
                                    @if (Auth::check())
                                        <li><a href="{{ route('dang-nhap') }}">????ng nh???p</a></li>
                                        <li><a href="{{ route('profile', Auth::user()->id) }}">T??i kho???n c???a t??i</a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('dang-ky') }}">????ng k??</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="single-footer-widget">
                                <h3>C??ng ty</h3>
                                <ul class="footer-widget-list">
                                    <li><a href="{{ route('contact') }}">Li??n h???</a></li>
                                    <li><a href="{{ route('shop') }}">C???a h??ng</a></li>
                                    <li><a href="{{ route('blog') }}">Tin t???c</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="single-footer-widget">
                                <h3>Facebook</h3>
                                <div class="instagram-image">
                                    <div class="col-inner">
                                        <script async="" defer="" crossorigin="anonymous"
                                            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&amp;version=v5.0">
                                        </script>
                                        <div class="fb-page fb_iframe_widget"
                                            data-href="https://www.facebook.com/forgetmenotteashop/" data-tabs=""
                                            data-width="280" data-height="" data-small-header="false"
                                            data-adapt-container-width="false" data-hide-cover="false"
                                            data-show-facepile="false" fb-xfbml-state="rendered"
                                            fb-iframe-plugin-query="adapt_container_width=false&amp;app_id=&amp;container_width=0&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Fforgetmenotteashop%2F&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=false&amp;small_header=false&amp;tabs=&amp;width=280">
                                            <span style="vertical-align: bottom; width: 280px; height: 130px;">
                                                <iframe name="f278dc05bb189c8" width="280px" height="1000px"
                                                    data-testid="fb:page Facebook Social Plugin"
                                                    title="fb:page Facebook Social Plugin" frameborder="0"
                                                    allowtransparency="true" allowfullscreen="true" scrolling="no"
                                                    allow="encrypted-media" src="
                                                        https://www.facebook.com/v5.0/plugins/page.php?adapt_container_width=false&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df73cbe7e905db4%26domain%3Dforgetmenotmart.com%26origin%3Dhttps%253A%252F%252Fforgetmenotmart.com%252Fffe63b4b3e71f4%26relation%3Dparent.parent&amp;container_width=0&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Fforgetmenotteashop%2F&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=false&amp;small_header=false&amp;tabs=&amp;width=280
                                                        "
                                                    style="border: none; visibility: visible; width: 280px; height: 130px;"
                                                    class="">
                                                </iframe>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Widget Area End -->
        </div>
        <!-- Footer Top Area End -->
        <!-- Footer Bottom Area Start -->
        <div class="footer-bottom-area pt-15 pb-30 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex col-md-6">
                        <div class="footer-text-bottom">
                            <p>Copyright &copy; <a href="#">Tran Van Hoan & Nguyen Thi Thanh Thuy</a>. All Rights
                                Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom Area End -->
    </footer>
    <!-- Footer Area End -->
    <!-- All js here -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"
        nonce="sT5Hk7WI"></script>
    <script src="{{ asset('/frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('/frontend/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('/frontend/js/main.js') }}"></script>
    {{-- submit form --}}
    <script>
        $('#page').change(function(event) {
            $('#submit').click();
        });
        $('#sort').change(function(event) {
            $('#submit').click();
        });
        $('#qty').change(function(event) {
            $('#submit').click();
        });
    </script>
    {{-- end submit form --}}
    <script>
        $("#addr").click( function(){
		if($(this).is(':checked') ){
			var old_addr = $("#old_addr").val();
			$("#new_addr").val(old_addr);
		}
        else{
            $("#new_addr").val('');
        }
	});
    </script>
</body>
</html>
