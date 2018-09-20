@extends('frontend.layouts.default')

@section('meta_title', 'İletisim Formu')
@section('meta_keyword', 'iletisim, bize yazın')
@section('meta_description', 'istediğiniz zaman bize ulaşabilirsiniz')

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/menu4.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>İletişim Formu</h1>
                <span>Aşağıdaki form aracılığıyla istediğiniz zaman bize ulaşabilirsiniz.</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <section id="page-content" class="sidebar-right m-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 center">
                    <form action="{{ route('frontend.contact.form.added') }}" method="post">
                        @csrf
                        @include('frontend.common.form_error')
                        @include('frontend.common.form_success')
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Adınız*</label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}"
                                   class="form-control input-lg" placeholder="Adınız" required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Soyadınız*</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}"
                                   class="form-control input-lg" placeholder="Soyadınız" required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">E-Posta*</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control input-lg" placeholder="E-Posta Adresiniz" required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Gsm</label>
                            <input type="text" name="gsm" value="{{ old('gsm') }}" class="form-control input-lg"
                                   placeholder="Gsm"/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="sr-only">Konu*</label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                   class="form-control input-lg" placeholder="Konu" required/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="sr-only">Mesaj</label>
                            <textarea name="message" class="form-control input-lg" placeholder="Mesajınız" required>{{ old('message') }}</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-default">Gönder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')

@endsection