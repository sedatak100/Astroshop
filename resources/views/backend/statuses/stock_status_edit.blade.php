@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.status.stock_status.edited', ['id' => $stock_status->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $stock_status->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="status">Varsayılan</label>
                    <select name="default" id="status" class="form-control">
                        <option @if(old('default', config($stock_status->getConfigKey())) != $stock_status->id()) selected
                                @endif value="0">@lang('backend/common.no')</option>
                        <option @if(old('default', config($stock_status->getConfigKey())) == $stock_status->id()) selected
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