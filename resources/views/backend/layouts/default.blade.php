<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('site.description', 'MGA E-Commerce Yönetim Paneli')">
    <meta name="keywords" content="@yield('site.keywords', 'mgabilisim.com.tr, mga, ankara web tasarım')">
    <title>@yield('site.title', 'BackOffice - MGA E-Commerce')</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('backend/vendor/prism/prism.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/fonts/open-sans/style.min.css') }}"> <!-- common font  styles  -->
    <link rel="stylesheet" href="{{ asset('backend/fonts/universe-admin/style.css') }}"> <!-- universeadmin icon font styles -->
    <link rel="stylesheet" href="{{ asset('backend/fonts/mdi/css/materialdesignicons.min.css') }}"> <!-- meterialdesignicons -->
    <link rel="stylesheet" href="{{ asset('backend/fonts/iconfont/style.css') }}"> <!-- DEPRECATED iconmonstr -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/flatpickr/flatpickr.min.css') }}"> <!-- original flatpickr plugin (datepicker) styles -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/simplebar/simplebar.css') }}"> <!-- original simplebar plugin (scrollbar) styles  -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/tagify/tagify.css') }}"> <!-- styles for tags -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/tippyjs/tippy.css') }}"> <!-- original tippy plugin (tooltip) styles -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}"> <!-- original select2 plugin styles -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}"> <!-- original bootstrap styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.min.css') }}" id="stylesheet"> <!-- universeadmin styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}" id="stylesheet">
    <style type="text/css">
        .sidebar-section .simplebar-content, .sidebar-section__invite-block{
            display: block !important;
        }
    </style>
    <script type="text/javascript">
        // GC = GLOBAL CONFIG
        var GC = {
            csrf : "{{ csrf_token() }}",
            url : {
                asset: "{{ asset('') }}",
                storage_public: "{{ Storage::disk('public')->url('') }}",
                storage_images: "{{ Storage::disk('images')->url('') }}",
                backend_api_region_countries : "{{ route(('backend.api.region.countries')) }}",
                backend_api_region_cities_by_country : "{{ route(('backend.api.region.cities_by_country')) }}",
                backend_api_region_districts_by_city: "{{ route(('backend.api.region.districts_by_city')) }}",
                backend_api_region_district_city_country: "{{ route(('backend.api.region.district_city_country')) }}",
            },
            lang : {
                choose_country : 'Ülke Seçiniz',
                choose_city : 'Şehir Seçiniz',
                choose_district : 'İlçe Seçiniz',
            },
            current_name: "{{ Route::currentRouteName() }}"
        }
    </script>

    <!-- Page Header -->
    @yield('header')

    <script src="{{ asset('backend/js/ie.assign.fix.min.js') }}"></script>
</head>
<body class="js-loading "> <!-- add for rounded corners: form-controls-rounded -->



<div class="page-preloader js-page-preloader">
    <div class="page-preloader__logo">
        <img src="{{ asset('backend/img/logo-black-lg.png') }}" alt="" class="page-preloader__logo-image">
    </div>
    <div class="page-preloader__desc">@lang('backend/layouts/default.loading_desc')</div>
    <div class="page-preloader__loader">
        <div class="page-preloader__loader-heading">@lang('backend/layouts/default.loading')</div>
        <div class="page-preloader__loader-desc">@lang('backend/layouts/default.loading_sub_title')</div>
        <div class="progress progress-rounded page-preloader__loader-progress">
            <div id="page-loader-progress-bar" class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="page-preloader__copyright">@lang('backend/layouts/default.loading_footer')</div>
</div>


<div class="navbar navbar-light navbar-expand-lg">
    <button class="sidebar-toggler" type="button">
        <span class="ua-icon-sidebar-open sidebar-toggler__open"></span>
        <span class="ua-icon-alert-close sidebar-toggler__close"></span>
    </button>

    <span class="navbar-brand">
    <a href="{{ route('backend.home.index') }}"><img src="{{ asset('backend/img/logo.png') }}" alt="" class="navbar-brand__logo"></a>
  </span>

    <span class="navbar-brand-sm">
    <a href="{{ route('backend.home.index') }}"><img src="{{ asset('backend/img/logo-sm.png') }}" alt="" class="navbar-brand__logo"></a>
    <span class="ua-icon-menu slide-nav-toggle"></span>
  </span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="ua-icon-navbar-open navbar-toggler__open"></span>
        <span class="ua-icon-alert-close navbar-toggler__close"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-collapse">
        <div class="navbar__menu">
        </div>

        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ route('backend.logout') }}">
                Çıkış Yap
            </a>
        </div>
    </div>
</div>




<div class="page-wrap">

    <div class="sidebar-section">
        <!-- class="sidebar-section__scroll" -->
        <div class="sidebar-section__scroll">
           <div class="sidebar-section__user has-background">
              <div class="dropdown sidebar-section__user-dropdown">
                <a class="dropdown-toggle sidebar-section__user-dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ Auth::user()->fullname() }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('frontend.home.index') }}" target="_blank">Siteyi Görüntüle</a>
                  <a class="dropdown-item" href="{{ route('backend.logout') }}">Çıkış Yap</a>
                </div>
              </div>
            </div>
            <div>
                <div class="sidebar-section__separator">Menu</div>
                @foreach($left_menus as $left_menu)
                <ul class="sidebar-section-nav">
                    <li class="sidebar-section-nav__item">
                        <a class="sidebar-section-nav__link @if($left_menu['children']) sidebar-section-nav__link-dropdown @endif" href="{{ $left_menu['link'] }}">
                            <span class="sidebar-section-nav__item-icon {{ $left_menu['icon'] }}"></span>
                            <span class="sidebar-section-nav__item-text">{{ $left_menu['name'] }}</span>
                        </a>
                        @if($left_menu['children'])
                        <ul class="sidebar-section-subnav">
                            @foreach($left_menu['children'] as $child1)
                            <li class="sidebar-section-subnav__item">
                                <a class="sidebar-section-subnav__link @if(in_array(Route::currentRouteName(), $child1['selected'])) is-active @endif" href="{{ $child1['link'] }}">
                                    {{ $child1['name'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>



    <div class="page-content">

        <div class="container-fluid container-fh">
            <div class="page-content__header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">@lang('backend/common.home')</a>
                        </li>
                        @if(isset($breadcrumbs))
                            @foreach($breadcrumbs as $i => $breadcrumb)
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ol>
                </div>
            </div>
            @include('backend.common.form_error_alert')
            <!-- Content -->
            @yield('content')
        </div>

    </div>
</div>

<script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/vendor/simplebar/simplebar.js') }}"></script>
<script src="{{ asset('backend/vendor/text-avatar/jquery.textavatar.js') }}"></script>
<script src="{{ asset('backend/vendor/tippyjs/tippy.all.min.js') }}"></script>
<script src="{{ asset('backend/vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('backend/vendor/wnumb/wNumb.js') }}"></script>
<script src="{{ asset('backend/vendor/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script src="{{ asset('backend/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/js/slug.js') }}"></script>

<script src="{{ asset('backend/vendor/prism/prism.js') }}"></script>
<script src="{{ asset('backend/vendor/requirejs/require.js') }}"></script>
<script src="{{ asset('backend/js/growl-notification/growl-notification.js') }}"></script>
@component('backend.common.form_success_alert')@endcomponent


<script src="{{ asset('backend/js/main.js') }}"></script>
<script src="{{ asset('backend/js/app.js') }}"></script>
<!-- Page Footer -->
@yield('footer')

<div class="sidebar-mobile-overlay"></div>

</body>
</html>