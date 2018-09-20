@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">

            </div>
        </div>
        @if($orders->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sip.No</th>
                    <th>Müşteri</th>
                    <th>E-Mail</th>
                    <th>Gsm</th>
                    <th>Telefon</th>
                    <th>Durumu</th>
                    <th>Tutar</th>
                    <th>Ekleme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id() }}</td>
                        <td>{{ $order->fullname() }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->gsm }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ ($order->orderStatus) ? $order->orderStatus->name : '' }}</td>
                        <td>{{ $order->totalFormat() }}</td>
                        <td>{{ $order->createdAt() }}</td>
                        <td>{{ $order->updatedAt() }}</td>
                        <td>
                            <a href="{{ route('backend.order.view', ['id' => $order->id()]) }}"
                               class="btn btn-info" data-toggle="tooltip" title="@lang('backend/common.view')">
                                <span class="ua-icon-view-all"></span>
                            </a>
                            <a href="{{ route('backend.order.remove', ['id' => $order->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orders->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection