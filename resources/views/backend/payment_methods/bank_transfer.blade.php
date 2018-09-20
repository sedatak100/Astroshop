@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.payment_method.bank_transfer.edited') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Liste Adı</label>
                    <input type="text" name="payment[name]" value="{{ old('payment.name', config('payment_bank_transfer.name')) }}" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="description">Hesap Bilgileri</label>
                    <textarea name="payment[info]" class="ckeditor" id="description">{{ old('payment.info', config('payment_bank_transfer.info')) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="total">Minumum Sipariş Tutarı</label>
                    <input type="text" name="payment[total]" value="{{ old('payment.total', config('payment_bank_transfer.total')) }}" class="form-control" id="total"/>
                </div>
                <div class="form-group">
                    <label for="order_status">Sipariş Durumu</label>
                    <select name="payment[order_status]" id="order_status" class="form-control">
                        @foreach($order_statuses as $order_status)
                            <option @if(old('payment.order_status', config('payment_bank_transfer.order_status')) == $order_status->id()) selected @endif value="{{ $order_status->id() }}">{{ $order_status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!--
                <div class="form-group">
                    <label for="region_scope_id">Bölge</label>
                    <select name="payment[region_scope_id]" id="region_scope_id" class="form-control">
                        @foreach($regions as $region)
                            <option @if(old('payment.region_scope_id', config('payment_bank_transfer.region_scope_id')) == "0") selected @endif value="0">Hepsi</option>
                            <option @if(old('payment.region_scope_id', config('payment_bank_transfer.region_scope_id')) == $region->id()) selected @endif value="{{ $region->id() }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                -->
                <div class="form-group">
                    <label for="status">Durum</label>
                    <select name="payment[status]" id="status" class="form-control">
                        <option @if(old('payment.status', config('payment_bank_transfer.status')) == "0") selected
                                @endif value="0">@lang('backend/common.status_0')</option>
                        <option @if(old('payment.status', config('payment_bank_transfer.status')) == "1") selected
                                @endif value="1">@lang('backend/common.status_1')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order">Sıra</label>
                    <input type="text" name="payment[order]" value="{{ old('payment.order', config('payment_bank_transfer.order')) }}" class="form-control" id="order"/>
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