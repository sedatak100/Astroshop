<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="shortcut icon" href="{{ asset('frontend/images/astroshoplogo16x16.png') }}">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,800,700,600|Montserrat:400,500,600,700|Raleway:100,300,600,700,800"
          rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Farsan|Montserrat|Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600i,700,700i&amp;subset=latin-ext"
          rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/css/color-variations/blue-dark.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/js/plugins/revolution/css/settings.css') }}"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/js/plugins/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/js/plugins/revolution/css/navigation.css') }}">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet"/>
    <link href="http://fonts.googleapis.com/css?family=Damion" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('frontend/vendor/growl/stylesheets/jquery.growl.css') }}" type="text/css" rel="stylesheet"/>
    <style id="fit-vids-style">
        .fluid-width-video-wrapper {
            width: 100%;
            position: relative;
            padding: 0;
        }

        .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <link href="{{ asset('frontend/css/normalize.css') }}" rel="stylesheet"/>
    <meta charset="utf-8"/>
    <meta http-equiv="Cache-control" content="public">
    <title>@yield('meta_title', __('frontend/seo.meta_title'))</title>
    <meta name="keywords" content="@yield('meta_keyword', __('frontend/seo.meta_keyowrd'))"/>
    <meta name="description" content="@yield('meta_description', __('frontend/seo.meta_description'))"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Facebook Meta Tag-->
    <meta property="og:description" content="@yield('facebook.description', __('frontend/seo.fb_description'))"/>
    <meta property="og:title" content="@yield('facebook.title', __('frontend/seo.fb_title'))"/>
    <meta property="og:image" content="@yield('facebook.image', __('frontend/seo.fb_image'))"/>
    <meta property="og:url" content="@yield('facebook.url', __('frontend/seo.fb_url'))"/>
    <meta property="og:site_name" content="@yield('facebook.site_name', __('frontend/seo.fb_site_name'))">
    <meta property="og:locale" content="@yield('facebook.locale', __('frontend/seo.fb_locale'))">
    <meta property="og:author" content="@yield('facebook.author', __('frontend/seo.fb_author'))">
    <meta property="og:type" content="@yield('facebook.type', __('frontend/seo.fb_type'))">
    <!--Facebook Meta Tag-->
    <!-- Twitter Meta -->
    <meta name="twitter:site" content="@yield('twitter.site', __('frontend/seo.twitter_site'))">
    <meta name="twitter:title" content="@yield('twitter.title', __('frontend/seo.twitter_title'))">
    <meta name="twitter:description" content="@yield('twitter.description', __('frontend/seo.twitter_description'))">
    <meta name="twitter:creator" content="@yield('twitter.creator', __('frontend/seo.twitter_creator'))">
    <meta name="twitter:image:src" content="@yield('twitter.image', __('frontend/seo.twitter_image'))">
    <meta name="twitter:domain" content="@yield('twitter.domain', __('frontend/seo.twitter_domain'))">
    <!-- // Twitter Meta -->

    <meta name="abstract" content="@yield('meta_abstract', __('frontend/seo.meta_abstract'))"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta name="copyright" content="@yield('copyright', __('frontend/seo.copyright'))"/>
    <meta name="publisher" content="@yield('publisher', __('frontend/seo.publisher'))"/>
    <meta name="robots" content="all"/>
    <meta name="robots" content="index"/>
    <meta name="robots" content="follow"/>
    <meta name="audience" content="all"/>
    <meta name="language" content="tr"/>
    <meta name="REVISIT-AFTER" content="1 days"/>
    <meta name="rating" content="All"/>
    <meta name="robots" content="all"/>
    <meta http-equiv="Reply-to" content="work@medyamod.com"/>
    <meta http-equiv="expires" content="1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script type="text/javascript">
        var GC = {
            csrf: "{{ csrf_token() }}",
            url: {
                asset: "{{ asset('') }}",
                storage_public: "{{ Storage::disk('public')->url('') }}",
                storage_images: "{{ Storage::disk('images')->url('') }}",
                cart_basket_logged: "{{ route('frontend.cart.basket.logged') }}",
                cart_add: "{{ route(('frontend.cart.add')) }}",
                cart_remove: "{{ route(('frontend.cart.remove')) }}",
                cart_update_multiple: "{{ route(('frontend.cart.update_multiple')) }}",
                region_countries: "{{ route(('frontend.xhr.region.countries')) }}",
                region_cities_by_country: "{{ route(('frontend.xhr.region.cities_by_country')) }}",
                region_districts_by_city: "{{ route(('frontend.xhr.region.districts_by_city')) }}",
                region_district_city_country: "{{ route(('frontend.xhr.region.district_city_country')) }}",
            },
            lang: {
                choose_country: 'Ülke Seçiniz',
                choose_city: 'Şehir Seçiniz',
                choose_district: 'İlçe Seçiniz',
            },
            current_name: "{{ Route::currentRouteName() }}"
        }
    </script>

    <!-- Mobile Metas -->
    @yield('header')
