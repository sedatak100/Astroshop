@extends('backend.layouts.default')

@section('header')
    <script type="text/javascript">
        var PC = {
            backend_api_region_cities_by_country : '{{ route('backend.api.region.cities_by_country') }}',
            lang : {
                all : '{{ __('backend/common.all') }}'
            }
        };
    </script>
@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.region.added') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="form-control" id="description"/>
                </div>
            </div>
            <div class="col-lg-10 col-md-10">
                <table class="table table-bordered table-striped" id="table-scope">
                    <thead>
                        <tr>
                            <th>Ülke</th>
                            <th>Şehir</th>
                            <th>
                                <button type="button" class="btn btn-xs btn-success btn-new-row">
                                    <span class="btn-icon ua-icon-plus"></span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(old('country_ids'))
                            @foreach(old('country_ids') as $i => $country_id)
                                <tr>
                                    <th>
                                        <select name="country_ids[]" class="form-control select-country selectbox" data-search-enable="true">
                                            @foreach($countries as $country)
                                                <option @if($country_id == $country->id()) selected @endif value="{{ $country->id() }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <select name="city_ids[]" class="form-control select-city selectbox" data-selected_id="{{ old('city_ids.' . $i) }}">
                                        </select>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-xs btn-danger btn-remove-row" data-search-enable="true">
                                            <span class="btn-icon ua-icon-remove"></span>
                                        </button>
                                    </th>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th>
                                    <select name="country_ids[]" class="form-control select-country selectbox" data-search-enable="true">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id() }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <select name="city_ids[]" class="form-control select-city selectbox" data-selected_id="0">
                                    </select>
                                </th>
                                <th>
                                    <button type="button" class="btn btn-xs btn-danger btn-remove-row" data-search-enable="true">
                                        <span class="btn-icon ua-icon-remove"></span>
                                    </button>
                                </th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6">
                <label></label>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
<script type="text/javascript" src="{{ asset('backend/js/region.js') }}"></script>
@endsection