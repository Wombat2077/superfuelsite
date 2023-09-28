@extends('layouts.admin_app')
@section('content')

<div class="alert alert-primary justify-content-center m-5">
    <h2>Работай, товарищ</h2>
    <div>
        <p>Помни, в твоих руках ответственность за:
        <ul>
            <li>
                @if($usr_count%10 == 1&$usr_count!=11)
                {{$usr_count}} пользователя
                @else
                {{$usr_count}} пользователей
                @endif
            </li>
            <li>
                @if($prd_count%10 == 1&$usr_count!=11)
                {{$prd_count}} товар
                @elseif($prd_count%10 < 5 & intval($prd_count/10) != 1)
                {{$prd_count}} товара
                @else
                {{$prd_count}} товаров
                @endif
            </li>
            <li>
                @if($ord_count%10 == 1&$ord_count!=11)
                {{$ord_count}} заказ
                @elseif($ord_count%10 < 5 & intval($ord_count/10) != 1)
                {{$ord_count}} заказа
                @else
                {{$ord_count}} заказов
                @endif
            </li>
        </p>
        </ul>
    </div>
</div>
<center>
    <div class="d-flex align-content-center align-self-center card w-25" >
    <img src="img/megaimg.webp.png" class="card-img-top" height="25%">
    <p class="card-text">типа вдохновляющий текст для оч хорошего админа жиесть </p>
</div>
</center>

@endsection
