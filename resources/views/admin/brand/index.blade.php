@extends('layouts.admin')

@section('title')
    {{ __('Все бренды') }}
@endsection

@section('content')
    <h1>{{ __('Все бренды') }}</h1>
    <a href="{{ route('admin.brand.create') }}" class="btn btn-success mb-4">
        {{ __('Создать бренд') }}
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">{{ __('Наименование') }}</th>
            <th width="65%">{{ __('Описание') }}</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @foreach ($brands as $brand)
            <tr>
                <td>
                    <a href="{{ route('admin.brand.show', ['brand' => $brand->slug]) }}">
                        {{ $brand->name }}
                    </a>
                </td>
                <td>{{ iconv_substr($brand->content, 0, 150) }}</td>
                <td>
                    <a href="{{ route('admin.brand.edit', ['brand' => $brand->slug]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('admin.brand.destroy', ['brand' => $brand->slug]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                            <i class="far fa-trash-alt text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
