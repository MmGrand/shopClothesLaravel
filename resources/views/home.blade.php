@extends('layouts.main')

@section('title')
    {{ __('Главная') }}
@endsection

@section('content')
    <h1 class="text-4xl font-bold mb-2">{{ __('Интернет-магазин') }}</h1>
    <div class="row mb-4">
        <p class="lead">{{ __('Наш интернет-магазин предлагает широкий ассортимент товаров, удовлетворяющих самые разнообразные потребности. Мы тщательно отбираем продукцию, чтобы предложить вам только самое лучшее') }}.</p>
    </div>

    @if ($new->count())
        <h3>{{ __('Новинки') }}</h3>
        <div class="row">
            @foreach ($new as $item)
                @include('catalog.partials.product', ['product' => $item])
            @endforeach
        </div>
    @endif

    @if ($hit->count())
        <h3>{{ __('Лидеры продаж') }}</h3>
        <div class="row">
            @foreach ($hit as $item)
                @include('catalog.partials.product', ['product' => $item])
            @endforeach
        </div>
    @endif

    @if ($sale->count())
        <h3>{{ __('Распродажа') }}</h3>
        <div class="row">
            @foreach ($sale as $item)
                @include('catalog.partials.product', ['product' => $item])
            @endforeach
        </div>
    @endif
@endsection
