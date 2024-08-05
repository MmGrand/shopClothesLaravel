@extends('layouts.admin')

@section('title')
    {{ $page->name }}
@endsection

@section('content')
    <h1>{{ $page->name }}</h1>
    <div class="row">
        <div class="col-12">
            <p><strong>{{ __('Название') }}:</strong> {{ $page->name }}</p>
            <p><strong>{{ __('ЧПУ (англ)') }}:</strong> {{ $page->slug }}</p>
            <p><strong>{{ __('Контент') }} (html)</strong></p>
            <div class="mb-4 bg-white p-1">
                @php echo nl2br(htmlspecialchars($page->content)) @endphp
            </div>

            <a href="{{ route('admin.page.edit', ['page' => $page->slug]) }}" class="btn btn-success">
                {{ __('Редактировать страницу') }}
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Удалить эту страницу?')"
                action="{{ route('admin.page.destroy', ['page' => $page->slug]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    {{ __('Удалить страницу') }}
                </button>
            </form>
        </div>
    </div>
@endsection
