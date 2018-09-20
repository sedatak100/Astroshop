@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.region.country.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($countries->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sıra</th>
                    <th>Adı</th>
                    <th>Kodu</th>
                    <th>Durum</th>
                    <th>Toplam Şehir</th>
                    <th>Toplam İlçe</th>
                    <th>Eklenme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{ $country->order }}</td>
                        <td>{{ $country->name }} @if($country->isDefault())<strong>(@lang('backend/common.default'))</strong>@endif</td>
                        <td>{{ $country->code }}</td>
                        <td><span class="badge badge-status-{{ $country->status }}">@lang('backend/common.status_' . $country->status)</span></td>
                        <td>{{ $country->totalCity() }}</td>
                        <td>{{ $country->totalDistrict() }}</td>
                        <td>{{ $country->createdAt() }}</td>
                        <td>{{ $country->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.region.city.lists', ['country_id' => $country->id()]) }}"
                               class="btn btn-info" data-toggle="tooltip" title="Şehirler">
                                <span class="ua-icon-view-all"></span>
                            </a>
                            <a href="{{ route('backend.region.country.edit', ['id' => $country->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.region.country.remove', ['id' => $country->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $countries->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection