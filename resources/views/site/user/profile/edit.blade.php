@extends('layouts.main')

@section('title')
    {{ __('Редактирование профиля') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0">{{ __('Редактирование профиля') }}</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('user.profile.update', ['profile' => $profile->id]) }}">
                @method('PUT')
                @include('site.user.profile.partials.form')
            </form>
        </div>
    </div>
@endsection
