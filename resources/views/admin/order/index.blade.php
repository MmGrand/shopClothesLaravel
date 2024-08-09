@extends('layouts.admin')

@section('title')
    {{ __('Все заказы') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Все заказы') }}</h1>
    <a href="{{ route('admin.order.create') }}" class="btn btn-success mb-4">
		{{ __('Создать заказ') }}
	</a>
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th width="18%">{{ __('Дата и время') }}</th>
            <th width="5%">{{ __('Статус') }}</th>
            <th width="18%">{{ __('Покупатель') }}</th>
            <th width="18%">{{ __('Адрес почты') }}</th>
            <th width="18%">{{ __('Номер телефона') }}</th>
            <th width="18%">{{ __('Пользователь') }}</th>
            <th><i class="fas fa-eye"></i></th>
            <th><i class="fas fa-edit"></i></th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    @if ($order->status == 0)
                        <span class="text-danger">{{ $statuses[$order->status] }}</span>
                    @elseif (in_array($order->status, [1,2,3]))
                        <span class="text-success">{{ $statuses[$order->status] }}</span>
                    @else
                        {{ $statuses[$order->status] }}
                    @endif
                </td>
                <td>{{ $order->name }}</td>
                <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                <td>{{ $order->phone }}</td>
                <td>
                    @isset($order->user)
                        {{ $order->user->name }}
                    @endisset
                </td>
                <td>
                    <a href="{{ route('admin.order.show', ['order' => $order->id]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.order.edit', ['order' => $order->id]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection
