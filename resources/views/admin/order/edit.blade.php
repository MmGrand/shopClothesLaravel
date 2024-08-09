@extends('layouts.admin')

@section('title')
    {{ __('Редактирование заказа') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Редактирование заказа') }}</h1>
    <form method="post" action="{{ route('admin.order.update', ['order' => $order->id]) }}">
        @method('PUT')
        @include('admin.order.partials.form')
    </form>
@endsection
