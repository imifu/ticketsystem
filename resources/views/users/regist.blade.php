@extends('layouts.page')

@section('contents')

<article>


  <div class="container container--s">

    <form action="{{ route('users.registConf') }}" method="POST">

      @csrf

      <div class="wrap">
        <h1 class="heading1">会員情報の入力</h1>
        <p class="u-mb-40">お客様の情報をご入力後、会員規約・プライバシーポリシーをお読みになり、「入力内容を確認する」ボタンを押してください。</p>

        @if ($errors->any())
          @foreach ($errors->all() as $error_mes)
          <div class="error_messages">・{{$error_mes}}</div>
          @endforeach
        @endif

        @if (!empty($error))
          <div class="error_messages">・{{$error}}</div>
        @endif
        
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 会員名</dt>
          <dd>
            <input type="text" class="input input--s u-mr-16" placeholder="姓" name="last_name" value="{{ old('last_name') }}">
            <input type="text" class="input input--s" placeholder="名" name="first_name" value="{{ old('first_name') }}">
          </dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 性別</dt>
          <dd>
            <label><input type="radio" name="sex" value="1" {{ old('sex') == 1 ? "checked" : null }}>男性</label>　
            <label><input type="radio" name="sex" value="2"  {{ old('sex') == 2 ? "checked" : null }}>女性</label>
          </dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 電話番号</dt>
          <dd><input type="tel" class="input" placeholder="例) 080-1234-5678" name="tel" value="{{ old('tel') }}"></dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> メールアドレス</dt>
          <dd><input type="email" class="input" placeholder="例) xxxx@xxxx.com" name="email" value="{{ old('email') }}"></dd>
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
          <dd><input type="text" class="input input--s" name="post_code" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','pref','address');" value="{{ old('post_code') }}"></dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 都道府県</dt>
          <dd>
            <select name="pref" class="input">
              <option value="" selected>選択してください</option>
                @foreach(config('pref') as $pref_id => $name)
                <option value="{{ $pref_id }}" {{ old('pref', !empty($data['pref']) ? $data['pref'] : null) === $pref_id ? "selected" : "" }}>{{ $name }}</option>
                @endforeach
            </select>
          </dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 市区町村以降の住所</dt>
          <dd><input type="text" class="input" name="address" value="{{ old('address') }}"></dd>
        </dl>

        <div class="privacy__wrap u-mt-40">
          <p>
            @include('elements/regist_policy')
          </p>
        </div>

        <div class="privacy__check">
          <label>
            <input type="checkbox" id="privacy" name="privacy" value="1"> 会員規約・<a href="{{ route('page.privacy'); }}" target="_blank">プライバシーポリシー</a>に同意する
          </label>
        </div>

        <div class="btn__wrap u-mt-0">
          <button class="btn" type="submit" id="privacy_check_btn" onclick="return false;">入力内容を確認する</button>
        </div>
      </div>

    </form>

  </div><!-- end .container -->

</article>


<script>
$("#privacy_check_btn").on("click", function() {

  if($("#privacy").is(":checked") == false) {
    alert("会員規約・プライバシーポリシーに同意してください。");
    return false;
  }

  $(this).parents('.container').find('form').first().submit();

});
</script>

@endsection
