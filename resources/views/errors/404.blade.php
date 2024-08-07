@extends('layouts.main')

@section('title')
    {{ __('Страница не найдена') }}
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="fs-3"><span class="text-danger">{{ __('Упс') }}!</span> {{ __('Страница не найдена') }}.</p>
            <p class="lead">
                {{ __('Запрашиваемая страница не найдена') }}.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Вернуться на главную') }}</a>
        </div>
    </div>
@endsection
