@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container ">
        <div class="table-header">
            <div class="table-header__controls"></div>
            <div class="table-header__controls">
                @if($ticket->close != 1)
                <a href="{{ route('backend.ticket.closed', ['id' => $ticket->id()]) }}" class="btn btn-warning icon-left mr-3 btn-remove-alert" data-message="Talep Kapatılsın mı?">
                    Talebi Kapat <span class="btn-icon ua-icon-circle-close"></span>
                </a>
                @endif
            </div>
        </div>
        <table class="table table-striped table-bordered" style="width: 100% !important;">
            <tbody>
            <tr>
                <th>Destek No</th>
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
                        <a href="{{ route('backend.order.view', ['id' => $ticket->order_id]) }}"
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
        @if($ticket->replies->count() > 0)
            <br />
            @foreach($ticket->replies as $reply)
                <div class="m-messenger__messages-message {{ $reply->customer_id > 0 ? 'is-self' : 'is-interlocutor' }}">
                    <div class="m-messenger__messages-wrap">

                        <div class="m-messenger__messages-message-text">
                            <div class="m-messenger__messages-attachment-name">{{ $reply->fullname() }}</div>
                            {!! nl2br(e($reply->message)) !!}
                        </div>
                        <span class="m-messenger__messages-date">{{ $reply->createdAt() }}</span>
                    </div>
                </div>
            @endforeach
        @endif
        <br />
        <div class="card">
            <div class="card-header">
                Cevap Yaz
            </div>
            <div class="card-body">
                <form action="{{ route('backend.ticket.reply.added', ['id' => $ticket->id()]) }}" method="post">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label class="sr-only">Mesaj</label>
                        <textarea name="message" class="form-control input-lg" placeholder="Mesajınız"
                                  required>{{ old('message') }}</textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-success">Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection