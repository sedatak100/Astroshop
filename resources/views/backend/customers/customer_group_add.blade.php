@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.customer.group.added') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="order">Sıra</label>
                    <input type="text" name="order" value="{{ old('order', "0") }}" class="form-control" id="order"/>
                </div>
                <div class="form-group">
                    <label>Müşteriler Otomatik Onaylansın</label>
                    <br />
                    <label class="radio-inline">
                        <input type="radio" name="approval" value="0" @if(old('approval') == "0") checked @endif/> Hayır
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="approval" value="1" @if(old('approval') == "1") checked @endif/> Evet
                    </label>
                </div>
                <div class="form-group">
                    <label for="default">Varsayılan</label>
                    <select name="default" id="default" class="form-control">
                        <option @if(old('default') == "0") selected
                                @endif value="0">@lang('backend/common.no')</option>
                        <option @if(old('default') == "1") selected
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