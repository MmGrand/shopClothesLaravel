@extends('layouts.main')

@section('title')
    {{ __('Каталог товаров') }}
@endsection

@section('content')
    <h1>{{ __('Каталог товаров') }}</h1>

    <p>
        {{ __('У нас вы найдете всё, что вам нужно - от одежды и обуви до аксессуаров и товаров для дома. Мы работаем только с проверенными производителями и поставщиками. Наши цены вас приятно удивят. Регулярные акции и скидки позволят вам сэкономить еще больше.') }}
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
