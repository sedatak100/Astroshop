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
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>Adı Soyadı</th>
                <td>{{ $contact->fullname() }}</td>
            </tr>
            <tr>
                <th>E-Mail</th>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <th>Gsm</th>
                <td>{{ $contact->gsm }}</td>
            </tr>
            <tr>
                <th>IP</th>
                <td>{{ $contact->ip }}</td>
            </tr>
            <tr>
                <th>Tarayıcı</th>
                <td>{{ $contact->user_agent }}</td>
            </tr>
            <tr>
                <th>Konu</th>
                <td>{{ $contact->subject }}</td>
            </tr>
            <tr>
                <th>Tarih</th>
                <td>{{ $contact->createdAt() }}</td>
            </tr>
            <tr>
                <th>Mesaj</th>
                <td>{{ $contact->message }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('footer')

@endsection