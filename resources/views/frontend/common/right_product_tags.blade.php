@if($tags)
    <div class="widget clearfix widget-tags">
        <h4 class="widget-title">Etiketler</h4>
        <div class="tags">
            @foreach($tags as $tag)
                <a href="{{ route('frontend.product.search.lists', ['term' => $tag->name]) }}" title="{{ $tag->name }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
@endif