@extends('frontend.layouts.default')

@section('meta_title', $product->meta_title)
@section('meta_keyword', $product->meta_keyword)
@section('meta_description', $product->meta_description)

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/5.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>{{ $product->name }}</h1>
                <span>{{ $product->brand->description }}</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')

    <!-- SHOP PRODUCT PAGE -->
    <section id="product-page" class="product-page p-b-0 ">
        <div class="container">
            <div class="product">
                <div class="row ">
                    <div class="col-md-5">
                        <div class="product-image">
                            <!-- Carousel slider -->
                            <div class="carousel dots-inside dots-dark arrows-visible arrows-only arrows-dark"
                                 data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn"
                                 data-animate-out="fadeOut" data-autoplay-timeout="2500" data-lightbox="gallery">
                                <a href="{{ $product->getImageUrl('big') }}" data-lightbox="image"
                                   title="{{ $product->name }}">
                                    <img alt="{{ $product->name }}"
                                         src="{{ $product->getImageUrl('detail') }}">
                                </a>
                                @if($product->images->count() > 0)
                                    @foreach($product->images as $image)
                                        <a href="{{ $image->getImageUrl('big') }}"
                                           data-lightbox="image"
                                           title="{{ $product->name }}">
                                            <img alt="{{ $product->name }}"
                                                 src="{{ $image->getImageUrl('detail') }}">
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ $product->getImageUrl('big') }}" data-lightbox="image"
                                       title="{{ $product->name }}">
                                        <img alt="{{ $product->name }}"
                                             src="{{ $product->getImageUrl('list') }}">
                                    </a>
                                @endif
                            </div>
                            <!-- Carousel slider -->
                        </div>
                    </div>

                    <div class="col-md-7 textcenter">
                        <div class="product-description">
                            <div class="product-category">
                                {{ $product->categories->count() > 0 ? $product->categories->first()->name : ''}}
                            </div>
                            <div class="product-title">
                                <h3>
                                    <a href="{{ route('frontend.product.brand.products', ['seo_name' => $product->brand->seo_name]) }}">
                                        {{ $product->brand->name }}
                                    </a>
                                </h3>
                            </div>
                            <div class="product-price"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if($product->currentCampaign)
                                    <div class="col-md-4 col-xs-4 m-b-10">
                                        <h2 class="m-t-15"><span class="label label-info @*spanleft*@"
                                                                 style="line-height: 2.363636em;padding: .5em .6em .5em;    border-radius: 12px 0 12px;">%{{ $product->currentCampaign->rate($product->calcPrice(), $product->currency_id) }}</span>
                                        </h2>
                                        <span class="product-sale-off">indirim</span>
                                    </div>
                                @endif
                                <div class="col-md-8 m-t-10 item-borders" style="padding-left: 20px;">
                                    <h6 style="margin-bottom: -0.499158em;">
                                        @if(config('config.tax_show') == 1)
                                            K.D.V Dahil Fiyatı
                                        @else
                                            K.D.V Hariç Fiyatı
                                        @endif
                                    </h6>
                                    @if($product->currentCampaign)
                                        <ins class="productpay">{{ $product->currentCampaign->priceFormat($product->tax_class_id, $product->currency_id) }}</ins>
                                        <br/>
                                        <del>{{ $product->priceFormat() }}</del>
                                    @else
                                        <ins class="productpay">{{ $product->priceFormat() }}</ins>
                                    @endif
                                </div>
                                <div class="col-md-12 item-borders" style="padding-left: 8px;">
                                    <div class="col-md-12 "><h6>Katalog No:&nbsp; {{ $product->serial_no2 }}</h6></div>
                                    <div class="col-md-12"><h6>Marka:&nbsp; {{ $product->brand->name }}</h6></div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 " style="width: 88%;">
                                            <h6 style="margin-left:-14px">Stok Durumu:
                                                @if($product->quantity > 0)
                                                    <span class="label label-success">&nbsp;</span>&nbsp;
                                                @else
                                                    <span class="label label-danger">&nbsp;</span>&nbsp;
                                                @endif
                                                {{ $stock_status->name }}
                                            </h6>
                                        </div>
                                        <div class="col-md-4 visible-xs">
                                            <h6 style="margin-left:-14px">Stok Durumu:&nbsp;
                                                @if($product->quantity > 0)
                                                    <span class="label label-success">&nbsp;</span>&nbsp;
                                                @else
                                                    <span class="label label-danger">&nbsp;</span>&nbsp;
                                                @endif
                                                {{ $stock_status->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form name="cart_add">
                                <input type="hidden" name="product_id" value="{{ $product->id() }}"/>
                                <div class="col-md-6">
                                    <h6>Adet Giriniz</h6>
                                    <div class="cart-product-quantity">
                                        <div class="quantity m-l-5">
                                            <input type="button" class="minus" onClick=azalt(8); value="-">
                                            <input type="text" class="qty" name="quantity" value="1" id="8"
                                                   readonly="readonly">
                                            <input type="button" class="plus" onClick=arttir(8); value="+">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn m-t-20">
                                        <i class="fa fa-shopping-cart"></i> Sepete Ekle
                                    </button>
                                </div>
                            </form>

                            <div class="col-md-6">
                                <a class="now-cart-add btn m-t-20" style="background-color: #5bc0de;border-color:#5bc0de;width: 47%;"
                                   href="#"><i class="fa fa-shopping-cart"></i> Hemen Al</a>
                            </div>

                            @if(!$product->currentCampaign && $product->currentDiscounts->count() > 0)
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        @foreach($product->currentDiscounts as $current_discount)
                                            <div>{{ $current_discount->quantity }} adet ve üzeri alımlarda
                                                <strong>{{ $current_discount->priceFormat($product->tax_class_id, $product->currency_id) }}</strong>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>


                        <div class="product-description">
                            <div class="seperator m-b-10"></div>
                            <p>
                                {{ nl2br($product->short_description) }}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="row m-b-20">
                    @if($product->downloads->count() > 0)
                        <div class="col-md-5">
                            @foreach($product->downloads as $download)
                                <a href="{{ Storage::disk('public')->url($download->filename) }}"
                                   target="_blank" class="btn"
                                   style="display:block;background-color: {{ $download->description }};border-color:#5bc0de;margin-top: 8px;">
                                    <i class="fa fa-download"></i> {{ $download->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if($product->icons->count() > 0)
                        <div class="col-md-7 m-t-30">
                            @foreach($product->icons as $icon)
                                <img class="img-responsive" src="{{ Storage::disk('public')->url($icon->image) }}"/>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div id="tabs-05" class="tabs border">
                    <ul class="tabs-navigation">
                        <li class="active"><a href="#tab1"><i class="fa fa-align-justify hidden-xs"></i>Açıklama</a>
                        </li>
                        @if($product->attributes->count() > 0)
                            <li><a href="#tab2"><i class="fa fa-info hidden-xs"></i>Özellikler</a></li>
                        @endif
                        @if($product->images->count() > 0)
                        <li><a href="#tab3"><i class="fa fa-video-camera hidden-xs"></i>Görseller</a></li>
                        @endif
                        <li><a href="#tab4"><i class="fa fa-credit-card hidden-xs"></i>Taksit Seçenekleri</a></li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab-pane active" id="tab1">
                            {!! $product->description !!}
                        </div>
                        @if($product->attributes->count() > 0)
                            <div class="tab-pane" id="tab2">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    @foreach($product->attributes as $attribute)
                                        <tr>
                                            <td>{{ $attribute->name }}</td>
                                            <td>{{ $attribute->value }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if($product->images->count() > 0)
                        <div class="tab-pane" id="tab3">
                            <div class="col-md-9 ">
                            @foreach($product->images as $image)
                                <img alt="{{ $product->name }}" src="{{ $image->getImageUrl('big') }}" />
                            @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="tab-pane" id="tab4">
                            <div class="table table-condensed table-striped table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="cart-credit-thumbnail text-center"></th>
                                        <th class="cart-credit-thumbnail text-center"
                                            style="background-color: lightgoldenrodyellow" colspan="2"><img
                                                    src="/Contents/astromed_content/images/axess1.png" alt=""></th>
                                        <th class="cart-credit-thumbnail text-center"
                                            style="background-color: mediumpurple;" colspan="2"><img
                                                    src="/Contents/astromed_content/images/world1.png" alt=""></th>
                                        <th class="cart-credit-thumbnail text-center"
                                            style="background-color: greenyellow;" colspan="2"><img
                                                    src="/Contents/astromed_content/images/bonus1.png" alt=""></th>
                                        <th class="cart-credit-thumbnail text-center"
                                            style="background-color: aliceblue;" colspan="2"><img
                                                    src="/Contents/astromed_content/images/halk1.png" alt=""></th>
                                    </tr>
                                    <tr>
                                        <th class="cart-product-thumbnail">Taksit Adeti</th>
                                        <th class="cart-product-thumbnail">Taksit Tutarı</th>
                                        <th class="cart-product-thumbnail">Toplam Tutar</th>
                                        <th class="cart-product-thumbnail">Taksit Tutarı</th>
                                        <th class="cart-product-thumbnail">Toplam Tutar</th>
                                        <th class="cart-product-thumbnail">Taksit Tutarı</th>
                                        <th class="cart-product-thumbnail">Toplam Tutar</th>
                                        <th class="cart-product-thumbnail">Taksit Tutarı</th>
                                        <th class="cart-product-thumbnail">Toplam Tutar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">2 Taksit</div>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848 TL</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">3 Taksit</div>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848 TL</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">3 Taksit</div>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span class="yok-table">Taksit Yok</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848 TL</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">4 Taksit</div>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span class="yok-table">Taksit Yok</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848 TL</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">5 Taksit</div>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span class="yok-table">Taksit Yok</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848 TL</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">6 Taksit</div>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span class="yok-table">Taksit Yok</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span class="yok-table">Taksit Yok</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848  TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-description">
                                            <p class="ilk">
                                                <span>424 TL</span>
                                            </p>
                                        </td>
                                        <td class="cart-product-thumbnail">
                                            <p class="ilk">
                                                <span class="red-table">848 TL</span>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end: SHOP WISHLIST -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- end: SHOP PRODUCT PAGE -->

    @if($product->similars->count() > 0)
        <!-- SHOP WIDGET PRODUTCS -->
        <section class="p-t-0">
            <div class="container">
                <div class="heading-fancy heading-line text-center">
                    <h4>İlginizi Çekebilir !</h4>
                </div>
                <div class="row">
                    @foreach($product->similars as $i => $similar)
                        @if($i % 2 == 0)
                            <div class="col-md-4">
                                <div class="widget-shop">
                                    @endif
                                    <div class="product">
                                        <div class="product-image">
                                            <a href="{{ route('frontend.product.view', ['seo_name' => $similar->seo_name]) }}">
                                                <img src="{{ $similar->getImageUrl('list') }}"
                                                     alt="{{ $similar->name }}">
                                            </a>
                                        </div>
                                        <div class="product-description">
                                            <div class="product-category">{{ $similar->categories->first()->name }}</div>
                                            <div class="product-title">
                                                <h3>
                                                    <a href="{{ route('frontend.product.view', ['seo_name' => $similar->seo_name]) }}">{{ $similar->name }}</a>
                                                </h3>
                                            </div>
                                            <div class="product-price">
                                                @if($similar->currentCampaign)
                                                    <del>{{ $similar->priceFormat() }}</del>
                                                    <ins>{{ $similar->currentCampaign->priceFormat($similar->tax_class_id, $similar->currency_id) }}</ins>
                                                @else
                                                    <ins>{{ $similar->priceFormat() }}</ins>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($i % 2 != 0)
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end: SHOP WIDGET PRODUTCS -->
    @endif
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('frontend/js/product.view.js') }}"></script>
@endsection