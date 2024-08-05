@extends('layouts.admin')

@section('title')
    {{ __('Все страницы сайта') }}
@endsection

@section('content')
    <h1>{{ __('Все страницы сайта') }}</h1>
    <a href="{{ route('admin.page.create') }}" class="btn btn-success mb-4">
        {{ __('Создать страницу') }}
    </a>
    @if (count($pages))
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th width="45%">{{ __('Наименование') }}</th>
                <th width="45%">{{ __('ЧПУ (англ.)') }}</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @include('admin.page.partials.tree', ['level' => -1, 'parent' => 0])
        </table>
    @endif
@endsection
