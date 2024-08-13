<div class="col-md-4 mb-4">
    <div class="card list-item">
        <div class="card-header">
            <h5 class="mb-0">{{ $product->name }}</h5>
            <p class="mb-0 text-muted" style="font-size: 0.875rem; color: #6c757d; font-style: italic;">
                {{ number_format($product->price, 2) }} ₽</p>
        </div>
        <div class="card-body p-0 position-relative">
            <div class="position-absolute p-2">
                @if ($product->new)
                    <span class="badge bg-info text-white">{{ __('Новинка') }}</span>
                @endif
                @if ($product->hit)
                    <span class="badge bg-danger">{{ __('Лидер продаж') }}</span>
                @endif
                @if ($product->sale)
                    <span class="badge bg-success">{{ __('Распродажа') }}</span>
                @endif
            </div>
            <img src="{{ $product->image ? Storage::url('catalog/product/thumb/' . $product->image) : asset('https://via.placeholder.com/300x150') }}"
                alt="" class="img-fluid">
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <form action="{{ route('basket.add', ['id' => $product->id]) }}" method="post"
                class="d-inline add-to-basket">
                @csrf
                <button type="submit" class="btn btn-success">{{ __('В корзину') }}</button>
            </form>
            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}"
                class="btn btn-dark">{{ __('Смотреть') }}</a>
        </div>
    </div>
</div>
