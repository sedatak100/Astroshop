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
                        <table class="table table-striped table-bordered" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th colspan="3">Şuanki Durumu: <strong>{{ $order->orderStatus->name }}</strong></th>
                                <th colspan="2">Sipariş No: <strong>{{ $order->id() }}</strong></th>
                            </tr>
                            <tr>
                                <th>Ürün</th>
                                <th>Model</th>
                                <th>Birim Fiyat</th>
                                <th>Adet</th>
                                <th>Tutar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->model }}</td>
                                    <td class="text-center">{{ $product->priceWithTaxFormat() }}</td>
                                    <td class="text-center">{{ $product->quantity }}</td>
                                    <td class="text-right">{{ $product->totalFormat() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            @foreach($order->totals as $total)
                                <tr>
                                    <th colspan="4" class="text-right">{{ $total->name }}</th>
                                    <th class="text-right">{{ $total->priceFormat() }}</th>
                                </tr>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div>
                @if($order->histories->count() > 0)
                <div class="row">
                    <div class="col-md-12">
                            <table class="table table-striped table-bordered" style="width: 100% !important;">
                                <thead>
                                <tr>
                                    <th>Durumu</th>
                                    <th>Tarih</th>
                                    <th>Not</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->histories as $history)
                                    <tr>
                                        <th>{{ $history->order_status }}</th>
                                        <td>{{ $history->createdAt() }}</td>
                                        <td>{{ $history->note }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- end: Shop products -->
@endsection

@section('footer')

@endsection