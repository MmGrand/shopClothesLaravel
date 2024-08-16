@extends('layouts.main')

@section('title')
    {{ __('Поиск по каталогу') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Поиск по каталогу') }}</h1>
    <p class="lead">{{ __('Поисковый запрос') }}: {{ $search ?? __('пусто') }}</p>
    <x-catalog.products-list :products="$products" />
@endsection
