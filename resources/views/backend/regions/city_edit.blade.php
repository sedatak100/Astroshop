@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.region.city.edited', ['id' => $city->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $city->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="code">Kodu</label>
                    <input type="text" name="code" value="{{ old('code', $city->code) }}" class="form-control" id="code"/>
                </div>
                <div class="form-group">
                    <label for="order">Sıra</label>
                    <input type="text" name="order" value="{{ old('order', $city->order) }}" class="form-control" id="order"/>
                </div>
                <div class="form-group">
                    <label for="status">Durum</label>
                    <select name="status" id="status" class="form-control">
                        <option @if(old('status', $city->status) == "0") selected
                                @endif value="0">@lang('backend/common.status_0')</option>
                        <option @if(old('status', $city->status) == "1") selected
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