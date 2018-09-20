@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.page.added', ['id' => $id]) }}" method="post">
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
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"/>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Kısa Açıklama</label>
                            <textarea name="short_description" class="form-control" id="short_description">{{ old('short_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea name="description" class="form-control ckeditor" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="order">Sıra</label>
                            <input type="text" name="order" value="{{ old('order', "0") }}" class="form-control" id="order"/>
                        </div>
                        <div class="form-group">
                            <label for="hidden">Gizli Sayfa</label>
                            <select name="hidden" id="hidden" class="form-control">
                                <option @if(old('hidden') == "0") selected
                                        @endif value="0">@lang('backend/common.no')</option>
                                <option @if(old('hidden') == "1") selected
                                        @endif value="1">@lang('backend/common.yes')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control">
                                <option @if(old('status') == "0") selected
                                        @endif value="0">@lang('backend/common.status_0')</option>
                                <option @if(old('status') == "1") selected
                                        @endif value="1">@lang('backend/common.status_1')</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="seo_name">Seo Url</label>
                            <input type="text" name="seo_name" value="{{ old('seo_name') }}" class="form-control" id="seo_name"/>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <textarea name="meta_title" class="form-control" id="meta_title">{{ old('meta_title') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Açıklama</label>
                            <textarea name="meta_description" class="form-control" id="meta_description">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control" id="meta_keyword">{{ old('meta_keyword') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab3" role="tabpanel" aria-expanded="true">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group filemanager-image">
                            <input type="hidden" name="image" class="imagepath" value="{{ old('image') }}" />
                            <img src="{{ Storage::disk('public')->url(old('image')) }}" width="100" height="100" class="img-thumbnail preview" />
                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" value="{{ old('icon') }}" class="form-control" id="icon"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
        </div>
    </form>
@endsection

@section('footer')

@endsection