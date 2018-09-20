@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.unit.weight.edited', ['id' => $weight->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $weight->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="unit">Birim</label>
                    <input type="text" name="unit" value="{{ old('unit', $weight->unit) }}" class="form-control" id="unit"/>
                </div>
                <div class="form-group">
                    <label for="value">Değer</label>
                    <input type="text" name="value" value="{{ old('value', $weight->value) }}" class="form-control" id="value"/>
                </div>
                <div class="form-group">
                    <label for="default">Varsayılan</label>
                    <select name="default" id="default" class="form-control">
                        <option @if(old('default', config($weight->getConfigKey())) != $weight->id()) selected
                                @endif value="0">@lang('backend/common.no')</option>
                        <option @if(old('default', config($weight->getConfigKey())) == $weight->id()) selected
                                @endif value="1">@lang('backend/common.yes')</option>
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