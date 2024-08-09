@extends('layouts.admin')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <h1 class="mb-4">{{ $user->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <p><strong>{{ __('Дата регистрации') }}:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>{{ __('Имя, фамилия') }}:</strong> {{ $user->name }}</p>
            <p><strong>{{ __('Адрес почты') }}:</strong> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
            <p><strong>{{ __('Кол-во заказов') }}:</strong> {{ $user->orders->count() }}</p>
        </div>
    </div>
    <form method="post" action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            {{ __('Удалить пользователя') }}
        </button>
    </form>
@endsection
