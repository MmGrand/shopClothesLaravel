@extends('layouts.main')

@section('title')
    {{ __('Данные профиля: ') . $profile->title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0">{{ __('Данные профиля: ') . $profile->title }}</h1>
        </div>
        <div class="card-body">
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
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('user.profile.edit', ['profile' => $profile->id]) }}" class="btn btn-success me-2">
                {{ __('Редактировать профиль') }}
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('{{ __('Удалить этот профиль?') }}')"
                action="{{ route('user.profile.destroy', ['profile' => $profile->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    {{ __('Удалить профиль') }}
                </button>
            </form>
        </div>
    </div>
@endsection
