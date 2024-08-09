<div class="col-md-4 mb-4">
    <div class="card list-item">
        <div class="card-header">
            <h5 class="mb-0">{{ $product->name }}</h5>
        </div>
        <div class="card-body p-0 position-relative">
            <div class="position-absolute">
                @if ($product->new)
                    <span class="badge bg-info text-white ml-1">{{ __('Новинка') }}</span>
                @endif
                @if ($product->hit)
                    <span class="badge bg-danger ml-1">{{ __('Лидер продаж') }}</span>
                @endif
                @if ($product->sale)
                    <span class="badge bg-success ml-1">{{ __('Распродажа') }}</span>
                @endif
            </div>
            <img src="{{ $product->image ? Storage::url('catalog/product/thumb/' . $product->image) : asset('https://via.placeholder.com/300x150') }}"
                alt="" class="img-fluid">
        </div>
        <div class="card-footer">
            <form action="{{ route('basket.add', ['id' => $product->id]) }}" method="post"
                class="d-inline add-to-basket">
                @csrf
                <button type="submit" class="btn btn-success">{{ __('В корзину') }}</button>
            </form>
            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}"
                class="btn btn-dark float-right">{{ __('Смотреть') }}</a>
        </div>
    </div>
</div>
