<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>Топливо и энергетика</title>
    <link rel="stylesheet" href="css/register.css">
    <script src="js/register.js"></script>
</head>
<body>
    <div class="login-box" id="register-box">
        <h2>Регистрация</h2>
        <form >
        @csrf
          <div class="user-box">
            <input type="text" id="reg-username" required="">
            <label>Введите свое имя</label>
          </div>
          <div class="user-box">
            <input type="password" id="reg-password" required="">
            <label>Введите пароль</label>
          </div>
          <div class="user-box">
            <input type="password" id="confirm-password" required="">
            <label>Повторите пароль</label>
          </div>
          <div class="error-message">
                Пароли должны совпадать
          </div>
          <button href="#" type="button" class="register-button" onclick="register()">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Зарегистрироваться
          </button>
        </form>
        <p id="success-message"></p>
        <a href="home.html" class="home-link">На главную страницу</a>
        <button href="" onclick="show_login_box()" class="login-link">Авторизация</button>
      </div>
      <div class="login-box" id="login-box">
        <h2>Авторизация</h2>
        <form>
          <div class="user-box">
            <input type="text" name="username" id="log-username" required="">
            <label>Введите свое имя</label>
          </div>
          <div class="user-box">
            <input type="password" name="password" id="log-password" required="">
            <label>Введите пароль</label>
          </div>
          <button onclick="login()">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Войти
          </button>
        </form>
        <p id="success-message"></p>
        <a href="home.html" class="home-link">На главную страницу</a>
        <button  onclick="show_register_box()" class="login-link">Регистрация</button>
      </div>
</body>
</html>
