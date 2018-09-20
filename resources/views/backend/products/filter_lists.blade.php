@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.product.filter.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($filter_groups->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sıra</th>
                    <th>Adı</th>
                    <th>Durum</th>
                    <th>Toplam Filtre</th>
                    <th>Arama Tipi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($filter_groups as $filter_group)
                    <tr>
                        <td>{{ $filter_group->order }}</td>
                        <td>{{ $filter_group->name }}</td>
                        <td><span class="badge badge-status-{{ $filter_group->status }}">@lang('backend/common.status_' . $filter_group->status)</span></td>
                        <td>{{ $filter_group->countFilter() }}</td>
                        <td>{{ $filter_group->type }}</td>
                        <td>
                            <a href="{{ route('backend.product.filter.edit', ['id' => $filter_group->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.product.filter.remove', ['id' => $filter_group->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $filter_groups->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection