@extends('layouts.page')

@section('contents')

<article>
  <h1 class="heading3 u-mb-16">決済方法選択</h1>

  <p class="u-fz-14 u-ta-c u-mb-40">※お使いのクレジットカード決済が失敗しました。<br><br>再度正しく情報を入力するか、お使いのクレジットカード会社にお問い合わせください。</p>
  <div class="btn__wrap" style="margin-bottom:20px;">
      <button class="btn btn--white" type="button" onclick="history.back()">戻る</button>
  </div>

</article>

@endsection
