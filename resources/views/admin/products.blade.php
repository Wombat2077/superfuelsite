@extends('layouts.admin_app')
@section('content')

<h1 class="display-6 m-3" >Продукты</h1>
<table class="table m-2 table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Имя товара</th>
        <th scope="col">Стоимость</th>
        <th scope="col">Есть ли на домашней странице</th>
        <th scope="col">Описание на домашней странице</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $product->id}}</th>
            <td>{{$product->name}}</td>
            <td>{{$product->desc}}</td>
            <td>{{$product->on_home?"Да":"Нет"}}</td>
            <td>{{$product->home_desc}}</td>
            <td>
                <x-buttonWithDropdown>
                <x-slot name="modal_id">
                        product-modal-{{ $product->id }}
                    </x-slot>
                    <x-slot name="button_label">
                        Изменить
                    </x-slot>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#del_modal_{{$product->id}}">Удалить</a>
                    </li>
                </x-buttonWithDropdown>
                <x-modal>
                    <x-slot name="id">
                        product-modal-{{ $product->id }}
                    </x-slot>
                    <x-slot name="title">
                        Редактирование пользователя
                    </x-slot>
                    <form id="products-update-form" onsubmit="return false;">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Название товара" required value="{{$product->name}}">
                        <input type="text" name="desc" class="form-control mb-2" placeholder="Описание" required value="{{$product->desc}}">
                        <input type="number" name="cost" class="form-control mb-2" placeholder="Цена товара" value="{{$product->cost}}">
                        <input type="text" name="home_desc" class="form-control mb-2" placeholder="Описание на домашней странице" value="{{$product->home_desc}}">
                        <div class="form-check m-2">
                            <input type="checkbox" id="homeCheck" name="on_home" class="form-check-input" value="" {{$product->on_home?"checked":""}}>
                            <label for="homeCheck" class="form-check-label">Отображать продукт на главной странице</label>
                        </div>
                        <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
                        <button class="btn btn-primary m-2" type="submit"  onclick="productUpdate(event)">Сохранить изменения</button>
                    </form>
                </x-modal>
                <x-modal>
                    <x-slot name="id">
                        del_modal_{{$product->id}}
                    </x-slot>
                    <x-slot name="title">
                        Вы действительно хотите удалить товар {{ $product->name }}?
                    </x-slot>
                    <form onsubmit="return false;">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Нет</button>
                    <button class="btn btn-danger m-2" type="submit"  onclick="productDelete(event)">Да</button>
                    </form>
                </x-modal>
            </td>
        </tr>
        @endforeach


        <tr>
            <td colspan="4"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#products-add-form">Добавить новый товар</button>
            <x-modal>
            <x-slot name="id">
                products-add-form
            </x-slot>
            <x-slot name="title">
                Добавить нового пользователя
            </x-slot>
                <form id="products-add-form" onsubmit="return false;">
                    @csrf
                    <input type="text" name="name" class="form-control mb-2" placeholder="Название товара">
                    <input type="text" name="desc" class="form-control mb-2" placeholder="Описание">
                    <input type="number" name="cost" class="form-control mb-2" placeholder="Цена товара">
                    <input type="text" name="home_desc" class="form-control mb-2" placeholder="Описание на домашней странице" >
                    <div class="form-check m-2">
                        <input type="checkbox" id="homeCheck" name="on_home" class="form-check-input" value="" >
                        <label for="homeCheck" class="form-check-label">Отображать продукт на главной странице</label>
                    </div>
                    <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
                    <button class="btn btn-primary m-2" type="submit"  onclick="productAdd(event)">Сохранить изменения</button>
                </form>
            </x-modal>
        </td>
        </tr>
  </table>

  <script>
    async function productUpdate(event){
    let form = event.currentTarget.parentNode;
    let product_id = form.product_id.value;
    let data = {
        "name" : form.name.value,
        "desc" : form.desc.value,
        "cost" : form.cost.value,
        "on_home" : form.on_home.checked,
        "home_desc" : form.home_desc==""?null:form.home_desc.value,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/products/"+product_id;
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
async function productDelete(event){
    let form = event.currentTarget.parentNode;
    let product_id = form.product_id.value;
    let url = "http://127.0.0.1:5000/admin/products/"+product_id;
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
async function productAdd(event){
    let form = event.currentTarget.parentNode;
    let data = {
        "name" : form.name.value,
        "desc" : form.desc.value,
        "cost" : form.cost.value,
        "on_home" : form.on_home.checked,
        "home_desc" : form.home_desc==""?null:form.home_desc.value,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/products";
    axios({
        method: "post",
        url : url,
        data : data,
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }

        })
        .then(function(response){
        if(response.data["status"]==="success"){
            alert("товар успешно добавлен");
        }
        form.reset();
        location.reload();
        })
        .catch(error => {
        if (!error.response) {
            // network error
            this.errorStatus = "Error: Network Error";
        } else {
            this.errorStatus = error.response.data.message;
        }
            console.log(this.errorStatus);
        });
}
  </script>
@endsection
