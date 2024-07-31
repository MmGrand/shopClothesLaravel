<h4>{{ __('Разделы каталога') }}</h4>
<div id="catalog-sidebar">
    <ul>
    @foreach($items as $item)
        <li>
            <a href="{{ route('catalog.category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
            @isset($item->children)
                <span class="badge badge-dark">
                    <i class="fa fa-plus"></i>
                </span>
                <ul>
                @foreach($item->children as $child)
                    <li>
                        <a href="{{ route('catalog.category', ['category' => $child->slug]) }}">
                            {{ $child->name }}
                        </a>
                    </li>
                @endforeach
                </ul>
            @endisset
        </li>
    @endforeach
    </ul>
</div>
