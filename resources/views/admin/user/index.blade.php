@extends('layouts.admin')

@section('title')
    {{ __('Все пользователи') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Все пользователи') }}</h1>
    <a href="{{ route('admin.user.create') }}" class="btn btn-success mb-4">
		{{ __('Создать пользователя') }}
	</a>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th width="25%">{{ __('Дата регистрации') }}</th>
            <th width="25%">{{ __('Имя, фамилия') }}</th>
            <th width="20%">{{ __('Адрес почты') }}</th>
            <th width="20%">{{ __('Кол-во заказов') }}</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                <td><a href="{{ route('admin.user.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                <td>{{ $user->orders->count() }}</td>
                <td>
                    <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('admin.user.destroy', ['user' => $user->id]) }}">
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
    {{ $users->links() }}
@endsection
