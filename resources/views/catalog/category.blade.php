@extends('layouts.main')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <h1>{{ $category->name }}</h1>

    <p>{{ $category->content }}</p>

    <div class="row">
        @foreach ($category->products as $product)
            @include('catalog.partials.product')
        @endforeach
    </div>
@endsection
