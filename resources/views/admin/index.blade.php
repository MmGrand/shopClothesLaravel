@extends('layouts.admin')

@section('title')
    {{ __('Панель управления') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Панель управления') }}</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ __('Добро пожаловать') }}, {{ auth()->user()->name }}</p>
            <p class="card-text">{{ __('Это панель управления для администратора интернет-магазина') }}.</p>
            <form action="{{ route('logout') }}" method="post" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Выйти') }}</button>
            </form>
        </div>
    </div>
@endsection
