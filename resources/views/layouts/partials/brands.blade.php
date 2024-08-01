<h4>{{ __('Популярные бренды') }}</h4>
<ul>
@foreach($items as $item)
    <li>
        <a href="{{ route('catalog.brand', ['brand' => $item->slug]) }}">{{ $item->name }}</a>
        <span class="badge text-bg-dark float-right">{{ $item->products_count }}</span>
    </li>
@endforeach
</ul>
