@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.user.group.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>

        @if($user_groups->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user_groups as $user_group)
                    <tr>
                        <td>{{ $user_group->name }}</td>
                        <td>
                            <a href="{{ route('backend.user.group.edit', ['id' => $user_group->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.user.group.remove', ['id' => $user_group->id()]) }}"
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