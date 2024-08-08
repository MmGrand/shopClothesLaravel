@extends('layouts.main')

@section('title')
    {{ __('Личный кабинет') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Личный кабинет') }}</h1>
    <p class="lead">{{ __('Добро пожаловать') }}, {{ auth()->user()->name }}</p>
    <p>{{ __('Это личный кабинет постоянного покупателя нашего интернет-магазина') }}.</p>

    <div class="list-group mb-4">
        <a href="{{ route('user.profile.index') }}" class="list-group-item list-group-item-action">
            {{ __('Ваши профили') }}
        </a>
        <a href="{{ route('user.order.index') }}" class="list-group-item list-group-item-action">
            {{ __('Ваши заказы') }}
        </a>
    </div>

    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">{{ __('Выйти') }}</button>
    </form>
@endsection
