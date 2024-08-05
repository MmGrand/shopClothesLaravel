@extends('layouts.main')

@section('title')
    {{ __('Данные профиля: ') . $profile->title }}
@endsection

@section('content')
    <h1>{{ __('Данные профиля: ') . $profile->title }}</h1>
    <p><strong>{{ __('Название профиля') }}:</strong> {{ $profile->title }}</p>
    <p><strong>{{ __('Имя, фамилия') }}:</strong> {{ $profile->name }}</p>
    <p>
        <strong>{{ __('Адрес почты') }}:</strong>
        <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
    </p>
    <p><strong>{{ __('Номер телефона') }}:</strong> {{ $profile->phone }}</p>
    <p><strong>{{ __('Адрес доставки') }}:</strong> {{ $profile->address }}</p>
    @isset($profile->comment)
        <p><strong>{{ __('Комментарий') }}:</strong> {{ $profile->comment }}</p>
    @endisset

    <a href="{{ route('user.profile.edit', ['profile' => $profile->id]) }}" class="btn btn-success">
        {{ __('Редактировать профиль') }}
    </a>
    <form method="post" class="d-inline" onsubmit="return confirm('Удалить этот профиль?')"
        action="{{ route('user.profile.destroy', ['profile' => $profile->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            {{ __('Удалить профиль') }}
        </button>
    </form>
@endsection
