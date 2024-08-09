@extends('layouts.main')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <h1>{{ $category->name }}</h1>

    <p>{{ $category->content }}</p>

    <div class="row">
        @foreach ($category->children as $child)
            @include('site.catalog.partials.category', ['category' => $child])
        @endforeach
    </div>
    <div class="bg-info p-2 mb-4">
        <!-- Фильтр для товаров категории -->
        <form method="get"
              action="{{ route('catalog.category', ['category' => $category->slug]) }}">
            @include('site.catalog.partials.filter')
            <a href="{{ route('catalog.category', ['category' => $category->slug]) }}"
               class="btn btn-light">{{ __('Сбросить') }}</a>
        </form>
    </div>
    <div class="row">
        @foreach ($products as $product)
            @include('site.catalog.partials.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
