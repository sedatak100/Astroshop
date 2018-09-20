@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.product.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>

        <form action="" method="get">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ürün Adı</label>
                                <input type="text" name="f[name]" value="{{ Request::input('f.name') }}" class="form-control" placeholder="Ürün Adı">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" name="f[model]" value="{{ Request::input('f.model') }}" class="form-control" placeholder="Model">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Stok Kodu</label>
                                <input type="text" name="f[stock_code]" value="{{ Request::input('f.stock_code') }}" class="form-control" placeholder="Stok Kodu">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Durumu</label>
                                <select name="f[status]" class="form-control">
                                    <option value="">Hepsi</option>
                                    <option {{ Request::input('f.status') == '1' ? 'selected' : '' }} value="1">Aktif</option>
                                    <option {{ Request::input('f.status') == '0' ? 'selected' : '' }} value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marka</label>
                                <select name="f[brand_id][]" id="brand_id" class="form-control global-select2" multiple
                                        data-placeholder="@lang('backend/common.choose')"
                                        data-url="{{ route('backend.api.search.brands') }}"
                                        data-selected="{{ json_encode(Request::input('f.brand_id')) }}">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="f[category_id][]" id="category_id" class="form-control global-select2" multiple
                                        data-placeholder="@lang('backend/common.choose')"
                                        data-url="{{ route('backend.api.search.categories') }}"
                                        data-selected="{{ json_encode(Request::input('f.category_id')) }}">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Filtrele</button>
                    </div>
                </div>
            </div>
        </form>

        @if($products->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox"/></th>
                    <th>Resim</th>
                    <th>Ürün Adı</th>
                    <th>Marka - Model - Stok Kodu</th>
                    <th>Fiyat</th>
                    <th>Site Fiyatı</th>
                    <th>Adet</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <input type="checkbox"/>
                        </td>
                        <td>
                            @if($product->image)
                                <img src="{{ $product->getImageUrl('small') }}" width="70" class="img-thumbnail"/>
                            @else
                                <img src="{{ asset('backend/img/empty-image.png') }}" width="100" height="100"
                                     class="img-thumbnail"/>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if($product->brand)
                                {{ $product->brand->name }}<br/>
                            @endif
                            {{ $product->model }}<br/>
                            {{ $product->stock_code }}
                        </td>
                        <td>
                            @if($product->currentCampaign)
                                <del class="">{{ App\Model\Currencies\Currency::format($product->price, $product->currency_id, 1, true, false) }}</del>
                                <br/>
                                <span class="badge badge-primary">{{ App\Model\Currencies\Currency::format($product->currentCampaign->price, $product->currency_id, 1, true, false) }}</span>
                            @else
                                {{ App\Model\Currencies\Currency::format($product->price, $product->currency_id, 1, true, false) }}
                            @endif
                        </td>
                        <td>
                            @if($product->currentCampaign)
                                <del class="">{{ $product->priceFormat() }}</del><br/>
                                <span class="badge badge-primary">{{ $product->currentCampaign->priceFormat($product->tax_class_id, $product->currency_id) }}</span>
                            @else
                                {{ $product->priceFormat() }}
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ (config('backend.stock_alert') < $product->quantity) ? 'badge-success' : 'badge-warning' }}">{{ $product->quantity }}</span>
                        </td>
                        <td>
                            <span class="badge badge-status-{{ $product->status }}">@lang('backend/common.status_' . $product->status)</span>
                        </td>
                        <td>
                            <a href="{{ route('backend.product.edit', ['id' => $product->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.product.remove', ['id' => $product->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection