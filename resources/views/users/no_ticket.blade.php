@extends('layouts.page')

@section('contents')

<article>
  <h1 class="heading3 u-mb-16">決済方法選択</h1>

  <p class="u-fz-14 u-ta-c u-mb-40">
    {{ !empty($msg) ? $msg : "※こちらのチケットは規定の販売数に達しています。" }}
  </p>
  <div class="btn__wrap" style="margin-bottom:20px;">
      <button class="btn btn--white" type="button" onclick="history.go(-3)">戻る</button>
  </div>

</article>

@endsection

