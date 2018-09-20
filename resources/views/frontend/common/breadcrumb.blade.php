<div class="container">
    <div class="breadcrumb  fancy">
        <ul>
            <li><a href="{{ route('frontend.home.index') }}">Anasayfa</a></li>
            @if(isset($breadcrumbs))
                @foreach($breadcrumbs as $i => $breadcrumb)
                    <li><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
</div>