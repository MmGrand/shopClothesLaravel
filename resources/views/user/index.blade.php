@extends('layouts.main')

@section('title')
	{{ __('Личный кабинет') }}
@endsection

@section('content')
	<h1>{{ __('Личный кабинет') }}</h1>
	<p>{{ __('Добро пожаловать') }}, {{ auth()->user()->name }}</p>
	<p>{{ __('Это личный кабинет постоянного покупателя нашего интернет-магазина') }}.</p>
	<ul>
		<li><a href="{{ route('user.profile.index') }}">{{ __('Ваши профили') }}</a></li>
		<li><a href="{{ route('user.order.index') }}">{{ __('Ваши заказы') }}</a></li>
	</ul>
	<form action="{{ route('user.logout') }}" method="post">
			@csrf
			<button type="submit" class="btn btn-primary">{{ __('Выйти') }}</button>
	</form>
@endsection