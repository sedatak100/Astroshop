@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.product.download.edited', ['id' => $download->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $download->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description', $download->description) }}</textarea>
                </div>
                <div class="form-group mb-3 filemanager-file">
                    <label for="filename">Dosya</label>
                    <div class="input-group">
                        <input type="text" name="filename" value="{{ old('filename', $download->filename) }}" class="form-control filepath" id="filename"/>
                        <div class="input-group-append">
                            <a href="@if(old('filename', $download->filename)) {{ Storage::disk('public')->url(old('filename', $download->filename)) }} @endif" target="_blank" class="btn btn-outline-secondary" type="button">@lang('backend/common.download')</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="based">Baz</label>
                    <select name="based" id="based" class="form-control">
                        <option @if(old('based', $download->based) === "order_before") selected @endif value="order_before">Sipariş Öncesi</option>
                        <option @if(old('based', $download->based) === "order_after") selected @endif value="order_after">Sipariş Sonrası</option>
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