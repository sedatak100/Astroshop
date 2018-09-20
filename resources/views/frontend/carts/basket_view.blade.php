@extends('frontend.layouts.default')

@section('header')

@endsection

@section('content')
    <section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/register.jpg') }}">
        <div class="container">
            <div class="page-title">
                <h1>Sepet</h1>
                <span>Alışveriş listeniz aşağıda size sunulmuştur.</span>
            </div>
        </div>
    </section>
    @include('frontend.common.breadcrumb')
    <!-- SHOP CART -->
    <section id="shop-cart" class="m-t-30 m-b-50">
        <div class="container">
            @if($cart_items->count() > 0)
                <div class="shop-cart">
                    <div class="table table-condensed table-striped table-responsive">
                        <form action="{{ route('frontend.cart.update_multiple') }}" method="post" name="updated">
                            @csrf
                            @include('frontend.common.form_error')
                            @include('frontend.common.form_success')
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="cart-product-remove"></th>
                                    <th class="cart-product-thumbnail">Ürün</th>
                                    <th class="cart-product-name">Açıklama</th>
                                    <th class="cart-product-price">Adet Tutarı</th>
                                    <th class="cart-product-quantity">Adet</th>
                                    <th class="cart-product-subtotal">Toplam</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_items as $i => $cart_item)
                                    <tr>
                                        <td class="cart-product-remove">
                                            <input type="hidden" name="cart[{{ $i }}][product_id]" value="{{ $cart_item->id }}" />
                                            <a href="#" class="product-remove" data-product_id="{{ $cart_item->id }}"><i
                                                        class="fa fa-close"></i></a>
                                        </td>

                                        <td class="cart-product-thumbnail">
                                            <a href="{{ route('frontend.product.view', ['seo_name' => $cart_item->product->seo_name]) }}">
                                                <img src="{{ $cart_item->product->getImageUrl('small') }}"
                                                     alt="Bolt Sweatshirt">
                                            </a>
                                            <div class="cart-product-thumbnail-name">
                                                <a href="{{ route('frontend.product.view', ['seo_name' => $cart_item->product->seo_name]) }}">
                                                    {{ $cart_item->name }}
                                                </a>
                                            </div>
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

                                        <td class="cart-product-price">
                                            <span class="amount">{{ \App\Model\Currencies\Currency::format($cart_item->getPriceWithConditions()) }}</span>
                                        </td>

                                        <td class="cart-product-quantity">
                                            <div class="quantity">
                                                <input type="button" class="minus" name="add"
                                                       onclick="azalt('quantity-{{ $i }}')" value="-">
                                                <input type="text" class="qty" name="cart[{{ $i }}][quantity]"
                                                       max="{{ $cart_item->product->quantity }}"
                                                       value="{{ $cart_item->quantity }}" id="quantity-{{ $i }}">
                                                <input type="button" class="plus" onClick="arttir('quantity-{{ $i }}');"
                                                       value="+">
                                            </div>
                                        </td>

                                        <td class="cart-product-subtotal">
                                            <span class="amount">{{ \App\Model\Currencies\Currency::format($cart_item->getPriceSumWithConditions()) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                                <div class="form-group">
                                    <form class="form-inline" action="{{ route('frontend.cart.coupon.uses') }}" method="post">
                                        @csrf
                                    <input type="text" placeholder="Kupon Kodu" id="CouponCode" name="code" class="form-control">
                                    <button type="submit" class="button border" style="border: 0; background: none">
                                        <label class="info">Aktifleştir </label>
                                    </button>
                                    </form>
                                    @if(Cart::getConditionsByType('coupon')->count() > 0)
                                        <form action="{{ route('frontend.cart.coupon.remove') }}" method="post">
                                            @csrf
                                            Kupon kodunuzu iptal etmek için
                                            <button type="submit" class="button border" style="border: 0; background: none">
                                                <label class="info">Tıklayın </label>
                                            </button>
                                        </form>
                                    @else
                                        <p class="small">İndirim kuponunuz mevcutsa, indirimdn faydalanmak için kupon kodunu
                                        belirtilen alana giriniz.</p>
                                    @endif
                                </div>

                        </div>
                        <div class="col-md-8 text-right">
                            <button type="button" class="form-updated-btn btn btn-default">Listeyi Yenile</button>
                        </div>
                    </div>
                    <div class="row">
                        <hr class="space">
                        <div class="col-md-6">
                            <!-- Kargo Hesaplama Alanı -->
                        </div>
                        <div class="col-md-6 p-r-10 ">
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

                            <a href="{{ route('frontend.cart.basket.logged') }}"
                               class="btn btn-default icon-left float-right"><span>Alışverişi Tamamla</span></a>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    Henüz sepetinizde hiç ürün bulunmuyor.
                </div>
            @endif
        </div>
    </section>
    <!-- end: SHOP CART -->
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('frontend/js/basket.view.js') }}"></script>
@endsection