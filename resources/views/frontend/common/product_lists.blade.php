<div class="shop">
    <div class="grid-layout grid-3-columns" data-item="grid-item">
        <!-- Portfolio Filter -->
        <!-- end: Portfolio Filter -->
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="grid-item portfolio-item img-zoom pf-illustrations pf-media pf-icons pf-Media">
                    <div class="product item-border">
                        <div class="product-image">
                            <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">
                                <img alt="Shop product image!" src="{{ $product->getImageUrl('list') }}">
                            </a>
                            <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">
                                <img alt="Shop product image!" src="{{ $product->getImageUrl('list') }}">
                            </a>
                            @if($product->currentCampaign)
                                <span class="product-sale-off">%{{ $product->currentCampaign->rate($product->calcPrice(), $product->currency_id) }} indirim</span>
                            @endif
                            @if($product->short_description)
                                <div class="portfolio-description" onclick="location.href='{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}'">
                                    <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">
                                        <h3>Açıklama</h3>
                                        <span>{{ $product->short_description }}</span>
                                    </a>
                                </div>
                            @endif
                            <!--
                            <span class="product-wishlist">
                                            <a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}"><i class="fa fa-shopping-cart"></i></a>
                            </span>
                            -->
                        </div>
                        <div class="product-description">
                            <div class="product-category">
                                @if($product->categories->count() > 0)
                                    {{ $product->categories->first()->name }}
                                @endif
                            </div>
                            <div class="product-title">
                                <h3><a href="{{ route('frontend.product.view', ['seo_name' => $product->seo_name]) }}">{{ str_limit($product->name, 10, '..') }}</a></h3>
                            </div>
                            <div class="product-price">
                                @if($product->currentCampaign)
                                    <del>{{ $product->priceFormat() }}</del>
                                    <ins>{{ $product->currentCampaign->priceFormat($product->tax_class_id, $product->currency_id) }}</ins>
                                @else
                                    <ins>{{ $product->priceFormat() }}</ins>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                Hiç ürün bulunamadı
            </div>
        @endif
    </div>
    <!-- Load next portfolio items -->
    <nav aria-label="Page navigation" class="pull pull-right">
        {{ $products->appends(Request::input())->links() }}
    </nav>
    <!-- end:Load next portfolio items -->
</div>