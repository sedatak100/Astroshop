@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.status.stock_status.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($stock_statuses->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stock_statuses as $stock_status)
                    <tr>
                        <td>{{ $stock_status->name }} @if($stock_status->isDefault())<strong>(@lang('backend/common.default'))</strong>@endif</td>
                        <td>{{ $stock_status->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.status.stock_status.edit', ['id' => $stock_status->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.status.stock_status.remove', ['id' => $stock_status->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection