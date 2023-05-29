@extends('layouts.page')

@section('contents')


<h1 class="heading3 u-mb-32">購入が完了しました</h1>
  <p class="u-fz-14 u-ta-c u-mb-40">
    ご購入の内容は、マイページの<span class="u-fw-b">チケット購入履歴</span>よりご確認ください。<br>
    支払期限を過ぎますと、ご予約されたチケットは無効となりますので、ご注意ください。</p>

  <div class="container container--s">
    <h2 class="heading1">チケットのご利用方法</h2>

    <div class="flow">
      <h3 class="heading2">QRコードの表示</h3>
      <p class="u-mb-16">ログイン後マイページのチケット購入履歴で確認ができます。</p>
      <!-- <img src="./assets/images/sample/flow.png" alt=""> -->
    </div>
    <div class="flow">
      <h3 class="heading2">QRコードの使用方法</h3>
      <p class="u-mb-16">当日、会場でQRコードの確認を致します。QRコードをご用意の上ご来場ください。<br />確認後、席情報がマイページに掲載されます。</p>
      <!-- <img src="./assets/images/sample/flow.png" alt=""> -->
    </div>

    <!--
    <div class="flow">
      <h3 class="heading2">STEP.3 見出しテキスト</h3>
      <p class="u-mb-16">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
      <img src="./assets/images/sample/flow.png" alt="">
    </div>
-->

      <div class="btn__wrap">
        <a href="{{ route('page.index') }}" class="btn">トップページへ</a>
      </div>

  </div>

<article>

</article>

@endsection
