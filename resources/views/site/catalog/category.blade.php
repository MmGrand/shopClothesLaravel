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
        <x-catalog.filter :entity="$category"  routeName="catalog.category" routeParam="category"/>
    </div>
    <x-catalog.products-list :products="$products" />
@endsection
