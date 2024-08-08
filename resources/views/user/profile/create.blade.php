@extends('layouts.main')

@section('title')
    {{ __('Создание профиля') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0">{{ __('Создать профиль') }}</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('user.profile.store') }}">
                @include('user.profile.partials.form')
            </form>
        </div>
    </div>
@endsection
