@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/register.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>Sipariş Öncesi Üyelik</h1>
                <span>Sepetinize devam edebilmeniz için aşağıdaki adımı tamamlanız gerekmektedir.</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <section class="m-t-20 m-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6 no-padding">
                    <div class="col-md-12">
                        <h3>Üye Girişi</h3>
                        <p>Siparişinizi üye girişi yaparak tamamlayabilirsiniz.</p>
                    </div>
                    <form action="{{ route('frontend.login') }}" method="post">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('frontend.cart.basket.logged') }}" />
                        @include('frontend.common.form_error')
                        <div class="col-md-12 form-group">
                            <label class="sr-only">E-Mail Adresiniz</label>
                            <input type="email" name="email" class="form-control input-lg" placeholder="E-Mail" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="sr-only">Şifreniz</label>
                            <input type="password" name="password" class="form-control input-lg" placeholder="Şifre" value="" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>
                                <input type="checkbox" name="remember" value="1" />
                                <span> Beni Hatırla</span>
                            </label>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-default">Giriş Yap</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6  no-padding">
                    <div class="col-md-12">
                        <p style="margin-bottom: 5px">Dilerseniz siparişinize üye olarak devam edebilirsiniz.</p>
                        <a href="{{ route('frontend.register') }}" class="btn btn-primary">Üye Olmak İçin Tıklayın</a>
                    </div>
                    <p></p>
                    <div class="col-md-12">
                        <p style="margin-bottom: 5px">Dilerseniz siparişinize üye olmadan devam edebilirsiniz</p>
                        <a href="{{ route('frontend.cart.shipping.view') }}" class="btn btn-primary">Üye Olmadan Devam Etmek İçin Tıklayın</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')

@endsection