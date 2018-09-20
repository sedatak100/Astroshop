@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.product.attribute.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($attribute_groups->count())
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
                @foreach($attribute_groups as $attribute_group)
                    <tr>
                        <td>{{ $attribute_group->order }}</td>
                        <td>{{ $attribute_group->name }}</td>
                        <td><span class="badge badge-status-{{ $attribute_group->status }}">@lang('backend/common.status_' . $attribute_group->status)</span></td>
                        <td>{{ $attribute_group->countAttribute() }}</td>
                        <td>{{ $attribute_group->type }}</td>
                        <td>
                            <a href="{{ route('backend.product.attribute.edit', ['id' => $attribute_group->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.product.attribute.remove', ['id' => $attribute_group->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $attribute_groups->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection