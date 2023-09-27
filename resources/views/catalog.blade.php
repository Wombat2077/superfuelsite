
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="css/catalog.css">
<script src="js/catalog.js" type="module"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <!-- каталог товаров -->
  <h1>Каталог товаров</h1>

  <div class="catalog-container">
    <!-- Место для генерации товаров через JavaScript -->
  </div>

 <!-- поиск -->
 <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Поиск по названию товара" aria-label="Поиск по названию товара" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Искать</button>
</div>




  <!-- сам каталог -->
@foreach ($products as $product)
  <div class="catalog-container">

    @guest
    <div class="product">

        <h3>{{ $product->name}}</h3>
        <p>{{$product->desc}}</p>
        <div class="btn btn-dark disabled  h-25"> {{$product->cost}}₽</div> <button class="btn btn-dark h-25" id="errorToastBtn" onclick="show_error_label()">Заказать</button>
    @else
    <div class="product">
        <h3>{{ $product->name}}</h3>
        <p>{{$product->desc}}</p>
        <div class="btn btn-dark disabled  h-25"> {{$product->cost}}₽</div> <button class="btn btn-dark h-25" data-bs-toggle="modal" data-bs-target="#Modal-form-{{ $product->id }}">Заказать</button>

      <x-modal>
        <x-slot name="id">
            {{$product->id}}
        </x-slot>
        <x-slot name="title">
            Заказ товара "{{ $product->name }}"
        </x-slot>
        <form method="POST"  id="order-form" onsubmit="return false;">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" class="form-control m-2" name="product_count" placeholder="Количество товара" min="1">
                <input type="text" class="form-control m-2" name="first_name" placeholder="Имя получателя">
                <input type="text" class="form-control m-2" name="last_name" placeholder="Фамилия получателя">
                <input type="text" class="form-control m-2" maxlength="10" pattern="^[ 0-9]+$"  name="passport_id" placeholder="Серия и номер паспорта">
                <input type="text" height="2" class="form-control m-2" name="address" placeholder="Адрес доставки">

                <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
                <button class="btn btn-dark m-2" type="submit"  onclick="make_order(event)">Заказать</button>
          </form>
      </x-modal>
    </div>
    @endguest

  </div>
  @endforeach
  <script src="js/catalog.js"></script>


@endsection
