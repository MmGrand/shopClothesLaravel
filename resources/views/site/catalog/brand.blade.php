@extends('layouts.main')

@section('title')
    {{ $brand->name }}
@endsection

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->content }}</p>
    <div class="bg-info p-2 mb-4">
        <form method="get"
              action="{{ route('catalog.brand', ['brand' => $brand->slug]) }}">
            @include('site.catalog.partials.filter')
            <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}"
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
