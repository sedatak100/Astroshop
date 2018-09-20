@extends('backend.layouts.default')

@section('header')

    <style type="text/css">
        #order-view  td, .table th{
            padding: 6px 10px !important;
        }
    </style>

@endsection

@section('content')
    <div class="main-container" id="order-view">
        @include('frontend.common.form_error')
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-light mb-3">
                    <div class="card-header">Sipariş Bilgileri</div>
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            <tbody>
                            <tr>
                                <th>Sipariş No</th>
                                <td>{{ $order->id() }}</td>
                            </tr>
                            <tr>
                                <th>Sipariş Tarihi</th>
                                <td>{{ $order->createdAt() }}</td>
                            </tr>
                            <tr>
                                <th>Güncellenme Tarihi</th>
                                <td>{{ $order->updatedAt() }}</td>
                            </tr>
                            <tr>
                                <th>Ödeme Tipi</th>
                                <td>{{ $order->payment_method }}</td>
                            </tr>
                            <tr>
                                <th>Kargo</th>
                                <td>{{ $order->shipping_method }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light mb-3">
                    <div class="card-header">Müşteri Bilgileri</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>Adı Soyadı</th>
                                <td>
                                    @if($order->customer_id > 0)
                                        <a href="{{ route('backend.customer.edit', ['id' => $order->customer_id]) }}"
                                           data-toggle="tooltip"
                                           title="Müşteri Detayını Görüntüle"
                                           style="color: rgb(0, 86, 179)">
                                            {{ $order->fullname() }}
                                        </a>
                                    @else
                                        {{ $order->fullname() }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Grubu</th>
                                <td>
                                    @if($order->customer_group_id > 0)
                                        {{ $order->customer->group()->name }}
                                    @else
                                        Misafir
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>GSM</th>
                                <td>{{ $order->gsm }}</td>
                            </tr>
                            <tr>
                                <th>Telefon</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light mb-3">
                    <div class="card-header">Adres Bilgileri</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Tip</th>
                                <th>Adı Soyadı</th>
                                <th>Ülke/Şehir/İlçe</th>
                                <th>Adres</th>
                                <th>Adres Devamı</th>
                                <th>Posta Kodu</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Teslimat Adresi</th>
                                <td>{{ $order->shippingFullname() }}</td>
                                <td>{{ $order->shipping_country }} / {{ $order->shipping_city }}
                                    / {{ $order->shipping_district }}</td>
                                <td>{{ $order->shipping_address1 }}</td>
                                <td>{{ $order->shipping_address2 }}</td>
                                <td>{{ $order->shipping_postcode }}</td>
                            </tr>
                            <tr>
                                <th>Fatura Adresi</th>
                                <td>{{ $order->paymentFullname() }}</td>
                                <td>{{ $order->payment_country }} / {{ $order->payment_city }}
                                    / {{ $order->payment_district }}</td>
                                <td>{{ $order->payment_address1 }}</td>
                                <td>{{ $order->payment_address2 }}</td>
                                <td>{{ $order->payment_postcode }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        @if($order->note != '')
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light mb-3">
                    <div class="card-header">Alışveriş Notu</div>
                    <div class="card-body">
                        {{ $order->note }}
                    </div>
                </div>
            </div>
        </div>
        <br />
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light mb-3">
                    <div class="card-header">Ürün Bilgileri</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
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
                                    <td class="text-right">{{ $product->priceWithTaxFormat() }}</td>
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
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light mb-3">
                    <div class="card-header">Sipariş Geçmişi</div>
                    <div class="card-body">
                        @if($order->histories->count() > 0)
                            <table class="table table-striped table-bordered">
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
                            <br/>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('backend.order.history_add', ['id' => $order->id()]) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Durumu</label>
                                        <select name="order_status_id" class="form-control">
                                            <option value="">@lang('backend/common.choose')</option>
                                            @foreach($order_statuses as $order_status)
                                                <option value="{{ $order_status->id() }}">{{ $order_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Not</label>
                                        <textarea name="note" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Durumu Güncelle</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection