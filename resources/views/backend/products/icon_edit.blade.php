@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.product.icon.edited', ['id' => $icon->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $icon->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description', $icon->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $icon->icon) }}" class="form-control" id="icon"/>
                </div>
                <div class="form-group filemanager-image">
                    <input type="hidden" name="image" class="imagepath" value="{{ old('image', $icon->image) }}" />
                    <img src="{{ Storage::disk('public')->url(old('image', $icon->image)) }}" width="100" height="100" class="img-thumbnail preview" />
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                    </div>
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