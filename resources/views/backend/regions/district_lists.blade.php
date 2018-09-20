@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.region.district.add', ['city_id' => $city->id()]) }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($districts->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sıra</th>
                    <th>Adı</th>
                    <th>Kodu</th>
                    <th>Durum</th>
                    <th>Eklenme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($districts as $district)
                    <tr>
                        <td>{{ $district->order }}</td>
                        <td>{{ $district->name }}</td>
                        <td>{{ $district->code }}</td>
                        <td><span class="badge badge-status-{{ $district->status }}">@lang('backend/common.status_' . $district->status)</span></td>
                        <td>{{ $district->createdAt() }}</td>
                        <td>{{ $district->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.region.district.edit', ['id' => $district->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.region.district.remove', ['id' => $district->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $districts->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection