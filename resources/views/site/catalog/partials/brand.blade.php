<div class="col-md-4 mb-4">
    <div class="card list-item">
        <div class="card-header px-1">
            <h3 class="mb-0">{{ $brand->name }}</h3>
        </div>
        <div class="card-body p-0">
            <img src="{{ $brand->image ? Storage::url('catalog/brand/thumb/' . $brand->image) : asset('https://via.placeholder.com/300x150') }}"
                alt="" class="img-fluid">
        </div>
        <div class="card-footer px-1">
            <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}"
                class="btn btn-dark">{{ __('Товары бренда') }}</a>
        </div>
    </div>
</div>
