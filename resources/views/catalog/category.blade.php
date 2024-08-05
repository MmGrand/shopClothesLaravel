@extends('layouts.main')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <h1>{{ $category->name }}</h1>

    <p>{{ $category->content }}</p>

    <div class="row">
        @foreach ($category->children as $child)
            @include('catalog.partials.category', ['category' => $child])
        @endforeach
    </div>
    <h5 class="bg-info text-white p-2 mb-4">{{ __('Товары раздела') }}</h5>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.partials.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
