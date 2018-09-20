@extends('frontend.layouts.default')

@section('meta_title', $category->meta_title)
@section('meta_keyword', $category->meta_keyword)
@section('meta_description', $category->meta_description)

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
                    <form id="filtre" action="{{ route('frontend.product.category.lists', ['seo_name' => $category->seo_name]) }}" method="get">
                        <nav>
                            <ul class="list list-lines">
                                <li>
                                    <div class="order-select">
                                        <h6>Anahtar Kelime</h6>
                                        <input type="text" name="f[name]" class="form-control input-sm" value="{{ Request::input('f.name') }}" placeholder="Ürün adı, anahtar kelime" />
                                    </div>
                                </li>
                                <li>
                                    <div class="order-select">
                                        <h6>Marka</h6>
                                        <select name="f[brand]">
                                            <option value="">Hepsi</option>
                                            @foreach($brands as $brand)
                                                <option @if(Request::input('f.brand') == $brand->seo_name) selected @endif value="{{ $brand->seo_name }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                @foreach($category->attributes as $i => $attribute)
                                    @if($attribute->type == 'select' && $attribute->categoryValues->count() > 0)
                                    <li>
                                        <div class="order-select">
                                            <h6>{{ $attribute->name }}</h6>
                                            <select name="f[attr_select][{{ $attribute->id() }}]">
                                                <option value="">Hepsi</option>
                                                @foreach($attribute->categoryValues as $value)
                                                    <option @if(Request::input('f.attr_select.' . $attribute->id()) == $value->value) selected @endif value="{{ $value->value }}">{{ $value->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    @elseif($attribute->type == 'between'  && $attribute->categoryValues->count() > 0)
                                    <li>
                                        <div class="order-select filter-nouislider">
                                            <h6>{{ $attribute->name }}</h6>
                                            <div id="example">
                                                <div class="noui-html5"></div>
                                                <input type="number"
                                                       name="f[attr_between][{{ $attribute->id() }}][1]"
                                                       min="{{ $attribute->categoryValues->sortBy('value')->first()->value }}"
                                                       max="{{ (floatval($attribute->categoryValues->sortByDesc('value')->first()->value)+1) }}"
                                                       class="noui-input-select">
                                                <input type="number"
                                                       name="f[attr_between][{{ $attribute->id() }}][2]"
                                                       min="{{ $attribute->categoryValues->sortBy('value')->first()->value }}"
                                                       max="{{ (floatval($attribute->categoryValues->sortByDesc('value')->first()->value)+1) }}"
                                                       class="noui-input-number">
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
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
                <h1>{{ $category->name }}</h1>
                <span>{{ $category->description }}</span>
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
                            <h4>{{ $category->name }}</h4>
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

        $('.filter-nouislider').each(function (i, e) {
            var $this_select = $(this).find('.noui-input-select');
            var select = document.getElementsByClassName('noui-input-select')[i];

            var html5Slider = document.getElementsByClassName('noui-html5')[i];

            noUiSlider.create(html5Slider, {
                start: [$this_select.prop('min') * 1, $this_select.prop('max') * 1],
                connect: true,
                range: {
                    'min': $this_select.prop('min') * 1,
                    'max': $this_select.prop('max') * 1,
                }
            });

            var inputNumber = document.getElementsByClassName('noui-input-number')[i];
            html5Slider.noUiSlider.on('update', function (values, handle) {
                var value = values[handle];
                if (handle) {
                    inputNumber.value = value;
                } else {
                    select.value = Math.round(value);
                }
            });

            select.addEventListener('change', function () {
                html5Slider.noUiSlider.set([this.value, null]);
            });
            inputNumber.addEventListener('change', function () {
                html5Slider.noUiSlider.set([null, this.value]);
            });
        });
    </script>

@endsection