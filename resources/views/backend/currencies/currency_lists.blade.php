@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.currency.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
                <a href="{{ route('backend.currency.update') }}" class="btn-remove-alert btn btn-dark icon-left mr-3" data-message="Para Birimleri Güncellensin mi?">
                    @lang('backend/common.update') <span class="btn-icon ua-icon-refresh"></span>
                </a>
            </div>
        </div>
        @if($currencies->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Kodu</th>
                    <th>Ondalık</th>
                    <th>Sol Sembol</th>
                    <th>Sağ Sembol</th>
                    <th>Değer</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($currencies as $currency)
                    <tr>
                        <td>{{ $currency->name }} @if($currency->isDefault())<strong>(@lang('backend/common.default'))</strong>@endif</td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->decimal_place }}</td>
                        <td>{{ $currency->symbol_left }}</td>
                        <td>{{ $currency->symbol_right }}</td>
                        <td>{{ $currency->value }}</td>
                        <td>{{ $currency->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.currency.edit', ['id' => $currency->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.currency.remove', ['id' => $currency->id()]) }}"
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