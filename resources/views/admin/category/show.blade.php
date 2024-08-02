@extends('layouts.admin')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <h1>{{ __('Просмотр категории') }}</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>{{ __('Название') }}:</strong> {{ $category->name }}</p>
            <p><strong>{{ __('ЧПУ (англ)') }}:</strong> {{ $category->slug }}</p>
            <p><strong>{{ __('Краткое описание') }}</strong></p>
            @isset($category->content)
                <p>{{ $category->content }}</p>
            @else
                <p>{{ __('Описание отсутствует') }}</p>
            @endisset
        </div>
        <div class="col-md-6">
            <img src="{{ $category->image ?  Storage::url('catalog/category/image/' . $category->image) : asset('img/default.jpg')}}" alt="" class="img-fluid">
        </div>
    </div>
    @if ($category->children->count())
        <p><strong>{{ __('Дочерние категории') }}</strong></p>
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="45%">{{ __('Наименование') }}</th>
                <th width="45%">{{ __('ЧПУ (англ)') }}</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($category->children as $child)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('admin.category.show', ['category' => $child->slug]) }}">
                            {{ $child->name }}
                        </a>
                    </td>
                    <td>{{ $child->slug }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', ['category' => $child->slug]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.category.destroy', ['category' => $child->slug]) }}" method="post">
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
    @else
        <p>{{ __('Нет дочерних категорий') }}</p>
    @endif
    <form method="post" action="{{ route('admin.category.destroy', ['category' => $category->slug]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            {{ __('Удалить категорию') }}
        </button>
    </form>
@endsection
