@if($brands)
    <div class="widget clearfix widget-archive">
        <h4 class="widget-title">MARKALAR</h4>
        <ul class="list list-lines">
            @foreach($brands as $brand)
                <li>
                    <img src="{{ Storage::disk('public')->url($brand->image) }}" class="ilk3" />
                    <a href="{{ route('frontend.product.brand.products', ['seo_name' => $brand->seo_name]) }}" title="{{ $brand->name }}">{{ $brand->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif