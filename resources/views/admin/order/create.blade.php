@extends('layouts.admin')

@section('title')
    {{ __('Создание заказа') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Создание заказа') }}</h1>
    <form method="post" action="{{ route('admin.order.store') }}">
        @include('admin.order.partials.form')
    </form>
@endsection
