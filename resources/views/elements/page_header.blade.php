

@php

$now_route = \Route::currentRouteName();

@endphp



@if( $now_route !== "users.buyTicket" && $now_route !== "users.buyTicketConfirm" && $now_route !== "users.buyTicketThanks")


  @if(empty($auth_user->id))
  <header id="header">
    <div class="header__inner">
      <a href="{{ route('page.index') }}" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt="{{ config('const.SITE_TITLE') }}"></a>
      <div class="header__nav">
        <a href="{{ route('users.login') }}" class="header__login">ログイン</a>
        <a href="{{ route('users.regist') }}" class="header__memberBtn">新規会員登録</a>
      </div>
    </div>
  </header><!-- end #header -->
  @else
  <header id="header">
    <div class="header__inner">
      <a href="{{ route('page.index') }}" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt="{{ config('const.SITE_TITLE') }}"></a>
      <div class="header__nav">
        <a href="#" id="logout_href" class="header__logout">ログアウト</a>
        <a href="{{ route('users.index') }}" class="header__memberBtn">マイページ</a>
      </div>
    </div>
  </header><!-- end #header -->
  @endif

  <script>
    $("#logout_href").click(function() {
      $("#logout-form-sidenav").submit();
    });
  </script>

  <form id="logout-form-sidenav" action="{{ route('users.logout') }}" method="POST" class="d-none" style="display:none;">@csrf</form>



  @if(!empty($top_news))
  <div class="info">
    <div class="container">
      <ul class="info__list">
        @foreach($top_news as $top_news_key => $top_news_value)
        <li class="info__item"><a href="{{ route('page.newsdetail', ['id' => $top_news_value->id]) }}">{{ $top_news_value->title }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif




  @if(!empty($owner_name))
  <div class="lv">
    <h1 class="lv__txt">{{ $owner_name }}</h1>
  </div>
  @endif

  
@else

  <header id="header">
    <div class="header__inner">
      <a href="{{ route('page.index') }}" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt="{{ config('const.SITE_TITLE') }}"></a>
    </div>
  </header><!-- end #header -->



@endif