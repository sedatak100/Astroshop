@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.product.added') }}" method="post">
        @csrf
        <div class="main-container tabs-alpha" id="product-tabs">
            <ul class="nav nav-tabs tabs-alpha__nav-tabs">
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link active show" data-toggle="tab" href="#tab1">
                        <span class="ua-icon-settings tabs-alpha__tab-close-icon"></span> Genel
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab2">
                        <span class="ua-icon-inbox tabs-alpha__tab-close-icon"></span> Seo
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab3">
                        <span class="ua-icon-input tabs-alpha__tab-close-icon"></span> Içerik
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab4">
                        <span class="ua-icon-fm-links tabs-alpha__tab-close-icon"></span> Bağlantılar
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab5">
                        <span class="ua-icon-distributions tabs-alpha__tab-close-icon"></span> Özellikler
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab6">
                        <span class="ua-icon-arrow-circle-down tabs-alpha__tab-close-icon"></span> İndirimler
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab7">
                        <span class="ua-icon-download tabs-alpha__tab-close-icon"></span> Kampanyalar
                    </a>
                </li>
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab8">
                        <span class="ua-icon-image tabs-alpha__tab-close-icon"></span> Resimler
                    </a>
                </li>
            </ul>
            <div class="tab-content tabs-alpha__tab-content">
                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="name">Adı</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="write-seo form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" data-seo_id="seo_name"/>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="short_description">Kısa Açıklama</label>
                            <textarea name="short_description" class="form-control{{ $errors->has('short_description') ? ' is-invalid' : '' }}" id="short_description">{{ old('short_description') }}</textarea>
                            @if ($errors->has('short_description'))
                                <div class="invalid-feedback">{{ $errors->first('short_description') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea name="description" class="ckeditor{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="order">Sıra</label>
                            <input type="text" name="order" value="{{ old('order', "0") }}" class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}" id="order"/>
                            @if ($errors->has('order'))
                                <div class="invalid-feedback">{{ $errors->first('order') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                <option @if(old('status') == "0") selected
                                        @endif value="0">@lang('backend/common.status_0')</option>
                                <option @if(old('status') == "1") selected
                                        @endif value="1">@lang('backend/common.status_1')</option>
                            </select>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="seo_name">Seo Url</label>
                            <div class="input-group">
                                <input type="text" readonly name="seo_name" value="{{ old('seo_name') }}" class="form-control{{ $errors->has('seo_name') ? ' is-invalid' : '' }}" id="seo_name"/>
                                <div class="input-group-append">
                                    <a href="" class="seo-disable-input btn btn-warning" data-target="seo_name">
                                        <span class="ua-icon-pencil"></span>
                                    </a>
                                </div>
                            </div>
                            @if ($errors->has('seo_name'))
                                <div class="invalid-feedback">{{ $errors->first('seo_name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <textarea name="meta_title" class="form-control{{ $errors->has('meta_title') ? ' is-invalid' : '' }}" id="meta_title">{{ old('meta_title') }}</textarea>
                            @if ($errors->has('meta_title'))
                                <div class="invalid-feedback">{{ $errors->first('meta_title') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Açıklama</label>
                            <textarea name="meta_description" class="form-control{{ $errors->has('meta_description') ? ' is-invalid' : '' }}" id="meta_description">{{ old('meta_description') }}</textarea>
                            @if ($errors->has('meta_description'))
                                <div class="invalid-feedback">{{ $errors->first('meta_description') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control{{ $errors->has('meta_keyword') ? ' is-invalid' : '' }}" id="meta_keyword">{{ old('meta_keyword') }}</textarea>
                            @if ($errors->has('meta_keyword'))
                                <div class="invalid-feedback">{{ $errors->first('meta_keyword') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab3" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" name="model" value="{{ old('model') }}" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" id="model"/>
                            @if ($errors->has('model'))
                                <div class="invalid-feedback">{{ $errors->first('model') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="stock_code">Stok Kodu</label>
                            <input type="text" name="stock_code" value="{{ old('stock_code') }}" class="form-control{{ $errors->has('stock_code') ? ' is-invalid' : '' }}" id="stock_code"/>
                            @if ($errors->has('stock_code'))
                                <div class="invalid-feedback">{{ $errors->first('stock_code') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barkod</label>
                            <input type="text" name="barcode" value="{{ old('barcode') }}" class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}" id="barcode"/>
                            @if ($errors->has('barcode'))
                                <div class="invalid-feedback">{{ $errors->first('barcode') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="serial_no">Seri No</label>
                            <input type="text" name="serial_no" value="{{ old('serial_no') }}" class="form-control{{ $errors->has('serial_no') ? ' is-invalid' : '' }}" id="serial_no"/>
                            @if ($errors->has('serial_no'))
                                <div class="invalid-feedback">{{ $errors->first('serial_no') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="serial_no2">Seri No 2</label>
                            <input type="text" name="serial_no2" value="{{ old('serial_no2') }}" class="form-control{{ $errors->has('serial_no2') ? ' is-invalid' : '' }}" id="serial_no2"/>
                            @if ($errors->has('serial_no2'))
                                <div class="invalid-feedback">{{ $errors->first('serial_no2') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="serial_no3">Seri No 3</label>
                            <input type="text" name="serial_no3" value="{{ old('serial_no3') }}" class="form-control{{ $errors->has('serial_no3') ? ' is-invalid' : '' }}" id="serial_no3"/>
                            @if ($errors->has('serial_no3'))
                                <div class="invalid-feedback">{{ $errors->first('serial_no3') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price">Fiyat</label>
                            <input type="text" name="price" value="{{ old('price', "0") }}" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" id="price"/>
                            @if ($errors->has('price'))
                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="currency_id">Para Birimi</label>
                            <select name="currency_id" id="currency_id" class="form-control{{ $errors->has('currency_id') ? ' is-invalid' : '' }}">
                                @foreach($currencies as $currency)
                                    <option @if(old('currency_id', config('config.currency')) == $currency->id()) selected @endif value="{{ $currency->id() }}">{{ $currency->name }} ({{ $currency->code }})</option>
                                @endforeach
                            </select>
                            @if ($errors->has('currency_id'))
                                <div class="invalid-feedback">{{ $errors->first('currency_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quantity">Adet</label>
                            <input type="text" name="quantity" value="{{ old('quantity', "1") }}" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" id="quantity"/>
                            @if ($errors->has('quantity'))
                                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="min_quantity">Min Satış Adeti</label>
                            <input type="text" name="min_quantity" value="{{ old('min_quantity', "1") }}" class="form-control{{ $errors->has('min_quantity') ? ' is-invalid' : '' }}" id="min_quantity"/>
                            @if ($errors->has('min_quantity'))
                                <div class="invalid-feedback">{{ $errors->first('min_quantity') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="subtract">Stokdan Düş</label>
                            <select name="subtract" id="subtract" class="form-control{{ $errors->has('subtract') ? ' is-invalid' : '' }}">
                                <option @if(old('subtract') == "1") selected
                                        @endif value="1">@lang('backend/common.yes')</option>
                                <option @if(old('subtract') == "0") selected
                                        @endif value="0">@lang('backend/common.no')</option>
                            </select>
                            @if ($errors->has('subtract'))
                                <div class="invalid-feedback">{{ $errors->first('subtract') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="out_stock_status_id">Stokdan Dışı Durumu</label>
                            <select name="stock_status_id" id="stock_status_id" class="form-control{{ $errors->has('stock_status_id') ? ' is-invalid' : '' }}">
                                @foreach($stock_statuses as $stock_status)
                                    <option @if(old('stock_status_id', config('config.stock_status')) == $stock_status->id()) selected @endif value="{{ $stock_status->id() }}">{{ $stock_status->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('out_stock_status_id'))
                                <div class="invalid-feedback">{{ $errors->first('out_stock_status_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="subtract">Kargo Gerekli</label>
                            <select name="shipping" id="shipping" class="form-control{{ $errors->has('shipping') ? ' is-invalid' : '' }}">
                                <option @if(old('shipping') == "1") selected
                                        @endif value="1">@lang('backend/common.yes')</option>
                                <option @if(old('shipping') == "0") selected
                                        @endif value="0">@lang('backend/common.no')</option>
                            </select>
                            @if ($errors->has('shipping'))
                                <div class="invalid-feedback">{{ $errors->first('shipping') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tax_class_id">Vergi</label>
                            <select name="tax_class_id" id="tax_class_id" class="form-control{{ $errors->has('tax_class_id') ? ' is-invalid' : '' }}">
                                <option value="0">Yok</option>
                                @foreach($tax_classes as $tax_class)
                                    <option @if(old('tax_class_id', config('config.tax_class')) == $tax_class->id()) selected @endif value="{{ $tax_class->id() }}">{{ $tax_class->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tax_class_id'))
                                <div class="invalid-feedback">{{ $errors->first('tax_class_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="date_available">Geçerlilik Tarihi</label>
                            <div class="input-group datepicker">
                                <input type="text" name="date_available" value="{{ old('date_available') }}" class="form-control{{ $errors->has('date_available') ? ' is-invalid' : '' }}" id="date_available" data-input/>
                                <div class="input-group-append">
                                    <a class="btn btn-warning" title="clear" data-clear>
                                        <i class="ua-icon-minus-square-alt"></i>
                                    </a>
                                </div>
                                @if ($errors->has('date_available'))
                                    <div class="invalid-feedback">{{ $errors->first('date_available') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="length_id">Boyutlar (Uzunluk X Genişlik X Yükseklik)</label>
                            <div class="input-group">
                                <input type="text" name="length" value="{{ old('length', "0") }}" class="form-control{{ $errors->has('length') ? ' is-invalid' : '' }}" id="length" placeholder="Uzunluk"/>
                                <div class="input-group-append">
                                    <input type="text" name="width" value="{{ old('width', "0") }}" class="form-control{{ $errors->has('width') ? ' is-invalid' : '' }}" id="width" placeholder="Genişlik"/>
                                </div>
                                <div class="input-group-append">
                                    <input type="text" name="height" value="{{ old('height', "0") }}" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" id="height" placeholder="Yükselik"/>
                                </div>
                                <div class="input-group-append">
                                    <select name="length_id" id="length_id" class="form-control{{ $errors->has('length_id') ? ' is-invalid' : '' }}">
                                        @foreach($lengths as $length)
                                            <option @if(old('length_id', config('config.length')) == $length->id()) selected @endif value="{{ $length->id() }}">{{ $length->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('length'))
                                    <div class="invalid-feedback">{{ $errors->first('length') }}</div>
                                @endif
                                @if ($errors->has('width'))
                                    <div class="invalid-feedback">{{ $errors->first('width') }}</div>
                                @endif
                                @if ($errors->has('height'))
                                    <div class="invalid-feedback">{{ $errors->first('height') }}</div>
                                @endif
                                @if ($errors->has('length_id'))
                                    <div class="invalid-feedback">{{ $errors->first('length_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="weight_id">Ağırlık</label>
                            <div class="input-group">
                                <input type="text" name="weight" value="{{ old('weight', "0") }}" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" id="weight" placeholder="Ağırlık"/>
                                <div class="input-group-append">
                                    <select name="weight_id" id="weight_id" class="form-control{{ $errors->has('weight_id') ? ' is-invalid' : '' }}">
                                        @foreach($weights as $weight)
                                            <option @if(old('weight_id', config('config.weight')) == $weight->id()) selected @endif value="{{ $weight->id() }}">{{ $weight->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('weight'))
                                    <div class="invalid-feedback">{{ $errors->first('weight') }}</div>
                                @endif
                                @if ($errors->has('weight_id'))
                                    <div class="invalid-feedback">{{ $errors->first('weight_id') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab4" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="brand_id">Marka</label>
                            <select name="brand_id" id="brand_id" class="form-control global-select2"
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.brands') }}"
                                    data-selected="{{ json_encode(old('brand_id')) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select name="category_id[]" id="category_id" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.categories') }}"
                                    data-selected="{{ json_encode(old('category_id')) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="download_id">Dosyalar</label>
                            <select name="download_id[]" id="download_id" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.downloads') }}"
                                    data-selected="{{ json_encode(old('download_id')) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="download_id">Iconlar</label>
                            <select name="icon_id[]" id="icon_id" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.icons') }}"
                                    data-selected="{{ json_encode(old('icon_id')) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter_id">Filtreler</label>
                            <select name="filter_id[]" id="filter_id" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.filters') }}"
                                    data-selected="{{ json_encode(old('filter_id')) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="similar_id">Benzer Ürünler</label>
                            <select name="similar_id[]" id="similar_id" class="form-control global-select2" multiple
                                    data-placeholder="@lang('backend/common.choose')"
                                    data-url="{{ route('backend.api.search.products') }}"
                                    data-selected="{{ json_encode(old('similar_id')) }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="similar_product_id">Etiketler</label>
                            <div class="tag-editor"> <!-- need wrap -->
                                <input id="tag-editor" name="tag" value="{{ old('tag') }}" class="form-control" placeholder="virgül ile ayırarak giriniz." />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab5" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <table class="table table-striped table-bordered" id="table-attribute">
                                <thead>
                                <tr>
                                    <th>Özellik</th>
                                    <th>Değer</th>
                                    <th>
                                        <button type="button" class="btn btn-xs btn-success btn-new-row">
                                            <span class="btn-icon ua-icon-plus"></span>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(old('attribute'))
                                    @foreach(old('attribute') as $i => $attribute)
                                        <tr>
                                            <td>
                                                <select name="attribute[{{ $i }}][attribute_id]" class="form-control selectbox global-select2{{ $errors->has('attribute.' . $i . '.attribute_id') ? ' is-invalid' : '' }}"
                                                        data-placeholder="@lang('backend/common.choose')"
                                                        data-url="{{ route('backend.api.search.attributes') }}"
                                                        data-selected="{{ json_encode($attribute['attribute_id']) }}">
                                                </select>
                                                @if ($errors->has('attribute.' . $i . '.attribute_id'))
                                                    <div class="invalid-feedback">{{ $errors->first('attribute.' . $i . '.attribute_id') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <textarea name="attribute[{{ $i }}][value]" class="form-control{{ $errors->has('attribute.' . $i . '.value') ? ' is-invalid' : '' }}">{{ $attribute['value'] }}</textarea>
                                                @if ($errors->has('attribute.' . $i . '.value'))
                                                    <div class="invalid-feedback">{{ $errors->first('attribute.' . $i . '.value') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                    <span class="btn-icon ua-icon-remove"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <select name="attribute[0][attribute_id]" class="form-control selectbox global-select2"
                                                    data-placeholder="@lang('backend/common.choose')"
                                                    data-url="{{ route('backend.api.search.attributes') }}">
                                            </select>
                                        </td>
                                        <td>
                                            <textarea name="attribute[0][value]" class="form-control"></textarea>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                <span class="btn-icon ua-icon-remove"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab6" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <table class="table table-striped table-bordered" id="table-discount">
                                <thead>
                                <tr>
                                    <th>Müşteri Grubu</th>
                                    <th>Adet</th>
                                    <th>Öncelik</th>
                                    <th>Fiyatı</th>
                                    <th>Başlangıç Tarihi</th>
                                    <th>Bitiş Tarihi</th>
                                    <th>
                                        <button type="button" class="btn btn-xs btn-success btn-new-row">
                                            <span class="btn-icon ua-icon-plus"></span>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(old('discount'))
                                    @foreach(old('discount') as $i => $discount)
                                        <tr>
                                            <td>
                                                <select name="discount[{{ $i }}][customer_group_id]" class="form-control selectbox{{ $errors->has('discount.' . $i . '.customer_group_id') ? ' is-invalid' : '' }}">
                                                    <option @if($discount['customer_group_id'] == "0") selected @endif value="0">@lang('backend/common.all')</option>
                                                    @foreach($customer_groups as $customer_group)
                                                        <option @if($discount['customer_group_id'] == $customer_group->id()) selected @endif value="{{ $customer_group->id() }}">{{ $customer_group->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('discount.' . $i . '.customer_group_id'))
                                                    <div class="invalid-feedback">{{ $errors->first('discount.' . $i . '.customer_group_id') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="discount[{{ $i }}][quantity]" value="{{ $discount['quantity'] }}" class="form-control{{ $errors->has('discount.' . $i . '.quantity') ? ' is-invalid' : '' }}" />
                                                @if ($errors->has('discount.' . $i . '.quantity'))
                                                    <div class="invalid-feedback">{{ $errors->first('discount.' . $i . '.quantity') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="discount[{{ $i }}][priority]" value="{{ $discount['priority'] }}" class="form-control{{ $errors->has('discount.' . $i . '.priority') ? ' is-invalid' : '' }}" />
                                                @if ($errors->has('discount.' . $i . '.priority'))
                                                    <div class="invalid-feedback">{{ $errors->first('discount.' . $i . '.priority') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="discount[{{ $i }}][price]" value="{{ $discount['price'] }}" class="form-control{{ $errors->has('discount.' . $i . '.price') ? ' is-invalid' : '' }}" />
                                                @if ($errors->has('discount.' . $i . '.price'))
                                                    <div class="invalid-feedback">{{ $errors->first('discount.' . $i . '.price') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mt-4 datepicker">
                                                    <input type="text" name="discount[{{ $i }}][start_date]" value="{{ $discount['start_date'] }}" class="form-control{{ $errors->has('discount.' . $i . '.start_date') ? ' is-invalid' : '' }}" data-input/>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-warning" title="clear" data-clear>
                                                            <i class="ua-icon-minus-square-alt"></i>
                                                        </a>
                                                    </div>
                                                    @if ($errors->has('discount.' . $i . '.start_date'))
                                                        <div class="invalid-feedback">{{ $errors->first('discount.' . $i . '.start_date') }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group mt-4 datepicker">
                                                    <input type="text" name="discount[{{ $i }}][end_date]" value="{{ $discount['end_date'] }}" class="form-control{{ $errors->has('discount.' . $i . '.end_date') ? ' is-invalid' : '' }}" data-input/>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-warning" title="clear" data-clear>
                                                            <i class="ua-icon-minus-square-alt"></i>
                                                        </a>
                                                    </div>
                                                    @if ($errors->has('discount.' . $i . '.end_date'))
                                                        <div class="invalid-feedback">{{ $errors->first('discount.' . $i . '.end_date') }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                    <span class="btn-icon ua-icon-remove"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <select name="discount[0][customer_group_id]" class="form-control selectbox">
                                                <option value="0">@lang('backend/common.all')</option>
                                                @foreach($customer_groups as $customer_group)
                                                    <option value="{{ $customer_group->id() }}">{{ $customer_group->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="discount[0][quantity]" value="" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="discount[0][priority]" value="" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="discount[0][price]" value="" class="form-control" />
                                        </td>
                                        <td>
                                            <div class="input-group mt-4 datepicker">
                                                <input type="text" name="discount[0][start_date]" value="" class="form-control" data-input/>
                                                <div class="input-group-append">
                                                    <a class="btn btn-warning" title="clear" data-clear>
                                                        <i class="ua-icon-minus-square-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group mt-4 datepicker">
                                                <input type="text" name="discount[0][end_date]" value="" class="form-control" data-input/>
                                                <div class="input-group-append">
                                                    <a class="btn btn-warning" title="clear" data-clear>
                                                        <i class="ua-icon-minus-square-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                <span class="btn-icon ua-icon-remove"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab7" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <table class="table table-striped table-bordered" id="table-campaign">
                                <thead>
                                <tr>
                                    <th>Müşteri Grubu</th>
                                    <th>Öncelik</th>
                                    <th>Fiyatı</th>
                                    <th>Başlangıç Tarihi</th>
                                    <th>Bitiş Tarihi</th>
                                    <th>
                                        <button type="button" class="btn btn-xs btn-success btn-new-row">
                                            <span class="btn-icon ua-icon-plus"></span>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(old('campaign'))
                                    @foreach(old('campaign') as $i => $campaign)
                                        <tr>
                                            <td>
                                                <select name="campaign[{{ $i }}][customer_group_id]" class="form-control selectbox{{ $errors->has('campaign.' . $i . '.customer_group_id') ? ' is-invalid' : '' }}">
                                                    <option @if($campaign['customer_group_id'] == "0") selected @endif value="0">@lang('backend/common.all')</option>
                                                    @foreach($customer_groups as $customer_group)
                                                        <option @if($campaign['customer_group_id'] == $customer_group->id()) selected @endif value="{{ $customer_group->id() }}">{{ $customer_group->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('campaign.' . $i . '.customer_group_id'))
                                                    <div class="invalid-feedback">{{ $errors->first('campaign.' . $i . '.customer_group_id') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="campaign[{{ $i }}][priority]" value="{{ $campaign['priority'] }}" class="form-control{{ $errors->has('campaign.' . $i . '.priority') ? ' is-invalid' : '' }}" />
                                                @if ($errors->has('campaign.' . $i . '.priority'))
                                                    <div class="invalid-feedback">{{ $errors->first('campaign.' . $i . '.priority') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="campaign[{{ $i }}][price]" value="{{ $campaign['price'] }}" class="form-control{{ $errors->has('campaign.' . $i . '.price') ? ' is-invalid' : '' }}" />
                                                @if ($errors->has('campaign.' . $i . '.price'))
                                                    <div class="invalid-feedback">{{ $errors->first('campaign.' . $i . '.price') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mt-4 datepicker">
                                                    <input type="text" name="campaign[{{ $i }}][start_date]" value="{{ $campaign['start_date'] }}" class="form-control{{ $errors->has('campaign.' . $i . '.start_date') ? ' is-invalid' : '' }}" data-input/>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-warning" title="clear" data-clear>
                                                            <i class="ua-icon-minus-square-alt"></i>
                                                        </a>
                                                    </div>
                                                    @if ($errors->has('campaign.' . $i . '.start_date'))
                                                        <div class="invalid-feedback">{{ $errors->first('campaign.' . $i . '.start_date') }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group mt-4 datepicker">
                                                    <input type="text" name="campaign[{{ $i }}][end_date]" value="{{ $campaign['end_date'] }}" class="form-control{{ $errors->has('campaign.' . $i . '.end_date') ? ' is-invalid' : '' }}" data-input/>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-warning" title="clear" data-clear>
                                                            <i class="ua-icon-minus-square-alt"></i>
                                                        </a>
                                                    </div>
                                                    @if ($errors->has('campaign.' . $i . '.end_date'))
                                                        <div class="invalid-feedback">{{ $errors->first('campaign.' . $i . '.end_date') }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                    <span class="btn-icon ua-icon-remove"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <select name="campaign[0][customer_group_id]" class="form-control selectbox">
                                                <option value="0">@lang('backend/common.all')</option>
                                                @foreach($customer_groups as $customer_group)
                                                    <option value="{{ $customer_group->id() }}">{{ $customer_group->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="campaign[0][priority]" value="" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="campaign[0][price]" value="" class="form-control" />
                                        </td>
                                        <td>
                                            <div class="input-group mt-4 datepicker">
                                                <input type="text" name="campaign[0][start_date]" value="" class="form-control" data-input/>
                                                <div class="input-group-append">
                                                    <a class="btn btn-warning" title="clear" data-clear>
                                                        <i class="ua-icon-minus-square-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group mt-4 datepicker">
                                                <input type="text" name="campaign[0][end_date]" value="" class="form-control" data-input/>
                                                <div class="input-group-append">
                                                    <a class="btn btn-warning" title="clear" data-clear>
                                                        <i class="ua-icon-minus-square-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                <span class="btn-icon ua-icon-remove"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab8" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group filemanager-image">
                            <input type="hidden" name="main_image" class="imagepath" value="{{ old('main_image') }}" />
                            <img src="{{ Storage::disk('public')->url(old('main_image')) }}" width="100" height="100" class="img-thumbnail preview" />
                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                            </div>
                        </div>
                        <h3 class="title">Diğer Resimler</h3>
                        @for($i=0; $i<config('config.product_image_limit'); $i++)
                        <div class="form-group filemanager-image">
                            <input type="hidden" name="image[{{ $i }}][path]" class="imagepath" value="{{ old('image.' . $i . '.path') }}" />
                            <img src="{{ Storage::disk('public')->url(old('image.' . $i . '.path')) }}" width="100" height="100" class="img-thumbnail preview" />
                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                                <input type="text" name="image[{{ $i }}][order]" value="{{ old('image.' . $i . '.order', "0") }}" class="form-control" size="1" placeholder="Sıra" />
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
        </div>
    </form>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('backend/js/product.js') }}"></script>
@endsection