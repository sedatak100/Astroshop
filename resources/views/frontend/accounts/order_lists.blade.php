@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    @component('frontend.accounts.menu', ['menu_active' => 'order'])@endcomponent
    <!-- Shop products -->
    <section id="shop-checkout" class="m-t-30 m-b-30">
        <div class="container">
            <div class="shop-cart">
                <div class="row">
                    <div class="col-md-12">
                        @if($orders->count())
                            <table class="table table-striped table-bordered" style="width: 100% !important;">
                                <thead>
                                <tr>
                                    <th>Sip.No</th>
                                    <th>Durumu</th>
                                    <th>Tutar</th>
                                    <th>Güncellenme Tarihi</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id() }}</td>
                                        <td>{{ ($order->orderStatus) ? $order->orderStatus->name : '' }}</td>
                                        <td>{{ $order->totalFormat() }}</td>
                                        <td>{{ $order->updatedAt() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('frontend.account.order.view', ['id' => $order->id()]) }}"
                                               class="btn btn-info btn-xs" data-toggle="tooltip"
                                               title="Sipariş Detayı">
                                                <i class="fa fa-street-view"></i> Detay
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links('backend.common.pagination') }}
                        @else
                            <div class="alert alert-info">
                                Henüz hiç siparişiniz bulunmuyor
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Shop products -->
@endsection

@section('footer')

@endsection