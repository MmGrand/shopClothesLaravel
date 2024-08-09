<div class="col-md-4 mb-4">
    <div class="card list-item">
        <div class="card-header">
            <h3 class="mb-0">{{ $category->name }}</h3>
        </div>
        <div class="card-body p-0">
            <img src="{{ $category->image ? Storage::url('catalog/category/thumb/' . $category->image) : asset('https://via.placeholder.com/300x150') }}"
                alt="" class="img-fluid">
        </div>
        <div class="card-footer">
            <a href="{{ route('catalog.category', ['category' => $category->slug]) }}"
                class="btn btn-dark">{{ __('Товары
                                раздела') }}</a>
        </div>
    </div>
</div>
