@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    @component('frontend.accounts.menu', ['menu_active' => 'ticket'])@endcomponent
    <!-- Shop products -->
    <section id="shop-checkout" class="m-t-30 m-b-30">
        <div class="container">
            <div class="shop-cart">
                <div class="row">
                    @include('frontend.common.form_error')
                    @include('frontend.common.form_success')
                    <div class="col-md-8">
                        @if($tickets->count())
                            <table class="table table-striped table-bordered" style="width: 100% !important;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tarih</th>
                                    <th>İlgili Sipariş</th>
                                    <th>Konu</th>
                                    <th>Durumu</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id() }}</td>
                                        <td>{{ $ticket->createdAt() }}</td>
                                        <td>
                                            @if($ticket->order_id > 0)
                                                <a href="{{ route('frontend.account.order.view', ['id' => $ticket->order_id]) }}" data-toggle="tooltip" title="Sipariş Detayını Görüntüle">
                                                    Sip.No: {{ $ticket->order_id }}
                                                </a>
                                            @else
                                                Yok
                                            @endif
                                        </td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>
                                            @if($ticket->close != 1)
                                                {{ ($ticket->reply == 1 ? 'Cevaplandı' : 'Cevap Bekliyor') }}
                                            @else
                                                Kapandı
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('frontend.account.ticket.view', ['id' => $ticket->id()]) }}"
                                               class="btn btn-info btn-xs" data-toggle="tooltip"
                                               title="Talep Detayı">
                                                <i class="fa fa-street-view"></i> Detay
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $tickets->links('backend.common.pagination') }}
                        @else
                            <div class="alert alert-info">
                                Henüz hiç destek talebiniz bulunmuyor.
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('frontend.account.ticket.added') }}" method="post">
                            @csrf
                            <div class="col-md-12 form-group">
                                <label class="sr-only">Konu*</label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                       class="form-control input-lg" placeholder="Konu" required/>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="sr-only">İlgili Sipariş*</label>
                                <select name="order_id">
                                    <option @if(old('order_id', '0') == '0') selected @endif  value="0">Yok</option>
                                    @foreach($orders as $order)
                                        <option @if(old('order_id') == $order->id()) selected @endif value="{{ $order->id() }}">Sipariş No: {{ $order->id() }} Toplam: {{ $order->totalFormat() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="sr-only">Mesaj</label>
                                <textarea name="message" class="form-control input-lg" placeholder="Mesajınız"
                                          required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-default">Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Shop products -->
@endsection

@section('footer')

@endsection