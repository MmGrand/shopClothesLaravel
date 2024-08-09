@extends('layouts.admin')

@section('title')
    {{ __('Создание пользователя') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Создание пользователя') }}</h1>
    <form method="post" action="{{ route('admin.user.store') }}">
        @csrf
				@include('admin.user.partials.form')
    </form>
@endsection
