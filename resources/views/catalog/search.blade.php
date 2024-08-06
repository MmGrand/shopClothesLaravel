@extends('layouts.main')

@section('title')
	{{ __('Поиск по каталогу') }}
@endsection

@section('content')
    <h1>{{ __('Поиск по каталогу') }}</h1>
    <p>{{ __('Поисковый запрос') }}: {{ $search ?? 'пусто' }}</p>
    @if (count($products))
        <div class="row">
            @foreach ($products as $product)
                @include('catalog.partials.product', ['product' => $product])
            @endforeach
        </div>
        {{ $products->links() }}
    @else
        <p>{{ __('По вашему запросу ничего не найдено') }}</p>
    @endif
@endsection
