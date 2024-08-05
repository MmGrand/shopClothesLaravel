@extends('layouts.main')

@section('title')
    {{ __('Каталог товаров') }}
@endsection

@section('content')
    <h1>{{ __('Каталог товаров') }}</h1>

    <p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ducimus, eligendi
    exercitationem expedita, iure iusto laborum magnam qui quidem repellat similique
    tempora tempore ullam! Deserunt doloremque impedit quis repudiandae voluptas?
    </p>

    <h2>{{ __('Разделы каталога') }}</h2>
    <div class="row">
        @foreach ($categories as $category)
            @include('catalog.partials.category')
        @endforeach
    </div>

    <h2 class="mb-4">{{ __('Популярные бренды') }}</h2>
    <div class="row">
        @foreach ($brands as $brand)
            @include('catalog.partials.brand', ['brand' => $brand])
        @endforeach
    </div>
@endsection
