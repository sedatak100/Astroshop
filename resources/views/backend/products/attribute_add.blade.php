@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.product.attribute.added') }}" method="post">
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
                            <label for="order">Sıra</label>
                            <input type="text" name="order" value="{{ old('order', "0") }}" class="form-control"
                                   id="order"/>
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
                        <h3 class="title">Değerler</h3>
                        <div class="form-group">
                            <table class="table table-striped table-bordered" id="table-attribute">
                                <thead>
                                    <tr>
                                        <th>Değer</th>
                                        <th>Durum</th>
                                        <th>Sıra</th>
                                        <th>
                                            <button type="button" class="btn btn-xs btn-success btn-new-row">
                                                <span class="btn-icon ua-icon-plus"></span>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(old('attribute'))
                                @foreach(old('attribute') as $i => $attribute)
                                    <tr>
                                        <td><input type="text" name="attribute[{{ $i }}][name]" value="{{ $attribute['name'] }}" class="form-control" /></td>
                                        <td>
                                            <select name="attribute[{{ $i }}][status]" id="status" class="form-control selectbox">
                                                <option value="0" @if($attribute['status'] == "0") selected @endif>@lang('backend/common.status_0')</option>
                                                <option value="1" @if($attribute['status'] == "1") selected @endif>@lang('backend/common.status_1')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="attribute[{{ $i }}][type]" class="form-control selectbox">
                                                @foreach(\App\Model\Products\Attribute::types() as $key => $value)
                                                    <option @if($attribute['type'] == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="attribute[{{ $i }}][order]" value="{{ $attribute['order'] }}" class="form-control" />
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                                <span class="btn-icon ua-icon-remove"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td><input type="text" name="attribute[0][name]" value="" class="form-control" /></td>
                                        <td>
                                            <select name="attribute[0][status]" id="status" class="form-control selectbox">
                                                <option value="0">@lang('backend/common.status_0')</option>
                                                <option selected value="1">@lang('backend/common.status_1')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="attribute[0][type]" class="form-control selectbox">
                                                @foreach(\App\Model\Products\Attribute::types() as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="attribute[0][order]" value="0" class="form-control" />
                                        </td>
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
    <script type="text/javascript" src="{{ asset('backend/js/attribute.js') }}"></script>
@endsection