@extends('layouts.page')

@section('contents')



<article>

  <div class="container">

    <div class="wrap">
      <h1 class="heading1 u-mb-16">運営会社</h1>

      <dl class="dl">
        <dt>社名</dt>
        <dd>{{ config('const.COMPANY_NAME') }}</dd>
      </dl>
      <dl class="dl">
        <dt>設立</dt>
        <dd>{{ config('const.COMPANY_BIRTH') }}</dd>
      </dl>
      <!--
      <dl class="dl">
        <dt>事業内容</dt>
        <dd>
          <span class="u-d-b u-tx-inside">・テキストテキストテキストテキストテキストテキストテキストテキスト</span>
          <span class="u-d-b u-tx-inside">・テキストテキストテキストテキストテキストテキストテキストテキスト</span>
          <span class="u-d-b u-tx-inside">・テキストテキストテキストテキストテキストテキストテキストテキスト</span>
        </dd>
      </dl>
      -->
      <dl class="dl">
        <dt>所在地</dt>
        <dd>{{ config('const.COMPANY_ADDRESS') }}</dd>
      </dl>
      <dl class="dl">
        <dt>電話番号</dt>
        <dd>{{ config('const.COMPANY_TEL') }}</dd>
      </dl>
      <!--
      <dl class="dl">
        <dt>FAX</dt>
        <dd>{{ config('const.COMPANY_FAX') }}</dd>
      </dl>
      -->
      <dl class="dl">
        <dt>E-Mail</dt>
        <dd>{{ config('const.COMPANY_EMAIL') }}</dd>
      </dl>
    </div><!-- end .wrap -->

  </div><!-- end .container -->

</article>


@endsection
