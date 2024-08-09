@extends('layouts.main')

@section('title')
    {{ __('Поиск по каталогу') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Поиск по каталогу') }}</h1>
    <p class="lead">{{ __('Поисковый запрос') }}: {{ $search ?? 'пусто' }}</p>

    @if (count($products))
        <div class="row">
            @foreach ($products as $product)
                @include('site.catalog.partials.product', ['product' => $product])
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">{{ __('По вашему запросу ничего не найдено') }}</h4>
            <p>{{ __('Попробуйте изменить запрос или воспользуйтесь категориями каталога для поиска нужного товара.') }}</p>
        </div>
    @endif
@endsection
