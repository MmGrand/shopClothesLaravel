@extends('layouts.admin')

@section('title')
	{{ __('Все категории') }}
@endsection

@section('content')
	<h1 class="mb-4">{{ __('Все категории') }}</h1>
	<a href="{{ route('admin.category.create') }}" class="btn btn-success mb-4">
		{{ __('Создать категорию') }}
	</a>
	<table class="table table-bordered">
			<tr>
					<th width="30%">{{ __('Наименование') }}</th>
					<th width="65%">{{ __('Описание') }}</th>
					<th><i class="fas fa-edit"></i></th>
					<th><i class="fas fa-trash-alt"></i></th>
			</tr>
			@include('admin.category.partials.tree', ['level' => -1, 'parent' => 0])
	</table>
@endsection