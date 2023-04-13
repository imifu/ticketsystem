@extends('layouts.page')

@section('contents')
<article>

  <div class="container container--s">

    <form action="registration_thanks.html">

      <div class="wrap">
        <h1 class="u-mb-56 u-ta-c u-fz-32 u-fw-b">ご登録ありがとうございます</h1>
        <p class="u-mb-64 u-ta-c">ご入力したいただいたメールアドレス宛に、<br>ご確認メールを送信いたしました。<br><br>メールに記載のＵＲＬへアクセス後、<br>ご登録完了となります。</p>

        <div class="btn__wrap">
          <a href="index.html" class="btn">トップページへ</a>
        </div>
      </div>

    </form>

  </div><!-- end .container -->

</article>

@endsection
