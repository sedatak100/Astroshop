@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/odeme.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>Teslimat ve Fatura Bilgilerim</h1>
                <span>Lütfen aşağıdan teslimat, fatura ve ödeme tipini seçiniz..</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <!-- SHOP CHECKOUT -->
    <section id="shop-checkout" class="m-t-30 m-b-30">
        <form action="{{ route('frontend.cart.shipping.added') }}" method="post">
            @csrf
            <div class="container">
                <div class="shop-cart">
                    @include('frontend.common.form_error')
                    <div class="row">
                        <div class="col-md-6 no-padding">
                            <div id="shipping">
                                <div class="col-md-12">
                                    <h4 class="upper">Teslimat Adresim</h4>
                                </div>
                                @if(auth()->guest())
                                    <div class="col-md-12 form-group">
                                        <label class="sr-only">E-Mail Adresiniz</label>
                                        <input type="email" name="email" class="form-control input-lg"
                                               placeholder="E-Mail Adresiniz"
                                               value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="sr-only">Telefon Numaranız</label>
                                        <input type="text" name="phone" class="form-control input-lg"
                                               placeholder="Telefon Numaranız"
                                               value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="sr-only">Gsm Numaranız</label>
                                        <input type="text" name="gsm" class="form-control input-lg"
                                               placeholder="Gsm Numaranız"
                                               value="{{ old('gsm', auth()->check() ? auth()->user()->gsm : '') }}">
                                    </div>
                                @endif
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
                                    <select name="shipping[country_id]" class="select-country"
                                            style="display: none !important;">
                                        <option value="{{ config('config.default_country') }}"></option>
                                    </select>
                                    <div class="col-md-6 form-group">
                                        <label class="sr-only">Şehir</label>
                                        <select name="shipping[city_id]" class="select-city">
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="sr-only">İlçe</label>
                                        <select name="shipping[district_id]" class="select-district"
                                                data-selected_id="{{ old('shipping.district_id', $shipping_address ? $shipping_address->district_id : '') }}">
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
                                    <input type="checkbox" name="shipping_payment_same" value="1"
                                           @if(old('shipping_payment_same') == 1) checked
                                           @endif style="display: none"/>
                                    <button type="submit" class="btn-sp-diff btn btn-primary">Fatura Adresiniz Farklı
                                        İse
                                        Tıklayın
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 no-padding">
                            <div id="payment" style="display: none">
                                <div class="col-md-12">
                                    <h4 class="upper">Fatura Adresim</h4>
                                </div>
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
                                    <select name="payment[country_id]" class="select-country"
                                            style="display: none !important;">
                                        <option value="{{ config('config.default_country') }}"></option>
                                    </select>
                                    <div class="col-md-6 form-group">
                                        <label class="sr-only">Şehir</label>
                                        <select name="payment[city_id]" class="select-city">
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="sr-only">İlçe</label>
                                        <select name="payment[district_id]" class="select-district"
                                                data-selected_id="{{ old('payment.district_id', $payment_address ? $payment_address->district_id : '') }}">
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
                                    <button type="submit" class="btn-sp-same btn btn-primary">Fatura Adresiniz Teslimat
                                        Adresiniz ile Aynı
                                        İse Tıklayın
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="upper">Not</h4>
                            </div>
                            <div class="col-md-12 form-group">
                            <textarea class="form-control input-lg" name="note"
                                      placeholder="Alışveriş ve ödemenizle ilgili notlarınızı veya özel iletinizi belirtebilirsiniz."
                                      rows="7">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="seperator">
                        <i class="fa fa-credit-card"></i>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="upper">Ürünleriniz</h4>
                            <div class="table table-condensed table-striped table-responsive table table-bordered table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th class="cart-product-thumbnail">Ürün</th>
                                        <th class="cart-product-name">Açıklama</th>
                                        <th class="cart-product-subtotal">Ücret</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cart_items as $cart_item)
                                        <tr>
                                            <td class="cart-product-thumbnail">
                                                <div class="cart-product-thumbnail-name">{{ $cart_item->name }}</div>
                                            </td>
                                            <td class="cart-product-description">
                                                <p>
                                                    @if($cart_item->product->categories->count() > 0)
                                                        <span>{{ $cart_item->product->categories->first()->name }}</span>
                                                    @endif
                                                    @if($cart_item->product->brand)
                                                        <span>Marka: {{ $cart_item->product->brand->name }}</span>
                                                    @endif
                                                    @if($cart_item->product->serial_no)
                                                        <span>Seri: {{ $cart_item->product->serial_no }}</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="cart-product-subtotal">
                                                <span class="amount">{{ \App\Model\Currencies\Currency::format($cart_item->getPriceSum()) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <h4>Toplam Tutar</h4>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="cart-product-name">
                                            <strong>Alışveriş Tutarı</strong>
                                        </td>

                                        <td class="cart-product-name text-right">
                                            <span class="amount">{{ \App\Model\Currencies\Currency::format(Cart::getSubTotal()) }}</span>
                                        </td>
                                    </tr>
                                    @foreach(Cart::getConditions() as $condition)
                                        <tr>
                                            <td class="cart-product-name">
                                                <strong>{{ $condition->getName() }}</strong>
                                            </td>

                                            <td class="cart-product-name  text-right">
                                                <span class="amount">{{ \App\Model\Currencies\Currency::format($condition->getValue()) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="cart-product-name">
                                            <strong>Toplam</strong>
                                        </td>

                                        <td class="cart-product-name text-right">
                                            <span class="amount color lead"><strong>{{ \App\Model\Currencies\Currency::format(Cart::getTotal()) }}</strong></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="upper">Ödeme Şekli</h4>
                                    <table class="payment-method table table-bordered table-condensed table-responsive">
                                        <tbody>
                                        @foreach($payment_methods as $key => $payment_method)
                                            <tr>
                                                <td>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="payment_method"
                                                                   value="{{ $payment_method->getKey() }}">
                                                            <b class="dark">{{ $payment_method->getMethodName() }}</b>
                                                            <br>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="payment-method-content">

                                </div>

                            </div>
                            <button class="btn btn-default icon-left float-right"><span>Ödeme Yap</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- end: SHOP CHECKOUT -->
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('frontend/js/region.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            // Teslimat ve Fatura Adresi aynı, farklı ise ona göre menuler gösterir
            var $checkbox_sp_same = $('INPUT[NAME="shipping_payment_same"]');

            $checkbox_sp_same.change(function (e) {
                e.preventDefault();
                if ($(this).is(':checked')) {
                    $('#payment').slideDown();
                    $('.btn-sp-diff').hide();
                } else {
                    $('#payment').slideUp();
                    $('.btn-sp-diff').show();
                }
            })

            $('.btn-sp-diff').click(function (e) {
                e.preventDefault();
                $checkbox_sp_same.prop('checked', true).trigger('change');

            });

            $('.btn-sp-same').click(function (e) {
                e.preventDefault();
                $checkbox_sp_same.removeProp('checked').trigger('change');
            });

            $checkbox_sp_same.trigger('change');
        })
    </script>
@endsection