@extends('layouts.admin')

@section('title')
	{{ __('Все категории') }}
@endsection

@section('content')
	<h1>{{ __('Все категории') }}</h1>
	<table class="table table-bordered">
			<tr>
					<th width="30%">{{ __('Наименование') }}</th>
					<th width="65%">{{ __('Описание') }}</th>
					<th><i class="fas fa-edit"></i></th>
					<th><i class="fas fa-trash-alt"></i></th>
			</tr>
			@include('admin.category.partials.tree', ['items' => $categories, 'level' => -1])
	</table>
@endsection