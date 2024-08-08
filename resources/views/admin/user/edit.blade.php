@extends('layouts.admin')

@section('title')
    {{ __('Редактирование пользователя') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Редактирование пользователя') }}</h1>
    <form method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Имя, Фамилия') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Имя, Фамилия" required
                maxlength="255" value="{{ old('name') ?? ($user->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Адрес почты') }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Адрес почты" required
                maxlength="255" value="{{ old('email') ?? ($user->email ?? '') }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="change_password" name="change_password">
            <label class="form-check-label" for="change_password">{{ __('Изменить пароль пользователя') }}</label>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Новый пароль') }}</label>
            <input type="password" class="form-control" id="password" name="password" maxlength="255"
                placeholder="Новый пароль">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Пароль еще раз') }}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                maxlength="255" placeholder="Пароль еще раз">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
        </div>
    </form>
@endsection
