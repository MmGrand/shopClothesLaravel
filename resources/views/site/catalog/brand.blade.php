@extends('layouts.main')

@section('title')
    {{ $brand->name }}
@endsection

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->content }}</p>
    <div class="bg-info p-2 mb-4">
        <x-catalog.filter :entity="$brand"  routeName="catalog.brand" routeParam="brand"/>
    </div>
    <x-catalog.products-list :products="$products" />
@endsection
