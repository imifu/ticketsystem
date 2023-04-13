@extends('layouts.page')

@section('contents')
<article>

  <div class="container">

    <div class="wrap">
      <h1 class="u-mb-40 u-ta-c u-fz-24 u-fw-b">マイページ</h1>
      <p class="u-mb-56 u-ta-c">こんにちは　<span class="u-fw-b">{{ $user->last_name }}　{{ $user->first_name }}</span>　さん</p>

      <ul class="mypage__tab">
        <li class="mypage__tab__item active"><a href="{{ route('users.index') }}">マイページ<br class="u-sp">トップ</a></li>
        <li class="mypage__tab__item"><a href="{{ route('users.history') }}">チケット<br class="u-sp">購入履歴</a></li>
        <li class="mypage__tab__item"><a href="{{ route('users.profile') }}">会員情報<br class="u-sp">設定</a></li>
      </ul>

      <ul class="mypage__menu">
        <li class="mypage__menu__item">
          <a href="{{ route('users.history') }}">
            <div class="mypage__menu__item__img">
              <img src="./assets/images/mypage_menu01.svg" alt="">
            </div>
            <div class="mypage__menu__item__wrap">
              <p class="mypage__menu__item__ttl">チケット購入履歴</p>
              <p class="mypage__menu__item__txt">チケットの取引状況やコンサート当日に必要となるQRコード等をご確認いただけます。</p>
            </div>
          </a>
        </li>
        <li class="mypage__menu__item">
          <a href="{{ route('users.profile') }}">
            <div class="mypage__menu__item__img">
              <img src="./assets/images/mypage_menu02.svg" alt="">
            </div>
            <div class="mypage__menu__item__wrap">
              <p class="mypage__menu__item__ttl">会員情報設定</p>
              <p class="mypage__menu__item__txt">電話番号、メールアドレス、住所、パスワードの変更等を行います。</p>
            </div>
          </a>
        </li>
      </ul>

    </div>


  </div><!-- end .container -->

</article>

@endsection
