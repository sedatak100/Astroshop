@extends('frontend.layouts.default')

@section('meta_title', $brand->meta_title)
@section('meta_keyword', $brand->meta_keyword)
@section('meta_description', $brand->meta_description)

@section('header')
    <script src="{{ asset('frontend/js/nouislider.js') }}"></script>
    <link href="{{ asset('frontend/css/nouislider.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Begin: Filter -->
    <div id="side-panel" class="text-center">
        <div id="close-panel">
            <i class="fa fa-close"></i>
        </div>
        <div class="side-panel-wrap m-t-10">
            <div class="logo">
                <h5>FİLTRELEME</h5>
            </div>
            <div id="mainMenu" class="menu-onclick menu-vertical">
                <div class="container">
                    <form id="filtre" action="{{ route('frontend.product.brand.products', ['seo_name' => $brand->seo_name]) }}" method="get">
                        <nav>
                            <ul class="list list-lines">
                                <li>
                                    <div class="order-select">
                                        <h6>Anahtar Kelime</h6>
                                        <input type="text"
                                               name="f[name]"
                                               class="form-control input-sm"
                                               value="{{ Request::input('f.name') }}"
                                               placeholder="Ürün adı, anahtar kelime"
                                               required />
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <ul>
                            <button class="btn btn-default" type="submit" id="form-submit">
                                <i class="fa fa-search"></i> FİLTRELE
                            </button>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Endof: Bilger -->
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/menu3.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>{{ $brand->name }}</h1>
                <span>{{ $brand->description }}</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')

    <!-- Shop products -->
    <section id="page-content" class="sidebar-right">
        <div class="container">
            <div class="row">
                <!-- Content-->
                <div class="content col-md-9">
                    <div class="row m-b-20">
                        <div class="col-md-3   animated visible shake">
                            <h4 class="">
                                <a id="side-panel-trigger" href="#" class="toggle-item" data-target="body" data-class="side-panel-active">
                                    <i class="fa fa-filter"></i>
                                    <i class="fa fa-close"></i>
                                    FİLTRE
                                </a>
                            </h4>
                            <div class="order-select">
                                <h6>Sırala</h6>
                                <form method="get">
                                    <select name="o[price]">
                                        <option value="">Varsayılan</option>
                                        <option @if(Request::input('o.price') == 'ASC') selected @endif value="{{ request()->fullUrlWithQuery(['o' => ['price' => 'ASC']]) }}">Fiyat En Düşük</option>
                                        <option @if(Request::input('o.price') == 'DESC') selected @endif value="{{ request()->fullUrlWithQuery(['o' => ['price' => 'DESC']]) }}">Fiyat En Yüksek</option>
                                    </select>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-9" style="text-align:center;">
                            <h4>{{ $brand->name }}</h4>
                        </div>
                    </div>
                    <!--Product list-->
                    @include('frontend.common.product_lists')
                    <!--End: Product list-->
                </div>
                <!-- end: Content-->
                <!-- Sidebar-->
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
    <script type="text/javascript">
        $('SELECT[NAME^="o"]').change(function () {
            location.href = $(this).val();
            return;
        });
    </script>
@endsection