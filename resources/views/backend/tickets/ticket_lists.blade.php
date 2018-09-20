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
        @if($tickets->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Ticket No</th>
                    <th>Müşteri</th>
                    <th>Gsm</th>
                    <th>E-Mail</th>
                    <th>Konu</th>
                    <th>Durumu</th>
                    <th>Tarih</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id() }}</td>
                        <td>{{ $ticket->fullname() }}</td>
                        <td>{{ $ticket->gsm }}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>
                            @if($ticket->close != 1)
                                {!! ($ticket->reply == 1 ? '<span class="badge badge-warning">Cevaplandı</span>' : '<span class="badge badge-danger">Cevap Bekliyor</span>') !!}
                            @else
                                <span class="badge badge-success">Kapandı</span>
                            @endif
                        </td>
                        <td>{{ $ticket->createdAt() }}</td>
                        <td>
                            <a href="{{ route('backend.ticket.view', ['id' => $ticket->id()]) }}"
                               class="btn btn-info" data-toggle="tooltip" title="@lang('backend/common.view')">
                                <span class="ua-icon-view-all"></span>
                            </a>
                            <a href="{{ route('backend.ticket.remove', ['id' => $ticket->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $tickets->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection