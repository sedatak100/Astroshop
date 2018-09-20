@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.product.brand.edited', ['id' => $brand->id()]) }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="main-container tabs-alpha">
        <ul class="nav nav-tabs tabs-alpha__nav-tabs">
            <li class="nav-item tabs-alpha__item">
                <a class="nav-link tabs-alpha__link active show" data-toggle="tab" href="#tab1">
                    <span class="ua-icon-settings tabs-alpha__tab-close-icon"></span> Genel
                </a>
            </li>
            <li class="nav-item tabs-alpha__item">
                <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab2">
                    <span class="ua-icon-inbox tabs-alpha__tab-close-icon"></span> Seo
                </a>
            </li>
            <li class="nav-item tabs-alpha__item">
                <a class="nav-link tabs-alpha__link" data-toggle="tab" href="#tab3">
                    <span class="ua-icon-image tabs-alpha__tab-close-icon"></span> Resimler
                </a>
            </li>
        </ul>
        <div class="tab-content tabs-alpha__tab-content">
            <div class="tab-pane active show" id="tab1" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="name">Adı</label>
                            <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="write-seo form-control" id="name" data-seo_id="seo_name"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description', $brand->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="order">Sıra</label>
                            <input type="text" name="order" value="{{ old('order', $brand->order) }}" class="form-control" id="order"/>
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control">
                                <option @if(old('status', $brand->status) == "0") selected
                                        @endif value="0">@lang('backend/common.status_0')</option>
                                <option @if(old('status', $brand->status) == "1") selected
                                        @endif value="1">@lang('backend/common.status_1')</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="tab-pane" id="tab2" role="tabpanel" aria-expanded="true">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="seo_name">Seo Url</label>
                        <div class="input-group">
                            <input type="text" readonly name="seo_name" value="{{ old('seo_name', $brand->seo_name) }}" class="form-control" id="seo_name"/>
                            <div class="input-group-append">
                                <a href="" class="seo-disable-input btn btn-warning" data-target="seo_name">
                                    <span class="ua-icon-pencil"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea name="meta_title" class="form-control" id="meta_title">{{ old('meta_title', $brand->meta_title) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Açıklama</label>
                        <textarea name="meta_description" class="form-control" id="meta_description">{{ old('meta_description', $brand->meta_description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Meta Keyword</label>
                        <textarea name="meta_keyword" class="form-control" id="meta_keyword">{{ old('meta_keyword', $brand->meta_keyword) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab3" role="tabpanel" aria-expanded="true">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group filemanager-image">
                        <input type="hidden" name="image" class="imagepath" value="{{ old('image', $brand->image) }}" />
                        <img src="{{ Storage::disk('public')->url(old('image', $brand->image)) }}" width="100" height="100" class="img-thumbnail preview" />
                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                            <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" name="icon" value="{{ old('image', $brand->icon) }}" class="form-control" id="icon"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
        </div>
    </form>
@endsection

@section('footer')

@endsection