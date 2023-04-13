@extends('layouts.page')

@section('contents')
<article>

  <div class="container">

    <div class="wrap">
      <p class="u-mb-40 u-ta-c u-fz-24 u-fw-b">マイページ</p>

      <ul class="mypage__tab">
        <li class="mypage__tab__item"><a href="{{ route('users.index') }}">マイページ<br class="u-sp">トップ</a></li>
        <li class="mypage__tab__item"><a href="{{ route('users.history') }}">チケット<br class="u-sp">購入履歴</a></li>
        <li class="mypage__tab__item active"><a href="{{ route('users.profile') }}">会員情報<br class="u-sp">設定</a></li>
      </ul>

      
      <div class="container container--s">

        <form action="{{ route('users.profile_conf') }}" method="POST">

          @csrf

          <div class="wrap">
            <h1 class="heading1">会員情報の入力</h1>
            <p class="u-mb-40">お客様の情報をご入力後、会員規約・プライバシーポリシーをお読みになり、「入力内容を確認する」ボタンを押してください。</p>

            @if ($errors->any())
              @foreach ($errors->all() as $error)
              <div class="error_messages">・{{$error}}</div>
              @endforeach
            @endif
            
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> 会員名</dt>
              <dd>
                <input type="text" class="input input--s u-mr-16" placeholder="姓" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                <input type="text" class="input input--s" placeholder="名" name="first_name" value="{{ old('first_name', $user->first_name) }}">
              </dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> 性別</dt>
              <dd>
                <label><input type="radio" name="sex" value="1" {{ old('sex', $user->sex) == 1 ? "checked" : null }}>男性</label>　
                <label><input type="radio" name="sex" value="2"  {{ old('sex', $user->sex) == 2 ? "checked" : null }}>女性</label>
              </dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> 電話番号</dt>
              <dd><input type="tel" class="input" placeholder="例) 080-1234-5678" name="tel" value="{{ old('tel', $user->tel) }}"></dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> メールアドレス</dt>
              <dd><input type="email" class="input" placeholder="例) xxxx@xxxx.com" name="email" value="{{ old('email', $user->email) }}"></dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> ログインパス</dt>
              <dd><input type="password" class="input" name="password" value="{{ old('password') }}"></dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> ログインパス(確認)</dt>
              <dd><input type="password" class="input" name="password_confirmation" value="{{ old('password_confirmation') }}"></dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> 郵便番号</dt>
              <dd><input type="text" class="input input--s" name="post_code" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','pref','address');" value="{{ old('post_code', $user->post_code) }}"></dd>
            </dl>
            <dl class="dl dl--form">
              <dt><span class="required">必須</span> 都道府県</dt>
              <dd>
                <select name="pref" class="input">
                  <option value="" >選択してください</option>
                    @foreach(config('pref') as $pref_id => $name)
                    <option value="{{ $pref_id }}" {{ old('pref', $user->pref) === $pref_id ? "selected" : ""}}>{{ $name }}</option>
                    @endforeach
                </select>
              </dd>
            </dl>
            <dl class="dl dl--form" style="margin-bottom: 40px;">
              <dt><span class="required">必須</span> 市区町村以降の住所</dt>
              <dd><input type="text" class="input" name="address" value="{{ old('address', $user->address) }}"></dd>
            </dl>

            <div class="btn__wrap u-mt-0">
              <button class="btn" type="submit" id="privacy_check_btn" >入力内容を確認する</button>
            </div>
          </div>

        </form>

        </div><!-- end .container -->

    </div>

  </div><!-- end .container -->

</article>



@endsection
