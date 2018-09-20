@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.unit.weight.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($weights)
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>Birim</th>
                    <th>Değer</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($weights as $weight)
                    <tr>
                        <td>{{ $weight->name }} @if($weight->isDefault())<strong>(@lang('backend/common.default'))</strong>@endif</td>
                        <td>{{ $weight->unit }}</td>
                        <td>{{ $weight->value }}</td>
                        <td>{{ $weight->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.unit.weight.edit', ['id' => $weight->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.unit.weight.remove', ['id' => $weight->id()]) }}"
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