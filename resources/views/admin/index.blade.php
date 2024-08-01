@extends('layouts.admin')

@section('title')
	{{ __('Панель управления') }}
@endsection

@section('content')
	<h1>{{ __('Панель управления') }}</h1>
	<p>{{ __('Добро пожаловать') }}, {{ auth()->user()->name }}</p>
	<p>{{ __('Это панель управления для администратора интернет-магазина') }}.</p>
	<form action="{{ route('user.logout') }}" method="post">
			@csrf
			<button type="submit" class="btn btn-primary">{{ __('Выйти') }}</button>
	</form>
@endsection