@extends('layouts.admin')

@section('title')
    {{ __('Редактирование пользователя') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Редактирование пользователя') }}</h1>
    <form method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
        @method('PUT')
        @include('admin.user.partials.form')
    </form>
@endsection
