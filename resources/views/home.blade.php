@extends('layouts.main')

@section('title')
    {{ __('Главная') }}
@endsection

@section('content')
    <h1 class="text-4xl font-bold mb-4">{{ __('Интернет-магазин') }}</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto autem distinctio
        dolorum ducimus earum eligendi est eum eveniet excepturi exercitationem explicabo facilis
        fuga hic illum ipsam libero modi, nobis odio, officia officiis optio quae quibusdam
        reiciendis repellendus sed sunt tenetur, voluptatum. Ab adipisci aperiam esse iure neque
        quis repellendus temporibus.
    </p>

    @if ($new->count())
        <h2>{{ __('Новинки') }}</h2>
        <div class="row">
            @foreach ($new as $item)
                @include('catalog.partials.product', ['product' => $item])
            @endforeach
        </div>
    @endif

    @if ($hit->count())
        <h2>{{ __('Лидеры продаж') }}</h2>
        <div class="row">
            @foreach ($hit as $item)
                @include('catalog.partials.product', ['product' => $item])
            @endforeach
        </div>
    @endif

    @if ($sale->count())
        <h2>{{ __('Распродажа') }}</h2>
        <div class="row">
            @foreach ($sale as $item)
                @include('catalog.partials.product', ['product' => $item])
            @endforeach
        </div>
    @endif
@endsection
