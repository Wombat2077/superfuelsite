@extends('layouts.admin_app')
@section('content')

<h1 class="display-6 m-3" >Пользователи</h1>
<table class="table m-2 table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Описание</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->is_admin?"Да":"Нет"}}</td>
            <td>
                <x-buttonWithDropdown>
                <x-slot name="modal_id">
                        user-modal-{{ $user->id }}
                    </x-slot>
                    <x-slot name="button_label">
                        Изменить
                    </x-slot>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#del_modal_{{$user->id}}">Удалить</a>
                    </li>
                </x-buttonWithDropdown>
                <x-modal>
                    <x-slot name="id">
                        user-modal-{{ $user->id }}
                    </x-slot>
                    <x-slot name="title">
                        Редактирование пользователя
                    </x-slot>
                    <form id="users-update-form" onsubmit="return false;">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Имя пользователя" required value="{{$user->name}}">
                        <input type="text" name="password" class="form-control mb-2" placeholder="Новый пароль" >
                        <div class="form-check m-2">
                            <input type="checkbox" id="adminCheck" name="is_admin" class="form-check-input" value="" {{$user->is_admin?"checked":""}}>
                            <label for="adminCheck" class="form-check-label">Назначить пользователя администратором?</label>
                        </div>
                        <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
                        <button class="btn btn-primary m-2" type="submit"  onclick="userUpdate(event)">Сохранить изменения</button>
                    </form>
                </x-modal>
                <x-modal>
                    <x-slot name="id">
                        del_modal_{{$user->id}}
                    </x-slot>
                    <x-slot name="title">
                        Вы действительно хотите удалить пользователя {{ $user->name }}?
                    </x-slot>
                    <form onsubmit="return false;">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Нет</button>
                    <button class="btn btn-danger m-2" type="submit"  onclick="userDelete(event)">Да</button>
                    </form>
                </x-modal>
            </td>
        </tr>
        @endforeach


        <tr>
            <td colspan="4"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#users-add-form">Добавить нового пользователя</button>
            <x-modal>
            <x-slot name="id">
                users-add-form
            </x-slot>
            <x-slot name="title">
                Добавить нового пользователя
            </x-slot>
                <form id="users-add-form" onsubmit="return false;">
                    @csrf
                    <input type="text" name="name" class="form-control mb-2" placeholder="Имя пользователя" required/>
                    <input type="text" name="password" class="form-control mb-2" placeholder="Пароль" required/>
                    <input type="text" name="confirm-password" class="form-control mb-2" placeholder="Подтвердите пароль"/>
                    <div class="form-check m-2">
                        <input type="checkbox" id="adminCheck" name="is_admin" class="form-check-input" value=""/>
                        <label for="adminCheck" class="form-check-label">Назначить пользователя администратором?</label>
                    </div>
                    <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
                    <button class="btn btn-primary m-2" type="submit"  onclick="userAdd(event)" id="foobutton">Добавить</button>
                </form>
            </x-modal>
        </td>
        </tr>
  </table>

  <script>
    async function userUpdate(event){
    let form = event.currentTarget.parentNode;
    let user_id = form.user_id.value;
    let data = {
        "name" : form.name.value,
        "password" : form.password.value==""?null:form.password.value,
        "is_admin" : form.is_admin.checked,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/users/"+user_id;
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
            alert("Пользователь успешно изменен")
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
async function userDelete(event){
    let form = event.currentTarget.parentNode;
    let user_id = form.user_id.value;
    let url = "http://127.0.0.1:5000/admin/users/"+user_id;
    axios.delete(url)
         .then(function(response){
            if(response.data["status"]==="success"){
                alert("Пользователь успешно удален")
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
async function userAdd(event){
    let form = event.currentTarget.parentNode;
    let data = {
        "name" : form.name.value,
        "password" : form.password.value==""?null:form.password.value,
        "is_admin" : form.is_admin.checked,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/users";
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
            alert("Пользователь успешно добавлен");
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
