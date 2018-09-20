@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <form action="{{ route('backend.product.filter.edited', ['id' => $filter_group->id()]) }}" method="post">
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
                            <input type="text" name="name" value="{{ old('name', $filter_group->name) }}" class="form-control" id="name"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Arama Tipi</label>
                            <select name="type" class="form-control">
                                @foreach($types as $key => $type)
                                    <option @if($filter_group->type == $type) selected @endif value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order">Sıra</label>
                            <input type="text" name="order" value="{{ old('order', $filter_group->order) }}" class="form-control"
                                   id="order"/>
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control">
                                <option @if(old('status', $filter_group->status) == "0") selected
                                        @endif value="0">@lang('backend/common.status_0')</option>
                                <option @if(old('status', $filter_group->status) == "1") selected
                                        @endif value="1">@lang('backend/common.status_1')</option>
                            </select>
                        </div>
                        <h3 class="title">Değerler</h3>
                        <div class="form-group">
                            <table class="table table-striped table-bordered" id="table-filter">
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
                                @if($filter_group->filters()->count() > 0)
                                    @foreach(old('filter', $filter_group->filters()->toArray()) as $i => $filter)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="filter[{{ $i }}][filter_id]" value="{{ $filter['filter_id'] }}" class="form-control" />
                                                <input type="text" name="filter[{{ $i }}][name]" value="{{ $filter['name'] }}" class="form-control" />
                                            </td>
                                            <td>
                                                <select name="filter[{{ $i }}][status]" id="status" class="form-control selectbox">
                                                    <option value="0" @if($filter['status'] == "0") selected @endif>@lang('backend/common.status_0')</option>
                                                    <option value="1" @if($filter['status'] == "1") selected @endif>@lang('backend/common.status_1')</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="filter[{{ $i }}][order]" value="{{ $filter['order'] }}" class="form-control" />
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
                                        <td>
                                            <input type="hidden" name="filter[0][filter_id]" value="0" class="form-control" />
                                            <input type="text" name="filter[0][name]" value="" class="form-control" />
                                        </td>
                                        <td>
                                            <select name="filter[0][status]" id="status" class="form-control selectbox">
                                                <option value="0">@lang('backend/common.status_0')</option>
                                                <option selected value="1">@lang('backend/common.status_1')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="filter[0][order]" value="0" class="form-control" />
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
            <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
        </div>
    </form>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('backend/js/filter.js') }}"></script>
@endsection