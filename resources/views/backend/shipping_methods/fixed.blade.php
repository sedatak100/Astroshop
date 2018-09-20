@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.shipping_method.fixed.edited') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="total">Minumum Sipariş Tutarı</label>
                    <input type="text" name="shipping[total]" value="{{ old('shipping.total', config('shipping_fixed.total')) }}" class="form-control" id="total"/>
                </div>
                <div class="form-group">
                    <label for="amount">Sabit Fiyatı</label>
                    <input type="text" name="shipping[amount]" value="{{ old('shipping.total', config('shipping_fixed.amount')) }}" class="form-control" id="amount"/>
                </div>
                <!--
                <div class="form-group">
                    <label for="region_scope_id">Bölge</label>
                    <select name="shipping[region_scope_id]" id="region_scope_id" class="form-control">
                        @foreach($regions as $region)
                            <option @if(old('shipping.region_scope_id', config('shipping_fixed.region_scope_id')) == "0") selected @endif value="0">Hepsi</option>
                            <option @if(old('shipping.region_scope_id', config('shipping_fixed.region_scope_id')) == $region->id()) selected @endif value="{{ $region->id() }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                -->
                <div class="form-group">
                    <label for="status">Durum</label>
                    <select name="shipping[status]" id="status" class="form-control">
                        <option @if(old('shipping.status', config('shipping_fixed.status')) == "0") selected
                                @endif value="0">@lang('backend/common.status_0')</option>
                        <option @if(old('shipping.status', config('shipping_fixed.status')) == "1") selected
                                @endif value="1">@lang('backend/common.status_1')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order">Sıra</label>
                    <input type="text" name="shipping[order]" value="{{ old('shipping.order', config('shipping_fixed.order')) }}" class="form-control" id="order"/>
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