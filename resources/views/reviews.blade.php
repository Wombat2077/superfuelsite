@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/reviews.css">
    <!-- отзыв от пользователя -->
    @guest
    <div class="d-flex justify-content-center">
        <div class="alert alert-danger w-50 d-flex justify-content-center">
            для написания отзыва необходимо зарегистрироваться
        </div>
    </div>
    @else
    <div class="container">
        <div id="reviews"></div>

        <div class="review-form">
          <h2>Оставьте свой отзыв</h2>
          <form id="reviewForm" method="post" action="{{ route('create_review') }}">
            @csrf
            <textarea id="review" name="content" placeholder="Ваш отзыв" required></textarea>
            <button type="submit">Отправить</button>
          </form>
        </div>
      </div>
      <script src="js/отзывы.js"></script>
      @endguest
      <!-- отзывы -->
        <div class="container">
          <h1>Отзывы о магазине "Топливо и энергетика"</h1>

        @foreach($comments as $comment)
        <div class="review">
            <h3>{{ $comment->user()->name }}</h3>
            <p>{{ $comment->content }}</p>
          </div>
        @endforeach
        </div>

@endsection


