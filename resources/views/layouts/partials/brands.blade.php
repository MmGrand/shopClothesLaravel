<h4>{{ __('Популярные бренды') }}</h4>
<ul class="list-group list-group-flush">
    @foreach ($brands as $brand)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}">{{ $brand->name }}</a>
            <span class="badge bg-dark text-white">{{ $brand->products_count }}</span>
        </li>
    @endforeach
</ul>
