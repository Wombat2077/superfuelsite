@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/about.css">
<link rel="stylesheet" href="css/home.css">


<!-- вступление -->
<section id="about">
    <div class="container">
        <center><h3>О нас:</h3></center>
        <p>Мы - интернет-магазин "Топливо и энергетика", предлагаем широкий ассортимент топлива и энергетического оборудования. Наша команда состоит из профессионалов, которые заботятся о вашем комфорте и удовлетворении потребностей в области топлива и энергетики.</p>
        <p>Мы стремимся предоставить вам высококачественные продукты и надежные услуги. Наша цель - обеспечить ваш бизнес и повседневную жизнь энергией и топливом, на которые вы можете положиться.</p>
        <p>Мы гордимся нашей командой и всегда готовы помочь вам с выбором, консультацией и обеспечить вас высоким уровнем обслуживания.</p>
    </div>
</section>
<!-- наша команда -->
<section id="team">
  <div class="container">
    <center><h2>Наша команда</h2></center>
    <table>
      <tr>
        <td>
          <div class="member">
            <div class="member-img">
              <img src="img/сотрудник 1.jpg" alt="Картинка команды">

            </div>
            <h3>Генадий Сергеевич</h3>
            <p>Совет директоров</p>
          </div>
        </td>
        <td>
          <div class="member">
            <div class="member-img">
              <img src="img/сотрудник 2.jpg" alt="Картинка команды">

            </div>
            <h3>Александр Дропов</h3>
            <p>Генеральный директор компании</p>
          </div>
        </td>
        <td>
          <div class="member">
            <div class="member-img">
              <img src="img/сотрудник 3.png" alt="Картинка команды">

            </div>
            <h3>Анастасия Тушко</h3>
            <p>IT-разработчик сайта</p>
          </div>
        </td>
      </tr>
    </table>
  </div>
</section>



  <script src="script.js"></script>
@endsection
