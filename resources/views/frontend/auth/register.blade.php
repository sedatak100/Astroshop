@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/register.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>Kayıt Ol</h1>
                <span>Sitemize kaydolun, imkanlar ve fırsatlardan ilk önce siz haber alın.</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <section class="m-t-20 m-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 center no-padding">
                    <div class="col-md-12">
                        <h3>Yeni Hesap Oluştur</h3>
                        <p>Kaydınızın başarıyla gerçekleştirilebilmesi için formdaki kısımları eksiksiz bir şekilde
                            doldurunuz.</p>
                    </div>
                    <form action="{{ route('frontend.register') }}" method="post">
                        @csrf
                        @include('frontend.common.form_error')
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Adınız*</label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control input-lg" placeholder="Adınız" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Soyadınız*</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control input-lg" placeholder="Soyadınız" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Telefon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control input-lg" placeholder="Telefon" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Gsm</label>
                            <input type="text" name="gsm" value="{{ old('gsm') }}" class="form-control input-lg" placeholder="Gsm" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Fax</label>
                            <input type="text" name="fax" value="{{ old('fax') }}" class="form-control input-lg" placeholder="Fax" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="Email" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Şifre*</label>
                            <input type="password" name="password" value="" class="form-control input-lg" placeholder="Şifre" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="sr-only">Şifre Tekar*</label>
                            <input type="password" name="password_confirmation" value="" class="form-control input-lg" placeholder="Şifre Tekrar" required />
                        </div>
                        <div class="col-md-8 left">
                            <h4 class="upper"><a href="#collapseFour" data-toggle="collapse" class="collapsed"
                                                 aria-expanded="false"> Üyelik Sözleşmesini Okumak İçin Tıklayınız <i
                                            class="fa fa-arrow-circle-o-down"></i></a></h4>
                            <div class="col-md-12">
                                <div style="height: 0px;" aria-expanded="false" id="collapseFour"
                                     class="panel-collapse row collapse">
                                    <div class="panel-body">
                                        <div class="sep-top-xs">
                                            <div class="row">
                                                {!! $customer_contract->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="checkbox" name="contract" value="1" @if(old('contract') == "1") checked @endif /> Üyelik sözleşmesini, iade prosedürünü ve
                            diğer yasal zorunlulukları içeren dökümanı okudum ve kabul ediyorum.
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-default">Oluştur</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('footer')

@endsection