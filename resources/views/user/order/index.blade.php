@extends('layouts.main')

@section('title')
    {{ __('Ваши заказы') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Ваши заказы') }}</h1>
    @if ($orders->count())
        <table class="table table-bordered">
            <tr>
                <th width="2%">№</th>
                <th width="19%">{{ __('Дата и время') }}</th>
                <th width="13%">{{ __('Статус') }}</th>
                <th width="19%">{{ __('Покупатель') }}</th>
                <th width="24%">{{ __('Адрес почты') }}</th>
                <th width="21%">{{ __('Номер телефона') }}</th>
                <th width="2%"><i class="fas fa-eye"></i></th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $statuses[$order->status] }}</td>
                    <td>{{ $order->name }}</td>
                    <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        <a href="{{ route('user.order.show', ['order' => $order->id]) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $orders->links() }}
    @else
        <p>{{ __('Заказов пока нет') }}</p>
    @endif
@endsection
