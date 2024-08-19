@extends('layouts.main')

@section('title')
    {{ __('Личный кабинет') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Личный кабинет') }}</h1>
    <p class="lead">{{ __('Добро пожаловать') }}, {{ auth()->user()->name }}</p>
    <p>{{ __('Это личный кабинет постоянного покупателя нашего интернет-магазина') }}.</p>

    @if (!auth()->user()->hasVerifiedEmail())
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Подтвердите ваш адрес электронной почты') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Новая ссылка для подтверждения была отправлена на ваш адрес электронной почты.') }}
                            </div>
                        @endif

                        {{ __('Перед продолжением проверьте свою электронную почту на наличие ссылки для подтверждения.') }}
                        {{ __('Если вы не получили письмо') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите здесь, чтобы запросить еще одну') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="list-group mb-4">
        <a href="{{ route('user.profile.index') }}" class="list-group-item list-group-item-action">
            {{ __('Ваши профили') }}
        </a>
        <a href="{{ route('user.order.index') }}" class="list-group-item list-group-item-action">
            {{ __('Ваши заказы') }}
        </a>
    </div>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">{{ __('Выйти') }}</button>
    </form>
@endsection
