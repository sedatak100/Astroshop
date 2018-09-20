@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    @if($poster_group)
    <!-- SECTION REVOLUTION SLIDER -->
    <div id="slider">
        <div id="rev_slider_33_1_wrapper" class="background-grey rev_slider_wrapper fullwidthbanner-container"
             data-alias="polo-shop-v2"
             style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <!-- START REVOLUTION SLIDER 5.1 fullwidth mode -->
            <div id="rev_slider_33_1" class="rev_slider fullwidthabanner" style="display:none;height: 300px;"
                 data-version="5.1">
                <ul>
                @foreach($poster_group->posters as $i => $poster)
                    <!-- SLIDE  -->
                    <li data-index="rs-{{ $i }}" data-transition="slideup" data-slotamount="default" data-easein="default"
                        data-easeout="default" data-masterspeed="default" data-thumb="" data-rotate="0"
                        data-saveperformance="off" data-title="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="{{ Storage::disk('public')->url($poster->image2) }}" style='background-color:#f4f4f4'
                             alt="" width="482" height="800"
                             data-lazyload="{{ Storage::disk('public')->url($poster->image2) }}"
                             data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                             class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme" id="slide-{{ $i }}-layer-17"
                             data-x="['left','left','left','left']" data-hoffset="['-148','-137','-110','-219']"
                             data-y="['bottom','bottom','bottom','bottom']" data-voffset="['-99','-138','-6','-190']"
                             data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                             data-transform_in="x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:2360;e:Power3.easeInOut;"
                             data-transform_out="opacity:0;s:300;s:300;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                             data-start="0" data-responsive_offset="on" style="z-index: 5;">
                            <img src="{{ Storage::disk('public')->url($poster->image) }}" alt="" width="300"
                                 height="500" data-ww="['300px','300px','300px','450.8025']"
                                 data-hh="['500px','500px','500px','600']"
                                 data-lazyload="{{ Storage::disk('public')->url($poster->image) }}" data-no-retina
                                 style="margin-left: 89px!important;">
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme" id="slide-{{ $i }}-layer-18"
                             data-x="['right','right','right','center']" data-hoffset="['233','114','67','96']"
                             data-y="['top','top','top','top']" data-voffset="['206','123','194','60']"
                             data-fontsize="['24','24','24','16']" data-width="['345','345','345','259']"
                             data-height="none" data-whitespace="normal" data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2660;e:Power4.easeInOut;"
                             data-transform_out="opacity:0;s:300;e:Power2.easeInOut;s:300;e:Power2.easeInOut;"
                             data-start="0" data-splitin="none" data-splitout="none" data-responsive_offset="on"
                             style="z-index: 6; min-width: 345px; max-width: 345px; white-space: normal; font-size: 24px; color: rgba(255, 255, 255, 1.00);text-align:center;margin: -160px!important;">
                           {{ $poster->config }}
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-{{ $i }}-layer-1"
                             data-x="['right','center','center','center']" data-hoffset="['102','222','151','98']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-40','-76','-67','-69']"
                             data-fontsize="['120','100','90','60']" data-lineheight="['70','70','70','50']"
                             data-width="['576','none','none','none']" data-height="none"
                             data-whitespace="['normal','nowrap','nowrap','nowrap']" data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2570;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="320"
                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                             style="z-index: 7; min-width: 576px; max-width: 576px; white-space: normal; font-size: 120px; color: rgba(255, 255, 255, 1.00);">
                            {{ $poster->name }}
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption NotGeneric-SubTitle   tp-resizeme" id="slide-{{ $i }}-layer-4"
                             data-x="['right','center','center','center']" data-hoffset="['159','229','162','97']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['31','-8','0','-11']"
                             data-width="['470','none','none','301']" data-height="['none','none','none','35']"
                             data-whitespace="['normal','nowrap','nowrap','normal']" data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2180;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="930"
                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                             style="z-index: 8; min-width: 470px; max-width: 470px; white-space: normal; color: rgba(255, 255, 255, 1.00);text-align:center;">
                            {!! nl2br($poster->description) !!}
                        </div>
                        <!-- LAYER NR. 5 -->
                        <div class="tp-caption Fashion-BigDisplay  sldr tp-resizeme" id="slide-{{ $i }}-layer-11"
                             data-x="['right','right','right','right']" data-hoffset="['334','214','170','91']"
                             data-y="['top','top','top','top']" data-voffset="['400','310','369','220']"
                             data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1610;e:Power4.easeInOut;"
                             data-transform_out="opacity:0;s:300;s:300;" data-start="1590" data-splitin="none"
                             data-splitout="none" data-responsive_offset="on"
                             style="z-index: 9; white-space: nowrap;margin: -130px!important;">
                            <a href="{{ $poster->link }}" target="{{ $poster->target }}" class="btn btn-outline btn-light"><span>Hemen Al</span></a>
                        </div>
                    </li>
                    <!-- SLIDE  -->
                @endforeach
                </ul>
                <div class="tp-static-layers">
                </div>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
    </div>
    <!-- END SECTION REVOLUTION SLIDER -->
    @endif
    @if($categories->count() > 0)
    <section class="background-light m-t-30">
        <div class="container">
            <div class="hr-title hr-long center"><abbr>Ürün Kategorileri</abbr> </div>
            <div class="portfolio">
            <!-- sedatak100 testing converted --><!-- sedatak100 testing 2 -->
                <!-- Portfolio -->
                <div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="10">
                    @foreach($categories as $i => $category)
                    <!-- portfolio item -->
                    <div class="portfolio-item no-overlay img-zoom pf-illustrations pf-media pf-icons pf-Media @if($i == 2) large-width @endif">
                        <div class="portfolio-item-wrap">
                            <div class="portfolio-image">
                                <a href="{{ route('frontend.product.category.lists', ['seo_name' => $category->seo_name]) }}"><img src="{{ Storage::disk('public')->url($category->image) }}" alt=""></a>
                                <div class="shop-category-box-title text-center ctgry-sldr" @if($i == 2) style="height: 110px; vertical-align:middle" @endif>
                                    @if($i == 2) <br /> @endif
                                    <h6 class="cat">{{ $category->name }}</h6>
                                    <small>{{ $category->countProduct(1) }} ÜRÜN</small>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end: portfolio item -->
                    @endforeach
                </div>
                <!-- end: Portfolio -->
            </div>
        </div>
    </section>
    @endif
    @if($most_products->count() > 0)
    <section>
        <div class="container">
            <hr class="space">
            <!--Shop products Carousel -->
            <div class="hr-title hr-long center"><abbr>En Çok Satanlar </abbr></div>
            <div class="carousel" data-margin="20">
            @foreach($most_products as $product)
                <div class="product item-border">
                    <div class="product-image">
                        <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">
                            <img alt="{{ $product->name }}" src="{{ $product->getImageUrl('list') }}">
                            <div class="shop-category-box-title text-center fiyat">
                                @if($product->currentCampaign)
                                    <h4 style="text-decoration: line-through;">{{ $product->priceFormat() }}</h4>
                                    <h3>{{ $product->currentCampaign->priceFormat($product->tax_class_id, $product->currency_id) }}</h3>
                                @else
                                    <h3>{{ $product->priceFormat() }}</h3>
                                @endif
                            </div>
                        </a>
                        @if($product->icon(config('theme.icon_new')))
                            {!! $product->icon(config('theme.icon_new'))->icon !!}
                        @endif
                        <!--
                        <span class="product-wishlist">
                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                        </span>
                        -->
                    </div>
                    <div class="product-description">
                        <div class="product-category">
                            @if($product->categories->count() > 0)
                                {{ $product->categories->first()->name }}
                            @endif
                        </div>
                        <div class="product-title">
                            <h3>
                                <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">
                                    @if($product->brand)
                                        {{ $product->brand->name }},
                                    @endif
                                    {{ $product->model }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <!--END: Shop products Carousel -->
        </div>
    </section>
    @endif
    @if($week_product)
    <section class="m-t-50 m-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="hero-heading-2 background-colored text-light">
                        <i class="fa fa-bell-o"></i>
                        <h2 class="text-medium m-t-0">
                        <span class="text-rotator" data-rotate-effect="flipInX">
                            HAFTANIN FIRSATI
                        </span>
                        </h2>
                        @if($week_product->currentCampaign)
                            <div class="countdown rectangle small" data-countdown="{{ $week_product->currentCampaign->end_date }} 00:00:00"></div>
                        @endif
                        <div class="widget clearfix widget-newsletter " style="float: none;">
                            <form class="widget-subscribe-form form-inline" style="text-align:center;" action="" role="form" method="post">
                                <div class="input-group p-t-40">
                                    <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                    <input type="email" aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Email Adresinizi Giriniz">
                                    <span class="input-group-btn"><button type="submit" id="widget-subscribe-submit-button" class="btn btn-light">Gönder</button>
                                </span>
                                </div>
                                <small class="text-light">Fırsatlardan haberdar olmak için</small>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shop-promo-box text-right" style="background-image: url({{ $week_product->getImageUrl('list') }}); background-size: 50% 100%;">
                        @if($week_product->brand)
                            <h2>{{ $week_product->brand->name }}</h2>
                        @endif
                        <div class="product-description">
                            <div class="product-category">
                                @if($week_product->categories->count() > 0)
                                    {{ $week_product->categories->first()->name }}
                                @endif
                            </div>
                            <div class="product-title">
                                <h5><a href="{{ route('frontend.product.view', ['seo_name' => $week_product->seo_name]) }}">{{ $week_product->name }}</a></h5>
                            </div>
                            <div class="product-price">
                                @if($week_product->currentCampaign)
                                    <del>{{ $week_product->priceFormat() }}</del>
                                    <ins>{{ $week_product->currentCampaign->priceFormat($week_product->tax_class_id, $product->currency_id) }}</ins>
                                @else
                                    <ins>{{ $week_product->priceFormat() }}</ins>
                                @endif
                            </div>
                        </div>
                        <a class="btn btn-dark" href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">Hemen Al</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($page_middle)
        <section class="section-pattern p-t-60 p-b-30 text-center" style="background: url({{ asset('frontend/images/arka.png') }})">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h4 class="m-b-10">{{ $page_middle->name }}</h4>
                        <h2 class="m-b-10">{{ $page_middle->short_description }}</h2>
                        {!! $page_middle->description !!}
                    </div>
                    @if($page_middle->children->count() > 0)
                    <div class="col-md-6 col-md-offset-1 m-t-50">
                        {!! $page_middle->children->first()->short_description !!}
                    </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
    @if($campaigns)
    <section>
        <div class="container">
            <hr class="space">
            <!--Team Carousel -->
            <!--Post Carousel -->
            <div class="hr-title hr-long center"><abbr>Kampanyalı Ürünlerimiz</abbr></div>
            <div class="carousel" data-items="3" data-item="post-item" data-margin="20">
            @foreach($campaigns as $i => $product)
                <!-- Post item-->
                <div class="post-item border">
                    <div class="post-item-wrap">
                        <div class="post-slider">
                            <div class="carousel dots-inside arrows-visible arrows-only" data-items="1" data-loop="true"
                                 data-autoplay="true" data-lightbox="gallery">
                                <a href="{{ $product->getImageUrl('big') }}" data-lightbox="gallery-item">
                                    <img alt="" src="{{ $product->getImageUrl('list') }}" width="380">
                                </a>
                                @if($product->images->count() > 0)
                                    @foreach($product->images as $image)
                                        <a href="{{ $image->getImageUrl('big') }}" data-lightbox="gallery-item">
                                            <img alt="" src="{{ $image->getImageUrl('list') }}" width="380">
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ $product->getImageUrl('big') }}" data-lightbox="gallery-item">
                                        <img alt="" src="{{ $product->getImageUrl('list') }}" width="380">
                                    </a>
                                @endif
                            </div>
                            @if($product->currentCampaign)
                            <span class="post-meta-category">
                                <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">%{{ $product->currentCampaign->rate($product->calcPrice(), $product->currency_id) }} İndirim</a>
                            </span>
                            @endif
                        </div>
                        <div class="product-description" style="margin-left: 7%;">
                            <div class="product-category">
                                @if($product->categories->count() > 0)
                                    {{ $product->categories->first()->name }}
                                @endif
                            </div>
                            <div class="product-price">
                                @if($product->currentCampaign)
                                    <del>{{ $product->priceFormat() }}</del>
                                    <ins>{{ $product->currentCampaign->priceFormat($product->tax_class_id, $product->currency_id) }}</ins>
                                @else
                                    <ins>{{ $product->priceFormat() }}</ins>
                                @endif
                            </div>
                        </div>
                        <div class="post-item-description">
                            <h2><a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">{{ $product->name }}</a></h2>
                            <p>{{ $product->short_description }} </p>
                            <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}" class="item-link">Ürüne Git <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end: Post item-->
            @endforeach
            </div>

            <hr class="space">
            <!--END: Post Carousel -->

        </div>
    </section>
    @endif
    @if($home_banks)
    <!-- CLIENTS -->
    <section>
        <div class="container">
            <div class="carousel" data-items="6" data-items-sm="4" data-items-xs="3" data-items-xxs="2" data-margin="20" data-arrows="false" data-autoplay="true" data-autoplay-timeout="3000" data-loop="true">
            @foreach($home_banks as $home_bank)
            <div>
                <a href="#"><img alt="{{ $home_bank->name }}" src="{{ Storage::disk('public')->url($home_bank->image) }}"> </a>
            </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- END: CLIENTS -->
    @endif
    @if($home_deliveries)
        <section class="background-grey p-t-40 p-b-0">
            <div class="container">
                <div class="row">
                    @foreach($home_deliveries as $home_delivery)
                    <div class="col-md-3">
                        <div class="icon-box effect small clean">
                            <div class="icon">
                                <a href="#"><i class="{{ $home_delivery->icon }}"></i></a>
                            </div>
                            <h3>{{ $home_delivery->name }}</h3>
                            {!! $home_delivery->description !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>
@endsection

@section('footer')

@endsection