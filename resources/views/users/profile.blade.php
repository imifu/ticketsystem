@extends('layouts.page')

@section('contents')
<article>

  <div class="container">

    <div class="wrap">
      <h1 class="u-mb-40 u-ta-c u-fz-24 u-fw-b">マイページ</h1>

      <ul class="mypage__tab">
        <li class="mypage__tab__item"><a href="{{ route('users.index') }}">マイページ<br class="u-sp">トップ</a></li>
        <li class="mypage__tab__item"><a href="{{ route('users.history') }}">チケット<br class="u-sp">購入履歴</a></li>
        <li class="mypage__tab__item active"><a href="{{ route('users.profile') }}">会員情報<br class="u-sp">設定</a></li>
      </ul>

      <div class="container container--s">

          @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="error_messages">・{{$error}}</div>
            @endforeach
          @endif


        <dl class="dl dl--form">
          <dt>会員名</dt>
          <dd>{{ $user->last_name }}　{{ $user->first_name }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt>性別</dt>
          <dd>{{ $user->sex == 1 ? "男性" : "女性" }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt>電話番号</dt>
          <dd>{{ $user->tel }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt>メールアドレス</dt>
          <dd>{{ $user->email }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt>郵便番号</dt>
          <dd>{{ $user->post_code }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt>都道府県</dt>
          <dd>{{ config('pref.'.$user->pref) }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt>市区町村以降の住所</dt>
          <dd>{{ $user->address }}</dd>
        </dl>

        <div class="btn__wrap">
          <a href="{{ route('users.profile_change') }}" class="btn">会員情報を変更する</a>
        </div>
      </div>

    </div>

  </div><!-- end .container -->

</article>

@endsection
