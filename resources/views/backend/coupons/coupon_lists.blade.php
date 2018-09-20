@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                <a href="{{ route('backend.coupon.add') }}" class="btn btn-success icon-left mr-3">
                    @lang('backend/common.add') <span class="btn-icon ua-icon-plus"></span>
                </a>
            </div>
        </div>
        @if($coupons->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>Durumu</th>
                    <th>Kod</th>
                    <th>Tip</th>
                    <th>İndirim</th>
                    <th>Başlanıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->name }}</td>
                        <td><span class="badge badge-status-{{ $coupon->status }}">@lang('backend/common.status_' . $coupon->status)</span></td>
                        <td>{{ $coupon->code }}</td>
                        <td>@lang('backend/common.coupon_type_' . $coupon->type)</td>
                        <td>{{ $coupon->discount }}</td>
                        <td>{{ $coupon->start_date }}</td>
                        <td>{{ $coupon->end_date }}</td>
                        <td>
                            <a href="{{ route('backend.coupon.edit', ['id' => $coupon->id()]) }}"
                               class="btn btn-primary" data-toggle="tooltip" title="@lang('backend/common.edit')">
                                <span class="ua-icon-pencil"></span>
                            </a>
                            <a href="{{ route('backend.coupon.remove', ['id' => $coupon->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $coupons->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection