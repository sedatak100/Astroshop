<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>@yield('site.title', 'BackOffice - MGA E-Commerce')</title>


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



    <script src="{{ asset('backend/js/ie.assign.fix.min.js') }}"></script>
</head>
<body class="p-front">


<div class="navbar navbar-light navbar-expand-lg p-front__navbar"> <!-- is-dark -->
    <a class="navbar-brand" href="/"><img src="{{ asset('backend/img/logo.png') }}" alt=""/></a>
    <a class="navbar-brand-sm" href="/"><img src="{{ asset('backend/img/logo-sm.png') }}" alt=""/></a>
</div>




<div class="p-front__content">
    <!-- Content -->
    @yield('content')
</div>

<footer class="p-front__footer">
    <span>2018 &copy; MGA Bilişim</span>
</footer>

<script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/vendor/simplebar/simplebar.js') }}"></script>
<script src="{{ asset('backend/vendor/text-avatar/jquery.textavatar.js') }}"></script>
<script src="{{ asset('backend/vendor/tippyjs/tippy.all.min.js') }}"></script>
<script src="{{ asset('backend/vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('backend/vendor/wnumb/wNumb.js') }}"></script>
<script src="{{ asset('backend/js/main.js') }}"></script>



<div class="sidebar-mobile-overlay"></div>

</body>
</html>
