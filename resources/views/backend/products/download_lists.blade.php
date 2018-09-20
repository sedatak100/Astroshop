@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.product.download.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($downloads->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>Açıklama</th>
                    <th>Baz</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($downloads as $download)
                    <tr>
                        <td>{{ $download->name }}</td>
                        <td>{{ $download->description }}</td>
                        <td>{{ $download->based }}</td>
                        <td>{{ $download->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.product.download.edit', ['id' => $download->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.product.download.remove', ['id' => $download->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $downloads->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection