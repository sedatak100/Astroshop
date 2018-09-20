@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.product.category.add', ['id' => $id]) }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($categories->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sıra</th>
                    <th>Adı</th>
                    <th>Durum</th>
                    <th>Açıklama</th>
                    <th>Alt Kategori Sayısı</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->order }}</td>
                        <td>{{ $category->name }}</td>
                        <td><span class="badge badge-status-{{ $category->status }}">@lang('backend/common.status_' . $category->status)</span></td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->countChildren() }}</td>
                        <td>{{ $category->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.product.category.lists', ['id' => $category->id()]) }}"
                               class="btn btn-info" data-toggle="tooltip" title="Alt Kategoriler">
                                <span class="ua-icon-view-all"></span>
                            </a>
                            <a href="{{ route('backend.product.category.edit', ['id' => $category->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.product.category.remove', ['id' => $category->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $categories->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection