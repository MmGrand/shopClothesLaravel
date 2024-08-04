@extends('layouts.admin')

@section('title')
    {{ __('Редактирование пользователя') }}
@endsection

@section('content')
    <h1>{{ __('Редактирование пользователя') }}</h1>
    <form method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия" required maxlength="255"
                value="{{ old('name') ?? ($user->name ?? '') }}">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Адрес почты" required maxlength="255"
                value="{{ old('email') ?? ($user->email ?? '') }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="change_password" id="change_password">
            <label class="form-check-label" for="change_password">
                {{ __('Изменить пароль пользователя') }}
            </label>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="password" maxlength="255" placeholder="Новый пароль"
                value="">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="password_confirmation" maxlength="255"
                placeholder="Пароль еще раз" value="">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
        </div>
    </form>
@endsection
