@extends('layouts.main')

@section('title')
    {{ __('Создание профиля') }}
@endsection

@section('content')
    <h1>{{ __('Создание профиля') }}</h1>
    <form method="post" action="{{ route('user.profile.store') }}">
        @include('user.profile.partials.form')
    </form>
@endsection
