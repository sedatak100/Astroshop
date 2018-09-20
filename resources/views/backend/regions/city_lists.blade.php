@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.region.city.add', ['country_id' => $country->id()]) }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($cities->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sıra</th>
                    <th>Adı</th>
                    <th>Kodu</th>
                    <th>Durum</th>
                    <th>Toplam İlçe</th>
                    <th>Eklenme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{ $city->order }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->code }}</td>
                        <td><span class="badge badge-status-{{ $city->status }}">@lang('backend/common.status_' . $city->status)</span></td>
                        <td>{{ $city->totalDistrict() }}</td>
                        <td>{{ $city->createdAt() }}</td>
                        <td>{{ $city->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.region.district.lists', ['city_id' => $city->id()]) }}"
                               class="btn btn-info" data-toggle="tooltip" title="İlçeler">
                                <span class="ua-icon-view-all"></span>
                            </a>
                            <a href="{{ route('backend.region.city.edit', ['id' => $city->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.region.city.remove', ['id' => $city->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $cities->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection