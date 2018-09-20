@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.customer.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($customers->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı Soyadı</th>
                    <th>Müşteri Grubu</th>
                    <th>Durum</th>
                    <th>E-Mail</th>
                    <th>Phone</th>
                    <th>Gsm</th>
                    <th>Son Giriş Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->fullname() }}</td>
                        <td>{{ $customer->group()->name }}</td>
                        <td><span class="badge badge-status-{{ $customer->status }}">@lang('backend/common.status_' . $customer->status)</span></td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->gsm }}</td>
                        <td>{{ $customer->lastLoginDate() }}</td>
                        <td>{{ $customer->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.customer.edit', ['id' => $customer->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.customer.remove', ['id' => $customer->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $customers->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection