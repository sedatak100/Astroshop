@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.config.edited') }}" method="post">
        @csrf
        <div class="main-container tabs-alpha">
            <ul class="nav nav-tabs tabs-alpha__nav-tabs">
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link active show" data-toggle="tab" href="#tab1">
                        <span class="ua-icon-settings tabs-alpha__tab-close-icon"></span> Genel
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab2">
                        <span class="ua-icon-pencil tabs-alpha__tab-close-icon"></span> Tema
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab3">
                        <span class="ua-icon-envelope tabs-alpha__tab-close-icon"></span> Mail
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab4">
                        <span class="ua-icon-image tabs-alpha__tab-close-icon"></span> Resimler
                    </a>
                </li>
            </ul>
            <div class="tab-content tabs-alpha__tab-content">
                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="stock_alert">Stok Uyarı Alt Limiti</label>
                            <input type="number" name="config[backend][stock_alert]" value="{{ old('config.backend.stock_alert', config('backend.stock_alert')) }}" class="form-control" id="stock_alert"/>
                        </div>
                        <div class="form-group">
                            <label for="customer_contract">Üyelik Sözleşmesi</label>
                            <select name="config[config][customer_contract]" id="footer_pages" class="form-control global-select2"
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.pages') }}"
                                    data-selected="{{ json_encode(old('config.config.customer_contract', config('config.customer_contract'))) }}">
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tax_show">Vergiler Dahil Fiyat Gösterilsin</label>
                                <select name="config[config][tax_show]">
                                    <option @if(old('config.config.tax_show', config('config.tax_show')) == 1) selected @endif value="1">@lang('backend/common.yes')</option>
                                    <option @if(old('config.config.tax_show', config('config.tax_show')) != 1) selected @endif value="0">@lang('backend/common.no')</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tax_show">Tamamlanan Sipariş Durumları</label>
                                <select name="config[config][status_completed][]" multiple>
                                    @foreach($order_status as $order_status)
                                        <option @if(in_array($order_status->id(), old('config.config.status_completed', (config('config.status_completed') ?? []))) !== false) selected @endif value="{{ $order_status->id() }}">{{ $order_status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza Telefon</label>
                                    <input type="text" name="config[store][phone]" value="{{ old('config.store.phone', config('store.phone')) }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza GSM</label>
                                    <input type="text" name="config[store][gsm]" value="{{ old('config.store.gsm', config('store.gsm')) }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza E-Mail</label>
                                    <input type="text" name="config[store][email]" value="{{ old('config.store.email', config('store.email')) }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza Adres</label>
                                    <textarea name="config[store][address]" class="form-control">{{ old('config.store.address', config('store.address')) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza Facebook</label>
                                    <input type="text" name="config[store][facebook]" value="{{ old('config.store.facebook', config('store.facebook')) }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza Twitter</label>
                                    <input type="text" name="config[store][twitter]" value="{{ old('config.store.twitter', config('store.twitter')) }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza Instagram</label>
                                    <input type="text" name="config[store][instagram]" value="{{ old('config.store.instagram', config('store.instagram')) }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="customer_contract">Mağaza Youtube</label>
                                    <input type="text" name="config[store][youtube]" value="{{ old('config.store.youtube', config('store.youtube')) }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="top_categories">Üst Menü Kategoriler</label>
                            <select name="config[theme][top_categories][]" id="top_categories" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.categories') }}"
                                    data-selected="{{ json_encode(old('config.theme.top_categories', config('theme.top_categories'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="home_poster">Anasayfa Slider</label>
                            <select name="config[theme][home_poster]" id="home_poster" class="form-control global-select2"
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.posters') }}"
                                    data-selected="{{ json_encode(old('config.theme.home_poster', config('theme.home_poster'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="home_categories">Anasayfa Kategoriler</label>
                            <select name="config[theme][home_categories][]" id="home_categories" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.categories') }}"
                                    data-selected="{{ json_encode(old('config.theme.home_categories', config('theme.home_categories'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="week_product">Haftanın Fırsat Ürünü</label>
                            <select name="config[theme][week_product]" id="week_product" class="form-control global-select2"
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.products') }}"
                                    data-selected="{{ json_encode(old('config.theme.week_product', config('theme.week_product'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="most_sales">Anasayfa En Çok Satılan Ürünler</label>
                            <select name="config[theme][most_sales][]" id="most_sales" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.products') }}"
                                    data-selected="{{ json_encode(old('config.theme.most_sales', config('theme.most_sales'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="home_campaign_product">Anasayfa Kampanyalı Ürünler</label>
                            <select name="config[theme][home_campaign_product][]" id="home_campaign_product" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.products') }}"
                                    data-selected="{{ json_encode(old('config.theme.home_campaign_product', config('theme.home_campaign_product'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="footer_pages">Alt Sol Sayfalar</label>
                            <select name="config[theme][footer_pages][]" id="footer_pages" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.pages') }}"
                                    data-selected="{{ json_encode(old('config.theme.footer_pages', config('theme.footer_pages'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="home_bank">Anasayfa Alt Bankalar</label>
                            <select name="config[theme][home_bank]" id="home_bank" class="form-control global-select2"
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.pages') }}"
                                    data-selected="{{ json_encode(old('config.theme.home_bank', config('theme.home_bank'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="home_delivered">Anasayfa Alt Teslimat Bilgileri</label>
                            <select name="config[theme][home_delivered]" id="home_delivered" class="form-control global-select2"
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.pages') }}"
                                    data-selected="{{ json_encode(old('config.theme.home_delivered', config('theme.home_delivered'))) }}">
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="icon_new">Ürün Liste Yeni İkonu</label>
                                <select name="config[theme][icon_new]" id="icon_new" class="form-control global-select2"
                                        data-placeholder="@lang('backend/common.choose')"
                                        data-url="{{ route('backend.api.search.icons') }}"
                                        data-selected="{{ json_encode(old('config.theme.icon_new', config('theme.icon_new'))) }}">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="home_page_middle">Anasayfa Astronomi Güncesi</label>
                                <select name="config[theme][home_page_middle]" id="home_page_middle" class="form-control global-select2"
                                        data-placeholder="@lang('backend/common.choose')"
                                        data-url="{{ route('backend.api.search.pages') }}"
                                        data-selected="{{ json_encode(old('config.theme.home_page_middle', config('theme.home_page_middle'))) }}">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_detail_icons">Ürün Detay İkonları</label>
                            <select name="config[theme][product_detail_icons]" id="product_detail_icons" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.icons') }}"
                                    data-selected="{{ json_encode(old('config.theme.product_detail_icons', config('theme.product_detail_icons'))) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="home_campaigns">Anasayfa Kampanyalı Ürünler</label>
                            <select name="config[theme][home_campaigns][]" id="home_campaigns" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.products') }}"
                                    data-selected="{{ json_encode(old('config.theme.home_campaigns', config('theme.home_campaigns'))) }}">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab3" role="tabpanel" aria-expanded="true">

                </div>
                <div class="tab-pane" id="tab4" role="tabpanel" aria-expanded="true">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="customer_contract">Ürün Listeleme</label>
                            <div class="input-group">
                                <div class="input-group-text">Genişik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][list][x]" value="{{ old('config.product_image.list.x', config('product_image.list.x')) }}" class="form-control" />
                                </div>
                                <div class="input-group-text">Yükseklik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][list][y]" value="{{ old('config.product_image.list.y', config('product_image.list.y')) }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_contract">Ürün Detayı</label>
                            <div class="input-group">
                                <div class="input-group-text">Genişik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][detail][x]" value="{{ old('config.product_image.list.x', config('product_image.detail.x')) }}" class="form-control" />
                                </div>
                                <div class="input-group-text">Yükseklik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][detail][y]" value="{{ old('config.product_image.list.y', config('product_image.detail.y')) }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_contract">Büyük Resim</label>
                            <div class="input-group">
                                <div class="input-group-text">Genişik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][big][x]" value="{{ old('config.product_image.big.x', config('product_image.big.x')) }}" class="form-control" />
                                </div>
                                <div class="input-group-text">Yükseklik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][big][y]" value="{{ old('config.product_image.big.y', config('product_image.big.y')) }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_contract">Küçük Resim</label>
                            <div class="input-group">
                                <div class="input-group-text">Genişik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][small][x]" value="{{ old('config.product_image.small.x', config('product_image.small.x')) }}" class="form-control" />
                                </div>
                                <div class="input-group-text">Yükseklik</div>
                                <div class="input-group-append">
                                    <input type="text" name="config[product_image][small][y]" value="{{ old('config.product_image.small.y', config('product_image.small.y')) }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
        </div>
    </form>
@endsection

@section('footer')

@endsection