@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.currency.added') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="code">Kodu</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="code"/>
                </div>
                <div class="form-group">
                    <label for="decimal_place">Ondalık</label>
                    <input type="text" name="decimal_place" value="{{ old('decimal_place') }}" class="form-control" id="decimal_place"/>
                </div>
                <div class="form-group">
                    <label for="symbol_left">Sol Sembol</label>
                    <input type="text" name="symbol_left" value="{{ old('symbol_left') }}" class="form-control" id="symbol_left"/>
                </div>
                <div class="form-group">
                    <label for="symbol_right">Sağ Sembol</label>
                    <input type="text" name="symbol_right" value="{{ old('symbol_right') }}" class="form-control" id="symbol_right"/>
                </div>
                <div class="form-group">
                    <label for="value">Değer</label>
                    <input type="text" name="value" value="{{ old('value') }}" class="form-control" id="value"/>
                </div>
                <div class="form-group">
                    <label for="status">Varsayılan</label>
                    <select name="default" id="status" class="form-control">
                        <option @if(old('default') === "0") selected
                                @endif value="0">@lang('backend/common.no')</option>
                        <option @if(old('default') === "1") selected
                                @endif value="1">@lang('backend/common.yes')</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')

@endsection