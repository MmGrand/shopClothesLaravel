@extends('layouts.main')

@section('title')
    {{ $page->name }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $page->name }}</h1>
        </div>
        <div class="card-body">
            {!! $page->content !!}
        </div>
        <div class="card-footer">
            {{ __('Добавлена') }}: {{ $page->created_at->format('d.m.Y H:i') }}
        </div>
    </div>
@endsection