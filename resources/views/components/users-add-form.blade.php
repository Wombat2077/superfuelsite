<form id="users-add-form1" onsubmit="return false;">
    <input type="text" name="name" class="form-control mb-2" placeholder="Имя пользователя" required/>
    <input type="text" name="password" class="form-control mb-2" placeholder="Пароль" required/>
    <input type="text" name="confirm-password" class="form-control mb-2" placeholder="Подтвердите пароль"/>
    <div class="form-check m-2">
        <input type="checkbox" id="adminCheck" name="is_admin" class="form-check-input" value=""/>
        <label for="adminCheck" class="form-check-label">Назначить пользователя администратором?</label>
    </div>
    <button type="reset" class="btn btn-secondary m-2" data-bs-dismiss="modal" onsubmit="event.preventDefault()">Закрыть</button>
    <button class="btn btn-primary m-2" type="submit"  onclick="userAdd(event)" id="foobutton">Сохранить изменения</button>
</form>
