@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.coupon.edited', ['id' => $coupon->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $coupon->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="code">Kod</label>
                    <input type="text" name="code" value="{{ old('code', $coupon->code) }}" class="form-control" id="code"/>
                </div>
                <div class="form-group">
                    <label for="total">Minumum Sipariş Toplamı</label>
                    <input type="text" name="total" value="{{ old('total', $coupon->total) }}" class="form-control"
                           id="total"/>
                </div>
                <div class="form-group">
                    <label for="type">Tip</label>
                    <select name="type" class="form-control" id="type">
                        <option @if(old('type', $coupon->type) == 'percent') selected @endif value="percent">Yüzde</option>
                        <option @if(old('type', $coupon->type) == 'amount') selected @endif value="amount">Sabit Tutar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="discount">İndirim Oran/Tutar</label>
                    <input type="text" name="discount" value="{{ old('discount', $coupon->discount) }}" class="form-control"
                           id="discount"/>
                </div>
                <!--
                <div class="form-group">
                    <label for="category_id">Kategori Bazlı Kullan</label>
                    <select name="category_id[]" id="category_id" class="form-control global-select2" multiple
                            data-placeholder="@lang('backend/common.choose')"
                            data-url="{{ route('backend.api.search.categories') }}"
                            data-selected="{{ json_encode(old('category_id', $coupon->categories->pluck('category_id'))) }}">
                    </select>
                </div>
                <div class="form-group">
                    <label for="similar_id">Ürün Bazlı Kullan</label>
                    <select name="product_id[]" id="product_id" class="form-control global-select2" multiple
                            data-placeholder="@lang('backend/common.choose')"
                            data-url="{{ route('backend.api.search.products') }}"
                            data-selected="{{ json_encode(old('product_id', $coupon->products->pluck('product_id'))) }}">
                    </select>
                </div>
                -->
                <div class="form-group">
                    <label for="start_date">Başlangıç Tarihi</label>
                    <div class="input-group datepicker">
                        <input type="text" name="start_date" value="{{ old('start_date', $coupon->start_date) }}" class="form-control"
                               id="start_date" data-input/>
                        <div class="input-group-append">
                            <a class="btn btn-warning" title="clear" data-clear>
                                <i class="ua-icon-minus-square-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date">Bitiş Tarihi</label>
                    <div class="input-group datepicker">
                        <input type="text" name="end_date" value="{{ old('end_date', $coupon->end_date) }}" class="form-control"
                               id="end_date"
                               data-input/>
                        <div class="input-group-append">
                            <a class="btn btn-warning" title="clear" data-clear>
                                <i class="ua-icon-minus-square-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="uses_total">Kupon Başına Toplam Kullanım</label>
                    <input type="text" name="uses_total" value="{{ old('uses_total', $coupon->uses_total) }}" class="form-control"
                           id="uses_total"/>
                </div>
                <div class="form-group">
                    <label for="uses_customer">Müşteri Başına Toplam Kullanım</label>
                    <input type="text" name="uses_customer" value="{{ old('uses_customer', $coupon->uses_customer) }}" class="form-control"
                           id="uses_customer"/>
                </div>

                <div class="form-group">
                    <label for="discount">Durum</label>
                    <select name="status" id="status" class="form-control">
                        <option @if(old('status', $coupon->status) == "0") selected
                                @endif value="0">@lang('backend/common.status_0')</option>
                        <option @if(old('status', $coupon->status) == "1") selected
                                @endif value="1">@lang('backend/common.status_1')</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')

@endsection