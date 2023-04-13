@extends('layouts.page')

@section('contents')

<article>

  <div class="container container--s">

    <form action="{{ route('users.userSave') }}" method="POST">

      @csrf

      <div class="wrap">
        <h1 class="heading1">会員情報の入力内容確認</h1>
        <p class="u-mb-40">入力した内容をご確認ください。<br>間違いがなければ「この内容で登録する」ボタンを押してください。<br>修正する場合は、「修正する」ボタンから戻って修正してください。</p>

        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 会員名</dt>
          <dd>{{ $data['last_name'] }}　{{ $data['first_name'] }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 性別</dt>
          <dd>{{ $data['sex'] == 1 ? "男性" : "女性"; }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 電話番号</dt>
          <dd>{{ $data["tel"] }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> メールアドレス</dt>
          <dd>{{ $data["email"] }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 郵便番号</dt>
          <dd>{{ $data["post_code"] }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 都道府県</dt>
          <dd>{{ config('pref.'.$data["pref"]) }}</dd>
        </dl>
        <dl class="dl dl--form">
          <dt><span class="required">必須</span> 市区町村以降の住所</dt>
          <dd>{{ $data["address"] }}</dd>
        </dl>

        <div class="btn__wrap">
          <button class="btn" type="submit" name="submit">この内容で登録する</button>
          <button class="btn btn--white" type="button" onclick="history.back()">修正する</button>
        </div>
      </div>

      @foreach($data as $column_name => $value)

        @if($column_name == "_token" || $column_name == "submit") @continue @endif
        <input type="hidden" name="{{ $column_name }}" value="{{ $value }}">

      @endforeach

    </form>

  </div><!-- end .container -->

</article>
@endsection
