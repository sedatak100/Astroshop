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
        @if($contacts->count())
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Adı Soyadı</th>
                    <th>E-Mail</th>
                    <th>Gsm</th>
                    <th>Konu</th>
                    <th>Durumu</th>
                    <th>Tarih</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->fullname() }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->gsm }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>
                            <span class="badge badge-status-{{ $contact->read }}">
                                @lang('backend/common.read_' . $contact->read)
                            </span>
                        </td>
                        <td>{{ $contact->createdAt() }}</td>
                        <td>
                            <a href="{{ route('backend.contact.form.view', ['id' => $contact->id()]) }}"
                               class="btn btn-info" data-toggle="tooltip" title="@lang('backend/common.view')">
                                <span class="ua-icon-view-all"></span>
                            </a>
                            <a href="{{ route('backend.contact.form.remove', ['id' => $contact->id()]) }}"
                               class="btn-remove-alert btn btn-danger" data-toggle="tooltip"
                               title="@lang('backend/common.remove')">
                                <span class="ua-icon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $contacts->links('backend.common.pagination') }}
        @else
            @include('backend.common.empty_alert')
        @endif
    </div>
@endsection

@section('footer')

@endsection