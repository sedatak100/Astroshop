@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    @component('frontend.accounts.menu', ['menu_active' => 'ticket'])@endcomponent
    <!-- Shop products -->
    <section id="shop-checkout" class="m-t-30 m-b-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-center bg-info">Destek Mesajı</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th style="width: 120px;">Destek No</th>
                            <td>{{ $ticket->id() }}</td>
                        </tr>
                        <tr>
                            <th>Durumu</th>
                            <td>
                                @if($ticket->close != 1)
                                    {{ ($ticket->reply == 1 ? 'Cevaplandı' : 'Cevap Bekliyor') }}
                                @else
                                    Kapandı
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tarih</th>
                            <td>{{ $ticket->createdAt() }}</td>
                        </tr>
                        <tr>
                            <th>İlgili Sipariş</th>
                            <td>
                                @if($ticket->order_id > 0)
                                    <a href="{{ route('frontend.account.order.view', ['id' => $ticket->order_id]) }}"
                                       data-toggle="tooltip" title="Sipariş Detayını Görüntüle">
                                        Sip.No: {{ $ticket->order_id }}
                                    </a>
                                @else
                                    Yok
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Konu</th>
                            <td>{{ $ticket->subject }}</td>
                        </tr>
                        <tr>
                            <th>Mesaj</th>
                            <td>{{ $ticket->message }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if($ticket->replies->count() > 0)
                @foreach($ticket->replies as $reply)
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding-top: 0; padding-bottom: 0">
                        <h5 class="title">{{ $reply->fullname() }}</h5>
                    </div>
                    <div class="panel-body">{!! nl2br(e($reply->message)) !!}</div>
                    <div class="panel-footer text-right">
                        <span class="text-right badge badge-primary"><i>{{ $reply->createdAt() }} tarihinde gönderildi</i></span>
                    </div>
                </div>
                @endforeach
            @endif

            @if($ticket->close != 1)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="title">Cevap Yaz</h4>
                </div>
                <div class="panel-body">
                    @include('frontend.common.form_error')
                    @include('frontend.common.form_success')
                    <form action="{{ route('frontend.account.ticket.reply.added', ['id' => $ticket->id()]) }}" method="post">
                        @csrf
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
            @endif
        </div>
    </section>
    <!-- end: Shop products -->
@endsection

@section('footer')

@endsection