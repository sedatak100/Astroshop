@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.region.country.added') }}" method="post">
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
                    <label for="order">Sıra</label>
                    <input type="text" name="order" value="{{ old('order', "0") }}" class="form-control" id="order"/>
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
                    <label for="status">Durum</label>
                    <select name="status" id="status" class="form-control">
                        <option @if(old('status') === "0") selected
                                @endif value="0">@lang('backend/common.status_0')</option>
                        <option @if(old('status') === "1") selected
                                @endif value="1">@lang('backend/common.status_1')</option>
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