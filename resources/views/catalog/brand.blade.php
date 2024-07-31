@extends('layouts.main')

@section('title')
    {{ $brand->name }}
@endsection

@section('content')
    <h1>{{ $brand->name }}</h1>

    <p>{{ $brand->content }}</p>

    <div class="row">
        @foreach ($brand->products as $product)
            @include('catalog.partials.product')
        @endforeach
    </div>
@endsection
