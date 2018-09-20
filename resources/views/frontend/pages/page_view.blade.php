@extends('frontend.layouts.default')

@section('meta_title', $page->meta_title)
@section('meta_keyword', $page->meta_keyword)
@section('meta_description', $page->meta_description)

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/menu4.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>{{ $page->name }}</h1>
                <span>{{ $page->short_description }}</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <!-- Shop products -->
    <section id="page-content" class="sidebar-right m-b-20">
        <div class="container">
            <div class="row">
                <!-- Content-->
                <div class="content col-md-9">
                    <div class="row m-b-20">
                        <div class="p-t-10 m-b-20">
                            <h3 class="m-b-20">{{ $page->name }}</h3>
                            {!! $page->description !!}
                        </div>
                    </div>
                </div>
                <div class="sidebar col-md-3">
                    <!--widget newsletter-->
                    @include('frontend.common.right_categories')
                    @include('frontend.common.right_brands')
                    @include('frontend.common.right_sale_products')
                    @include('frontend.common.right_product_tags')
                </div>
                <!-- end: Sidebar-->
            </div>
        </div>
    </section>
    <!-- end: Shop products -->
@endsection

@section('footer')

@endsection