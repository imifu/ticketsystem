@extends('layouts.page')

@section('contents')
<h1 class="heading3">ログイン</h1>

<div class="login__wrap">
  <form action="{{ route('users.loginS') }}" method="POST">
    @csrf
    <h2 class="u-fz-20 u-fw-b u-mb-24 u-ta-c">メールアドレスでログイン</h2>

    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="error_messages">・{{$error}}</div>
      @endforeach
    @endif

    <div class="u-mb-16">
      <p class="u-mb-8">メールアドレス</p>
      <input class="input" type="text" placeholder="例) xxxx@xxxx.com" name="email">
    </div>
    <div class="u-mb-24">
      <p class="u-mb-8">パスワード</p>
      <input class="input" type="password" name="password">
    </div>
    <div class="btn__wrap u-mt-0">
      <button class="btn" type="submit" name="submit">ログイン</button>
    </div>
  </form>
</div>

<div class="login__wrap">
  <h2 class="u-fz-20 u-fw-b u-mb-24 u-ta-c">はじめてご利用の方</h2>
  <div class="btn__wrap u-mt-0">
    <a href="{{ route('users.regist') }}" class="btn btn--white">会員登録へ進む</a>
  </div>
</div>
<article>

</article>


@endsection
