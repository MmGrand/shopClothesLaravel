@extends('layouts.main')

@section('title')
    {{ __('Редактирование профиля') }}
@endsection

@section('content')
    <h1>{{ __('Редактирование профиля') }}</h1>
    <form method="post" action="{{ route('user.profile.update', ['profile' => $profile->id]) }}">
        @method('PUT')
        @include('user.profile.partials.form')
    </form>
@endsection
