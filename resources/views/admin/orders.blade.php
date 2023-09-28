@extends('layouts.admin_app')
@section('content')

<h1 class="display-6 m-3" >Пользователи</h1>
<table class="table m-2">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Пользователь</th>
        <th scope="col">Имя получателя</th>
        <th scope="col">Фамилия получателя</th>
        <th scope="col">Серия и номер паспорта</th>
        <th scope="col">Адрес доставки</th>
        <th scope="col">Заказанные продукты</th>
        <th scope="col">Суммарная стоимость</th>
        <th scope="col">Статус</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <th scope="row">{{ $order->id}}</th>
            <td>{{$order->user()->name}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->last_name}}</td>
            <td>{{$order->passport_id}}</td>
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
            <td>{{$order->summary_cost}} </td>
            <td>{{$order->status()->desc}} </td>
            <td>
                <x-buttonWithDropdown>
                <x-slot name="modal_id">
                        order-modal-{{ $order->id }}
                    </x-slot>
                    <x-slot name="button_label">
                        Изменить
                    </x-slot>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#del_modal_{{$order->id}}">Удалить</a>
                    </li>
                </x-buttonWithDropdown>
                <x-modal>
                    <x-slot name="id">
                        order-modal-{{ $order->id }}
                    </x-slot>
                    <x-slot name="title">
                        Редактирование заказа
                    </x-slot>
                    <form id="products-update-form" onsubmit="return false;">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <label for="user-select">Пользователь</label>
                        <select type="text" id="user_select" name="user_id" class="form-control mb-2" required value="{{$order->user_id}}">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <label for="product-select">Товар</label>
                        <select type="text" id="product_select" name="product_id" class="form-control mb-2" required value="{{$order->products()->id}}">
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                        <input type="number" name="product_count" class="form-control mb-2" placeholder="Количество товара" required>
                        <input type="text" name="first_name" class="form-control mb-2" placeholder="Имя получателя" required value="{{$order->first_name}}">
                        <input type="text" name="last_name" class="form-control mb-2" placeholder="Фамилия получателя" required value="{{$order->last_name}}">
                        <input type="text" name="passport_id" class="form-control mb-2" placeholder="Серия и номер паспорта" required value="{{$order->passport_id}}">
                        <input type="text" name="address" class="form-control mb-2" placeholder="Адрес" required value="{{$order->address}}">
                        <label for="status_select">Статус</label>
                        <select type="text" id="status_select" name="user_id" class="form-control mb-2" required value="{{$order->status}}">
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}">{{$status->desc}}</option>
                            @endforeach
                        </select>
                        <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
                        <button class="btn btn-primary m-2" type="submit"  onclick="orderUpdate(event)">Сохранить изменения</button>
                    </form>
                </x-modal>
                <x-modal>
                    <x-slot name="id">
                        del_modal_{{$order->id}}
                    </x-slot>
                    <x-slot name="title">
                        Вы действительно хотите удалить заказ № {{ $order->id }}?
                    </x-slot>
                    <form onsubmit="return false;">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Нет</button>
                    <button class="btn btn-danger m-2" type="submit"  onclick="orderDelete(event)">Да</button>
                    </form>
                </x-modal>
            </td>
        </tr>
        @endforeach
  </table>

  <script>
    async function orderUpdate(event){
    let form = event.currentTarget.parentNode;
    let order_id = form.order_id.value;
    let data = {
        "user_id" : form.user_select.value,
        "product_id" : form.product_select.value,
        "product_count" : form.product_count.value,
        "first_name" : form.first_name.value,
        "last_name" : form.last_name.value,
        "passport_id" : form.passport_id.value,
        "address" : form.address.value,
        "status" : form.status_select.value,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/orders/"+order_id;
    axios({
        method: "PATCH",
        url : url,
        data : data,
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }

        })
        .then(function(response){
        if(response.data["status"]==="success"){
            alert("товар успешно изменен")
        }
        form.reset();
        location.reload()
        })
        .catch(error => {
        if (!error.response) {
            // network error
            this.errorStatus = "Error: Network Error";
        } else {
            this.errorStatus = error.response.data.message;
        }
            console.log(this.errorStatus)
        });
}
async function orderDelete(event){
    let form = event.currentTarget.parentNode;
    let order_id = form.order_id.value;
    let url = "http://127.0.0.1:5000/admin/orders/"+order_id;
    axios.delete(url)
         .then(function(response){
            if(response.data["status"]==="success"){
                alert("товар успешно удален")
            }
            form.reset();
            location.reload()

            })
            .catch(error => {
            if (!error.response) {
                // network error
                this.errorStatus = "Error: Network Error";
            } else {
                this.errorStatus = error.response.data.message;
            }
                console.log(this.errorStatus)
            });
}
</script>
@endsection
