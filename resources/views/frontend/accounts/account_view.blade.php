@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    @component('frontend.accounts.menu', ['menu_active' => 'account'])@endcomponent
    <!-- Shop products -->
    <section id="shop-checkout" class="m-t-30 m-b-30">
        <div class="container">
            <div class="shop-cart">
                <div class="row">
                    @include('frontend.common.form_error')
                    @include('frontend.common.form_success')
                    <div class="col-md-6 no-padding">
                        <div class="col-md-12">
                            <h4 class="upper">Kişisel Bilgilerim</h4>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>İSİM:</label>
                            <label class="ilk">{{ auth()->user()->firstname }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>SOYİSİM:</label>
                            <label class="ilk">{{ auth()->user()->lastname }}</label>

                        </div>
                        <div class="col-md-4 form-group">
                            <label class="">E-MAİL:</label><label class="ilk">{{ auth()->user()->email }}</label>
                        </div>
                        @if(auth()->user()->phone)
                            <div class="col-md-4 form-group">
                                <label class="">Telefon</label>
                                <label class="ilk">{{ auth()->user()->phone }}</label>
                            </div>
                        @endif
                        @if(auth()->user()->gsm)
                            <div class="col-md-4 form-group">
                                <label class="">Gsm</label>
                                <label class="ilk">{{ auth()->user()->gsm }}</label>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <h4 class="upper">Teslimat Adresi Bilgilerim</h4>
                        </div>
                        @if($shipping_address)
                            <div class="col-md-12 form-group">
                                <label>ADRES:</label>
                                <label class="ilk">{{ $shipping_address->address1 }}</label>
                            </div>
                            @if($shipping_address->address2)
                                <div class="col-md-12 form-group">
                                    <label>ADRES DEVAMI:</label>
                                    <label class="ilk">{{ $shipping_address->address2 }}</label>
                                </div>
                            @endif
                            <div class="col-md-4 form-group">
                                <label>Şehir:</label>
                                <label class="ilk">şehir</label>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="">İlçe</label>
                                <label class="ilk">çankaya</label>
                            </div>
                            @if($shipping_address->postcode)
                                <div class="col-md-4 form-group">
                                    <label class="">Postakodu</label>
                                    <label class="ilk">0006</label>
                                </div>
                            @endif
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    Lütfen sağ taraftaki formdan teslimat adresi tanımlayınız.
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <h4 class="upper">Fatura Adresi Bilgilerim</h4>
                        </div>
                        @if($payment_address)
                            <div class="col-md-12 form-group">
                                <label>ADRES:</label>
                                <label class="ilk">{{ $payment_address->address1 }}</label>
                            </div>
                            @if($payment_address->address2)
                                <div class="col-md-12 form-group">
                                    <label>ADRES DEVAMI:</label>
                                    <label class="ilk">{{ $payment_address->address2 }}</label>
                                </div>
                            @endif
                            <div class="col-md-4 form-group">
                                <label>Şehir:</label>
                                <label class="ilk">şehir</label>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="">İlçe</label>
                                <label class="ilk">çankaya</label>
                            </div>
                            @if($payment_address->postcode)
                                <div class="col-md-4 form-group">
                                    <label class="">Postakodu</label>
                                    <label class="ilk">0006</label>
                                </div>
                            @endif
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    Lütfen sağ taraftaki formdan fatura adresi tanımlayınız.
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <h4 class="upper"><a href="#collapseFour" data-toggle="collapse" class="" aria-expanded="true">
                                Kişisel &amp; Adres Bilgilerini Güncelle<i class="fa fa-arrow-circle-o-down"></i></a>
                        </h4>
                        <div class="col-md-12 no-padding">
                            <div style="height: 0px;" aria-expanded="true" id="collapseFour"
                                 class="panel-collapse row collapse in">
                                <div class="panel-body">
                                    <p>Eğer Sistemimize belirttiğiniz Kişisel &amp; Adres Bilgilerinizde Değişiklik
                                        olduysa bu kısımdan güncelleme yapabilirsiniz.</p>
                                    <div class="sep-top-xs">
                                        <div class="row">
                                            <form action="{{ route('frontend.account.edit') }}" method="post">
                                                @csrf
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">İsim</label>
                                                    <input type="text" name="firstname" class="form-control input-lg"
                                                           placeholder="İsminiz"
                                                           value="{{ old('firstname', auth()->user()->firstname) }}"
                                                           required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Soyisim</label>
                                                    <input type="text" name="lastname" class="form-control input-lg"
                                                           placeholder="Soyisminiz"
                                                           value="{{ old('lastname', auth()->user()->lastname) }}"
                                                           required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Telefon</label>
                                                    <input type="text" name="phone" class="form-control input-lg"
                                                           placeholder="Telefon"
                                                           value="{{ old('phone', auth()->user()->phone) }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Gsm</label>
                                                    <input type="text" name="gsm" class="form-control input-lg"
                                                           placeholder="Gsm"
                                                           value="{{ old('gsm', auth()->user()->gsm) }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Şifre</label>
                                                    <input type="password" name="password" class="form-control input-lg"
                                                           placeholder="Şifre - Değiştirmek istemiyorsanız boş bırakınız"
                                                           value="">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Şifre Tekrar</label>
                                                    <input type="password" name="password_confirmation"
                                                           class="form-control input-lg"
                                                           placeholder="Şifre Tekrar - Değiştirmek istemiyorsanız boş bırakınız"
                                                           value="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Lütfen Güncelleyeceğiniz Adres Tipini Seçiniz;</p>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="sr-only">Adres</label>
                                                <select name="address_type">
                                                    <option @if(old('type', 'shipping') == 'shipping') selected
                                                            @endif value="shipping">Teslimat Adresi
                                                    </option>
                                                    <option @if(old('type') == 'payment') selected @endif value="payment">
                                                        Fatura Adresi
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="shipping">
                                            <form action="{{ route('frontend.account.address.edit') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="type" value="shipping"/>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Adı</label>
                                                    <input type="text" name="shipping[firstname]" class="form-control input-lg"
                                                           placeholder="Adı"
                                                           value="{{ old('shipping.firstname', $shipping_address ? $shipping_address->firstname : '') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Soyadı</label>
                                                    <input type="text" name="shipping[lastname]" class="form-control input-lg"
                                                           placeholder="Soyadı"
                                                           value="{{ old('shipping.lastname', $shipping_address ? $shipping_address->lastname : '') }}">
                                                </div>
                                                <div class="global-region">
                                                    <select name="shipping[country_id]" class="select-country" style="display: none !important;">
                                                        <option value="{{ config('config.default_country') }}"></option>
                                                    </select>
                                                    <div class="col-md-6 form-group">
                                                        <label class="sr-only">Şehir</label>
                                                        <select name="shipping[city_id]" class="select-city">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="sr-only">İlçe</label>
                                                        <select name="shipping[district_id]" class="select-district" data-selected_id="{{ old('shipping.district_id', $shipping_address ? $shipping_address->district_id : '') }}">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only">Addres</label>
                                                    <input type="text" name="shipping[address1]" class="form-control input-lg"
                                                           placeholder="Adresiniz"
                                                           value="{{ old('shipping.address1', $shipping_address ? $shipping_address->address1 : '') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Addres 2</label>
                                                    <input type="text" name="shipping[address2]" class="form-control input-lg"
                                                           placeholder="Adres devamı"
                                                           value="{{ old('shipping.address2', $shipping_address ? $shipping_address->address2 : '') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Postakodu</label>
                                                    <input type="text" name="shipping[postcode]" class="form-control input-lg"
                                                           placeholder="Postakodu"
                                                           value="{{ old('shipping.postcode', $shipping_address ? $shipping_address->postcode : '') }}">
                                                </div>
                                                <div class="col-md-12 form-group ">
                                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row" id="payment" style="display: none;">
                                            <form action="{{ route('frontend.account.address.edit') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="type" value="payment"/>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Adı</label>
                                                    <input type="text" name="payment[firstname]" class="form-control input-lg"
                                                           placeholder="Adı"
                                                           value="{{ old('payment.firstname', $payment_address ? $payment_address->firstname : '') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Soyadı</label>
                                                    <input type="text" name="payment[lastname]" class="form-control input-lg"
                                                           placeholder="Soyadı"
                                                           value="{{ old('payment.lastname', $payment_address ? $payment_address->lastname : '') }}">
                                                </div>
                                                <div class="global-region">
                                                    <select name="payment[country_id]" class="select-country" style="display: none !important;">
                                                        <option value="{{ config('config.default_country') }}"></option>
                                                    </select>
                                                    <div class="col-md-6 form-group">
                                                        <label class="sr-only">Şehir</label>
                                                        <select name="payment[city_id]" class="select-city">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="sr-only">İlçe</label>
                                                        <select name="payment[district_id]" class="select-district" data-selected_id="{{ old('payment.district_id', $payment_address ? $payment_address->district_id : '') }}">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only">Addres</label>
                                                    <input type="text" name="payment[address1]" class="form-control input-lg"
                                                           placeholder="Adresiniz"
                                                           value="{{ old('payment.address1', $payment_address ? $payment_address->address1 : '') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Addres 2</label>
                                                    <input type="text" name="payment[address2]" class="form-control input-lg"
                                                           placeholder="Adres devamı"
                                                           value="{{ old('payment.address2', $payment_address ? $payment_address->address2 : '') }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only">Postakodu</label>
                                                    <input type="text" name="payment[postcode]" class="form-control input-lg"
                                                           placeholder="Postakodu"
                                                           value="{{ old('payment.postcode', $payment_address ? $payment_address->postcode : '') }}">
                                                </div>
                                                <div class="col-md-12 form-group ">
                                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="seperator m-t-0">
                    <i class="fa fa-cogs"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Shop products -->
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('frontend/js/region.js') }}"></script>
    <script type="text/javascript">
        $('SELECT[NAME="address_type"]').change(function () {
            if ($(this).val() == 'shipping') {
                $('#payment').slideUp();
                $('#shipping').slideDown();
            } else {
                $('#shipping').slideUp();
                $('#payment').slideDown();
            }
        });
        $('SELECT[NAME="address_type"]').trigger('change');
    </script>
@endsection