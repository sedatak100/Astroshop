<style type="text/css">
 #categories ul * ul{
     margin-left: 15px;
 }
</style>
@if($categories)
    <div class="widget clearfix widget-archive" id="categories">
        <h4 class="widget-title">ÜRÜN KATEGORİLERİ</h4>
        <ul class="list list-lines">
            @if(isset($category) && $category->parent)
                <li>
                    <a href="{{ route('frontend.product.category.lists', ['seo_name' => $category->parent->seo_name]) }}">
                        {{ $category->parent->name }}
                    </a>
                    <span class="count">({{ $category->parent->countProduct(1) }})</span>
                    <ul class="list list-lines">
            @endif
            @foreach($categories as $item)
                <li>
                    <a href="{{ route('frontend.product.category.lists', ['seo_name' => $item->seo_name]) }}">
                        {{ $item->name }}
                    </a>
                    <span class="count">({{ $item->countProduct(1) }})</span>
                    @if(isset($category) && $category->id() == $item->id() && $category->childrens->count() > 0)
                        <ul class="list list-lines">
                            @foreach($category->childrens as $children)
                                <li>
                                    <a href="{{ route('frontend.product.category.lists', ['seo_name' => $children->seo_name]) }}">
                                        {{ $children->name }}
                                    </a>
                                    <span class="count">({{ $children->countProduct(1) }})</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            @if(isset($category) && $category->parent)
                    </ul>
                </li>
            @endif

        </ul>
    </div>
@endif