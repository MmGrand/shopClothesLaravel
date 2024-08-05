@extends('layouts.main')

@section('title')
	{{ __('Личный кабинет') }}
@endsection

@section('content')
	<h1>{{ __('Личный кабинет') }}</h1>
	<p>{{ __('Добро пожаловать') }}, {{ auth()->user()->name }}</p>
	<p>{{ __('Это личный кабинет постоянного покупателя нашего интернет-магазина') }}.</p>
	<form action="{{ route('user.logout') }}" method="post">
			@csrf
			<button type="submit" class="btn btn-primary">{{ __('Выйти') }}</button>
	</form>
@endsection