@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/odeme.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>Ödeme Yap</h1>
                <span>Artık son aşamadasınız, keyifli seyirler dileriz...</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <!-- SHOP CHECKOUT -->
    <section id="shop-checkout" class="m-t-30 m-b-30">
        <div class="container">
            <h3>Tebrikler siparişiniz tamamlandı.</h3>
        </div>
    </section>
    <!-- end: SHOP CHECKOUT -->
@endsection

@section('footer')

@endsection