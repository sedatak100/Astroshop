@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.user.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($users->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı Soyadı</th>
                    <th>Durum</th>
                    <th>E-Mail</th>
                    <th>Grup</th>
                    <th>Son Giriş Tarihi</th>
                    <th>Eklenme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->fullname() }}</td>
                        <td><span class="badge badge-status-{{ $user->status }}">@lang('backend/common.status_' . $user->status)</span></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->userGroup()->name }}</td>
                        <td>{{ $user->lastLoginDate() }}</td>
                        <td>{{ $user->createdAt() }}</td>
                        <td>{{ $user->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.user.edit', ['id' => $user->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.user.remove', ['id' => $user->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection