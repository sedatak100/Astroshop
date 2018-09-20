@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.poster.added') }}" method="post">
        @csrf
        <div class="main-container tabs-alpha">
            <ul class="nav nav-tabs tabs-alpha__nav-tabs">
                <li class="nav-item tabs-alpha__item">
                    <a class="nav-link tabs-alpha__link active show" data-toggle="tab" href="#tab1">
                        <span class="ua-icon-settings tabs-alpha__tab-close-icon"></span> Genel
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
                            <label for="name">Açıklama</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
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
                    <div class="col-lg-12 col-md-12">
                        <h3 class="title">İçerik</h3>
                        <div class="form-group">
                            <table class="table table-striped table-bordered" id="table-poster">
                                <thead>
                                    <tr>
                                        <th>Adı</th>
                                        <th>Açıklama</th>
                                        <th>Link</th>
                                        <th>Hedef</th>
                                        <th>Config</th>
                                        <th>Config 2</th>
                                        <th>Resim</th>
                                        <th>Resim 2</th>
                                        <th>Sıra</th>
                                        <th>
                                            <button type="button" class="btn btn-xs btn-success btn-new-row">
                                                <span class="btn-icon ua-icon-plus"></span>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(old('poster'))
                                @foreach(old('poster') as $i => $poster)
                                    <tr>
                                        <td><input type="text" name="poster[{{ $i }}][name]" value="{{ $poster['name'] }}" class="form-control" /></td>
                                        <td><textarea type="text" name="poster[{{ $i }}][description]" class="form-control">{{ $poster['description'] }}</textarea></td>
                                        <td><input type="text" name="poster[{{ $i }}][link]" value="{{ $poster['link'] }}" class="form-control" /></td>
                                        <td>
                                            <select name="poster[{{ $i }}][target]" class="form-control selectbox">
                                                @foreach($targets as $target)
                                                    <option @if($poster['target'] == $target) selected @endif value="{{ $target }}">{{ $target }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="poster[{{ $i }}][config]" value="{{ $poster['config'] }}" class="form-control" /></td>
                                        <td><input type="text" name="poster[{{ $i }}][config2]" value="{{ $poster['config2'] }}" class="form-control" /></td>
                                        <td>
                                            <div class="form-group filemanager-image">
                                                <input type="hidden" name="poster[{{ $i }}][image]" class="imagepath" value="{{ $poster['image'] }}" />
                                                <img src="{{ Storage::disk('public')->url($poster['image']) }}" width="100" height="100" class="img-thumbnail preview" />
                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                    <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group filemanager-image">
                                                <input type="hidden" name="poster[{{ $i }}][image2]" class="imagepath" value="{{ $poster['image2'] }}" />
                                                <img src="{{ Storage::disk('public')->url($poster['image2']) }}" width="100" height="100" class="img-thumbnail preview" />
                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                    <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td><input type="text" name="poster[{{ $i }}][order]" value="{{ $poster['order'] }}" class="form-control input-order" /></td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                <span class="btn-icon ua-icon-remove"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td><input type="text" name="poster[0][name]" value="" class="form-control" /></td>
                                        <td><textarea type="text" name="poster[0][description]" class="form-control"></textarea></td>
                                        <td><input type="text" name="poster[0][link]" value="" class="form-control" /></td>
                                        <td>
                                            <select name="poster[0][target]" class="form-control selectbox">
                                                @foreach($targets as $target)
                                                    <option value="{{ $target }}">{{ $target }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="poster[0][config]" value="" class="form-control" /></td>
                                        <td><input type="text" name="poster[0][config2]" value="" class="form-control" /></td>
                                        <td>
                                            <div class="form-group filemanager-image">
                                                <input type="hidden" name="poster[0][image]" class="imagepath" value="" />
                                                <img src="" width="100" height="100" class="img-thumbnail preview" />
                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                    <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group filemanager-image">
                                                <input type="hidden" name="poster[0][image2]" class="imagepath" value="" />
                                                <img src="" width="100" height="100" class="img-thumbnail preview" />
                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                    <button type="button" class="btn btn-danger btn-remove"><span class="ua-icon-remove"></span></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td><input type="text" name="poster[0][order]" value="0" class="form-control input-order" /></td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                <span class="btn-icon ua-icon-remove"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
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
    <script type="text/javascript" src="{{ asset('backend/js/poster.js') }}"></script>
@endsection