@extends('layouts.main')

@section('title')
    {{ __('Ваши профили') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Ваши профили') }}</h1>
    <a href="{{ route('user.profile.create') }}" class="btn btn-success mb-4">
        {{ __('Создать профиль') }}
    </a>

    @if (count($profiles))
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="22%">{{ __('Наименование') }}</th>
                <th width="22%">{{ __('Имя, Фамилия') }}</th>
                <th width="22%">{{ __('Адрес почты') }}</th>
                <th width="22%">{{ __('Номер телефона') }}</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('user.profile.show', ['profile' => $profile->id]) }}">
                            {{ $profile->title }}
                        </a>
                    </td>
                    <td>{{ $profile->name }}</td>
                    <td><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></td>
                    <td>{{ $profile->phone }}</td>
                    <td>
                        <a href="{{ route('user.profile.edit', ['profile' => $profile->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('user.profile.destroy', ['profile' => $profile->id]) }}" method="post"
                            onsubmit="return confirm('{{ __('Удалить этот профиль?') }}')">
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
        {{ $profiles->links() }}
    @endif
@endsection
