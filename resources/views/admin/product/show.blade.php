@extends('layouts.admin')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <h1 class="mb-4">{{ $product->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>{{ __('Название') }}:</strong> {{ $product->name }}</p>
            <p><strong>{{ __('ЧПУ (англ)') }}:</strong> {{ $product->slug }}</p>
            <p><strong>{{ __('Цена') }}:</strong> {{ number_format($product->price, 2, '.', '') }}</p>
            <p><strong>{{ __('Бренд') }}:</strong> {{ $product->brand->name }}</p>
            <p><strong>{{ __('Категория') }}:</strong> {{ $product->category->name }}</p>
            <p><strong>{{ __('Количество просмотров') }}:</strong> {{ $product->views_count }}</p>
            <p>
                <strong>{{ __('Опубликован') }}:</strong>
                @if ($product->is_published)
                    <span class="badge bg-success">✔</span>
                @else
                    <span class="badge bg-danger">✘</span>
                @endif
            </p>
            <p>
                @if ($product->new)
                    <span class="badge bg-info text-white ml-1">{{ __('Новинка') }}</span>
                @endif
                @if ($product->hit)
                    <span class="badge bg-danger ml-1">{{ __('Лидер продаж') }}</span>
                @endif
                @if ($product->sale)
                    <span class="badge bg-success ml-1">{{ __('Распродажа') }}</span>
                @endif
            </p>
        </div>
        <div class="col-md-6">
            <img src="{{ $product->image ? Storage::url('catalog/product/image/' . $product->image) : asset('img/default.jpg') }}"
                alt="" class="img-fluid">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <h3>{{ __('Описание') }}</h3>
            @isset($product->content)
                <p>{{ $product->content }}</p>
            @else
                <p>{{ __('Описание отсутствует') }}</p>
            @endisset
            <a href="{{ route('admin.product.edit', ['product' => $product->slug]) }}" class="btn btn-success mt-3">
                {{ __('Редактировать товар') }}
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Удалить этот товар?')"
                action="{{ route('admin.product.destroy', ['product' => $product->slug]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">
                    {{ __('Удалить товар') }}
                </button>
            </form>
        </div>
    </div>
@endsection