</head>
<body id="bdy " class="side-panel side-panel-push ">
<div id="{{ (in_array(\Route::currentRouteName(), ['frontend.product.category.lists', 'frontend.product.search.lists', 'frontend.product.brand.products']) === false) ? 'wrapper' : '' }}">
    <!-- TOPBAR -->
    <!-- end: TOPBAR -->
    <div id="topbar" class="sticky-active colored" style="background-color: #004a94">
        <div class="container">
            @guest
                <div class="topbar-dropdown  float-right ">
                    <div class="title">
                        <i class="fa fa-sign-in" style="color:#fff"></i>
                        <a href="{{ route('frontend.login') }}" style="color:#fff">Bayii Girişi</a>
                    </div>
                    <div class="topbar-form dropdown-invert">
                        <form action="{{ route('frontend.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="sr-only">Email Adresiniz</label>
                                <input type="email" name="email" class="form-control" placeholder="E-Mail" required/>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Şifreniz</label>
                                <input type="password" name="password" class="form-control" placeholder="Şifreniz"
                                       required/>
                            </div>
                            <div class="form-inline form-group" style="line-height: 22px;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1"/>
                                        <small style="color:#000;"> Beni Hatırla</small>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block ">Giriş</button>
                                <a href="{{ route('frontend.register') }}" class="btn btn-outline btn-block"
                                   style="color:#004a94;">
                                    Üye Ol
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @endguest
            <div class="topbar-dropdown  float-right">
                @auth
                    <div class="title" style="border-left:none">
                        <i class="fa fa-user" style="color:#fff"></i>
                        <a href="#" style="color:#fff">{{ auth()->user()->fullname() }}</a>
                    </div>
                    <div class="topbar-form dropdown-invert" style="padding-bottom: 0px !important;">
                        <div class="form-group" style="line-height: 22px;">
                            <!-- Footer widget area 2 -->
                            <div class="widget" style="margin-bottom: 0 !important;">
                                <a href="{{ route('frontend.account.view') }}" style="text-align:center;">
                                    <h4>{{ auth()->user()->fullname() }}</h4>
                                </a>
                                <div class="seperator right" style="margin: 0px 28px 2px 36px;"><i
                                            class="fa fa fa-cog"></i>
                                </div>
                                <ul class="list-icon" style="margin-bottom: 0px !important;">
                                    <li>
                                        <i class="fa fa-user-circle-o siyah"></i> <a
                                                href="{{ route('frontend.account.view') }}">Profilim</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-shopping-basket siyah"></i>
                                        <a href="{{ route('frontend.account.order.lists') }}">Siparişlerim</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope siyah"></i>
                                        <a href="{{ route('frontend.account.ticket.lists') }}">Destek</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-sign-out siyah"></i> <a  href="{{ route('frontend.logout') }}">Çıkış
                                            Yap</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end: Footer widget area 2 -->
                        </div>
                    </div>
                @else
                    <div class="title" style="border-left:none">
                        <i class="fa fa-user" style="color:#fff"></i>
                        <a href="{{ route('frontend.login') }}" style="color:#fff">Üye Girişi</a>
                    </div>
                    <div class="topbar-form dropdown-invert">
                        <form action="{{ route('frontend.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="sr-only">Email Adresiniz</label>
                                <input type="email" name="email" class="form-control" placeholder="E-Mail" required/>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Şifreniz</label>
                                <input type="password" name="password" class="form-control" placeholder="Şifreniz"
                                       required/>
                            </div>
                            <div class="form-inline form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1"/>
                                        <small style="color:#000;"> Beni Hatırla</small>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block ">Giriş</button>
                                <a href="{{ route('frontend.register') }}" class="btn btn-outline btn-block"
                                   style="color:#004a94;">
                                    Üye Ol
                                </a>
                            </div>
                        </form>
                    </div>
                @endauth
            </div>
            <div class="topbar-dropdown float-right ">
                <div class="title" style="border-left:none">
                    <i class="fa fa-shopping-cart" style="color:#fff"></i>
                    <a href="{{ route('frontend.cart.basket.view') }}" style="color:#fff">Sepetim ({{ Cart::getContent()->count() }})</a>
                </div>
            </div>
        </div>
    </div>
    <header id="header" class="header-sticky-resposnive">
        <!--Logo-->
        <div id="header-wrap">
            <div class="container">
                <div id="logo1" class="left"
                     style="margin-left:0px; position: absolute; z-index: 100; margin-top: 18px;">
                    <a id="menu-overlay-trigger" href="#" class="lines-button x toggle-item" data-target="body"
                       data-class="menu-overlay-active">
                        <button type="button" class="btn btn-light btn-shadow" onclick="searchgizle();"><span
                                    class="lines"></span></button>
                    </a>
                </div>
                <div id="logo" style="margin-left: 98px;">
                    <a href="/" class="logo" data-logo="{{ asset('frontend/images/logo-3.png') }}"
                       style="float:none; z-index: 99;">
                        <img src="{{ asset('frontend/images/logo-3.png') }}" alt="">
                    </a>
                </div>
                <div id="top-search" class="">
                    <form action="{{ route('frontend.product.search.lists') }}" method="get">
                        <input type="text" class="form-control" name="term" value="{{ Request::input('term') }}"
                               placeholder="Marka,Model,Kategori giriniz.">
                    </form>
                </div>
                <div class="header-extras visible-xs visible-sm">
                    <ul>
                        <li>
                            <a id="top-search-trigger" href="#" class="toggle-item">
                                <i class="fa fa-search" onclick="logogizle();"></i>
                                <i class="fa fa-close" onclick="logoac();"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="header-extras">
                    <form action="{{ route('frontend.product.search.lists') }}" method="get">
                        <div id="searchdestkop" class="input-group header-extras hidden-xs hidden-sm"
                             style="width:300px;margin-top: 18px;">
                            <input type="text" class="form-control" id="inputGroupSuccess1"
                                   name="term"
                                   value="{{ Request::input('term') }}"
                                   aria-describedby="inputGroupSuccess1Status"
                                   style="border-bottom-left-radius: 18px; border: 2px solid #eeeeee;"
                                   placeholder="Marka,Model,Kategori giriniz.">
                            <span class="input-group-addon">
                            <button type="submit" class="submit" style="border: none">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </form>
                </div>
                <div id="mainMenu" class="menu-overlay menu-light menu-onclick">
                    <div class="container">
                        <nav style="background-image: url('{{ asset('frontend/images/mebu-space.png') }}'); background-size: 100% 118%;">
                            <ul>
                                @foreach($top_categories as $top_category)
                                    <li>
                                        <a href="{{ route('frontend.product.category.lists', ['seo_name' => $top_category->seo_name]) }}">
                                            {{ $top_category->name }}
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('frontend.contact.form') }}">İletişim</a>
                                </li>
                                <li>
                                    <div class="seperator " style="width: 45% ;margin-top: 2px;"></div>
                                </li>
                                <li>
                                    <div class="container menu-overlay-eleman-tel" style="margin-left: 42%;">
                                        <div class="topbar-dropdown" style="">
                                            <div class="title"><i class="fa fa-envelope" style="color:#fff"></i><a
                                                        href="#" style="color:#fff">Mail</a></div>
                                            <div class="topbar-form  menu-hover-eleman"
                                                 style="margin-top:-211% !important;padding: 20px 20px 0px 20px;width: 210px;">
                                                <div class="form-group">
                                                    <p><i class="fa fa-envelope"></i> <a
                                                                href="mailto:{{ config('store.email') }}">{{ config('store.email') }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="topbar-dropdown ">
                                            <div class="title"><i class="fa fa-phone" style="color:#fff"></i><a href="#"
                                                                                                                style="color:#fff">Telefon</a>
                                            </div>
                                            <div class="topbar-form  menu-hover-eleman"
                                                 style="margin-top:-138% !important;    padding: 20px 20px 0px 20px;width: 159px;right: -50px !important">
                                                <div class="form-group">
                                                    <p><i class="fa fa-phone"></i> {{ config('store.phone') }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="topbar-dropdown ">
                                            <div class="title"><i class="fa fa-map" style="color:#fff"></i><a href="#"
                                                                                                              style="color:#fff">Adres</a>
                                            </div>
                                            <div class="topbar-form  menu-hover-eleman"
                                                 style="padding: 0px 0px 0px 0px;margin-top: -238% !important;right: -30px !important;">
                                                <div class="form-group">
                                                    <div class="">
                                                        <!-- Google map sensor
                                                        <script type="text/javascript"
                                                                src="//maps.googleapis.com/maps/api/js?v=3.exp"></script>
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3061.9565089738453!2d32.87834161537948!3d39.87521207943171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d3455f3e58f701%3A0xca44726c0a96a08!2sBirlik+Mahallesi%2C+450.+Cadde+No%3A22%2C+06610+%C3%87ankaya%2FAnkara!5e0!3m2!1str!2str!4v1515422096694"
                                                                width="100%" height="150%" frameborder="0"
                                                                style="border:0" allowfullscreen></iframe>
                                                                -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Section -->
@yield('content')
<!-- end: Section -->

    <footer id="footer" class="footer-light. m-b-0">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3" style="text-align:center;">
                        <!-- Footer widget area 1 -->
                        <div class="widget clearfix widget-contact-us"
                             style="background-image: url('{{ asset('frontend/images/world-map-dark.png') }}'); background-position: 50% 20px; background-repeat: no-repeat">
                            <div class="align-center m-t-0 "><h4>ASTROSHOP BİR</h4></div>
                            <div id="logo">
                                <a href="http://www.astromed.com.tr/" class="logo m-t-0"
                                   data-logo="{{ asset('frontend/images/logo111.png') }}">
                                    <img src="{{ asset('frontend/images/logo111.png') }}" alt="Polo Lima"
                                         style="height:40%; width:50%">
                                </a>
                            </div>
                            <br/>
                            <div class="align-center"><h4>MARKASIDIR</h4></div>
                            <!-- end: Social icons -->
                        </div>
                        <!-- end: Footer widget area 1 -->
                    </div>
                    <div class="col-md-3" style="text-align:center;">
                        <!-- Footer widget area 2 -->
                        <div class="widget">
                            <a href="{{ route('frontend.contact.form') }}"><h4>İletişim</h4></a>
                            <ul class="list-icon">
                                <li>
                                    <i class="fa fa-map-marker"></i> {!! nl2br(config('store.address')) !!}
                                </li>
                                <li><i class="fa fa-phone"></i> {{ config('store.phone') }}</li>
                                <li>
                                    <i class="fa fa-envelope"></i> <a
                                            href="mailto:{{ config('store.email') }}">{{ config('store.email') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.contact.form') }}"
                                       class="btn btn-icon-holder btn-shadow btn-light-hover btn-light-hover"
                                       style="color:white">
                                        İletişim <i class="fa fa-envelope-open-o"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- end: Footer widget area 2 -->
                    </div>
                    <!-- Footer widget area 2 -->
                    <div class="col-md-3" style="text-align:center;">
                        <div class="widget">
                            <div id="logo">
                                <a href="/" class="logo" data-logo="{{ asset('frontend/images/logo-3.png') }}">
                                    <img src="{{ asset('frontend/images/logo-3.png') }}" alt="Polo Lima"
                                         style="height:40%; width:50%">
                                </a>
                            </div>
                            <!-- Social icons -->
                            <div class="social-icons social-icons-border  m-t-20" style="float:none;">
                                <h4>Bizi Takip Edin</h4>
                                <ul style="padding-left:22%">
                                    @if(config('store.facebook'))
                                        <li class="social-facebook"><a href="{{ config('store.facebook') }}"
                                                                       target="_blank"><i
                                                        class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(config('store.twitter'))
                                        <li class="social-twitter"><a href="{{ config('store.twitter') }}"
                                                                      target="_blank"><i class="fa fa-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if(config('store.instagram'))
                                        <li class="social-instagram"><a href="{{ config('store.instagram') }}"
                                                                        target="_blank"><i class="fa fa-instagram"></i></a>
                                        </li>
                                    @endif
                                    @if(config('store.youtube'))
                                        <li class="social-youtube"><a href="{{ config('store.youtube') }}"
                                                                      target="_blank"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end: Footer widget area 2 -->

                    <div class="col-md-3" style="text-align:center;">
                        <!-- Footer widget area 3 -->
                        @if($footer_pages)
                            <div class="widget">
                                <ul class="list-icon">
                                    @foreach($footer_pages as $i => $footer_page)
                                        <li>
                                            <a href="{{ route('frontend.page.view', ['seo_name' => $footer_page->seo_name]) }}">
                                                @if($i == 0)
                                                    <h4>{{ $footer_page->name }}</h4>@else{{ $footer_page->name }}@endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!-- end: Footer widget area 3 -->
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-content">
            <div class="container">
                <div class="copyright-text text-center">
                    &copy; 2018 DESIGN BY MEDYAMOD - TÜM HAKLARI SAKLIDIR
                    <a href="http://www.medyamod.com" target="_blank"></a>
                </div>
            </div>
        </div>
    </footer>
</div>

<!--Plugins-->
<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<!--Template functions-->
<script src="{{ asset('frontend/js/functions.js') }}"></script>
<!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/js/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="{{ asset('frontend/vendor/growl/javascripts/jquery.growl.js') }}"></script>
<script src="{{ asset('frontend/js/cart/cart.js') }}"></script>
<!-- Slider ayar  -->
<script type="text/javascript">
    var tpj = jQuery;

    var revapi33;
    tpj(document).ready(function () {
        if (tpj("#rev_slider_33_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_33_1");
        } else {
            revapi33 = tpj("#rev_slider_33_1").show().revolution({
                sliderType: "standard",
                jsFileLocation: "js/plugins/revolution/js/",
                sliderLayout: "fullwidth",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "on",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 50,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "ares",
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 600,
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        tmp: '<div class="tp-title-wrap">	<span class="tp-arr-titleholder">@{{title}}</span> </div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 0,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 0,
                            v_offset: 0
                        }
                    }
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1170, 1024, 778, 480],
                gridheight: [400, 400, 400, 400],
                lazyType: "smart",
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    });
    /*ready*/

</script>
<script>
    function arttir(deger) {
        document.getElementById(deger).value++;
    }

    function azalt(deger) {
        var dgr = document.getElementById(deger).value;
        if (dgr == 1) {
            document.getElementById(deger).value;
        } else {
            document.getElementById(deger).value--;
        }
    }
</script>
<script>
    var a = window.location.pathname;

    if (a == "/" || a == "/tr") {
        loop();
        $("#li1").addClass("active");
    }
    else if (a == "/profil") {
        loop();
        $("#li1").addClass("active");
    }
    else if (a == "/ayar") {
        loop();
        $("#li2").addClass("active");
    }
    else if (a == "/kargo") {
        loop();
        $("#li3").addClass("active");
    }
    else if (a == "/mesaj") {
        loop();
        $("#li4").addClass("active");
    }

    function loop() {
        for (var i = 1; i > 5; i++) {
            $("#li" + i).removeClass("active");
        }
    }
</script>
<script>
    var say = 0;

    function searchgizle() {

        if (say > 0) {
            $("#searchdestkop").removeClass("hidden");
            say = 0;
        }
        else if (say == 0) {
            $("#searchdestkop").addClass("hidden");
            say = say + 1;
        }
    }
</script>
<script>
    function logogizle() {
        $("#logo").addClass("hidden");
    }

    function logoac() {
        $("#logo").removeClass("hidden");
    }
</script>
@yield('footer')
</body>
</html>