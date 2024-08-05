@extends('layouts.main')

@section('title')
    {{ $brand->name }}
@endsection

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->content }}</p>
    <h5 class="bg-info text-white p-1 mb-4">{{ __('Товары бренда') }}</h5>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.partials.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
