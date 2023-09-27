@extends("layouts.app")
@section('content')
<h1 class="display-6 m-3" >Мои заказы</h1>
<table class="table m-2">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Имя получателя</th>
        <th scope="col">Фамилия получателя</th>
        <th scope="col">Адрес доставки</th>
        <th scope="col">Заказанные продукты</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <th scope="row">{{ $order->id}}</th>
            <td>{{$order->first_name}}</td>
            <td>{{$order->last_name}}</td>
            <td>{{$order->address}}</td>
            <td>
                @if(is_array($order->products()))
                    @foreach ($order->products() as $product)
                        {{ $product->name }},{{ "  " }}
                    @endforeach
                @else
                    {{$order->products()->name}}
                @endif
            </td>
        </tr>
        @endforeach
  </table>
@endsection
