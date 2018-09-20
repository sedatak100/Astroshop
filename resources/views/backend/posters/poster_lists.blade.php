@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.poster.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($poster_groups->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>Toplam Poster</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($poster_groups as $poster_group)
                    <tr>
                        <td>{{ $poster_group->name }}</td>
                        <td>{{ $poster_group->countPoster() }}</td>
                        <td><span class="badge badge-status-{{ $poster_group->status }}">@lang('backend/common.status_' . $poster_group->status)</span></td>
                        <td>
                            <a href="{{ route('backend.poster.edit', ['id' => $poster_group->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.poster.remove', ['id' => $poster_group->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $poster_groups->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection