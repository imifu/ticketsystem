@extends('layouts.page')

@section('contents')

<article>

  <div class="container">

    <div class="wrap">
      <h1 class="u-mb-40 u-ta-c u-fz-24 u-fw-b">マイページ</h1>

      <ul class="mypage__tab">
        <li class="mypage__tab__item"><a href="{{ route('users.index') }}">マイページ<br class="u-sp">トップ</a></li>
        <li class="mypage__tab__item active"><a href="{{ route('users.history') }}">チケット<br class="u-sp">購入履歴</a></li>
        <li class="mypage__tab__item"><a href="{{ route('users.profile') }}">会員情報<br class="u-sp">設定</a></li>
      </ul>

      


        @if(!empty($datas))
        @foreach($datas as $data_key => $data)
        <div class="ticket__wrap u-mb-40">
        <div class="ticket__inner u-pb-32">
          <div class="ticket__item__img"><img src="./assets/images/sample/artist_thumb02.jpg" alt=""></div>
          <div class="ticket__item__outline">
            <p class="ticket__item__artist">{{ $data->owner_name }}</p>
            <p class="ticket__item__eventTitle">{{ $data->ticket_title }}</p>
            <dl class="ticket__dl">
              <dt>チケット:</dt>
              <dd>{{ $data->ticket_name }}　{{ number_format($data->amount) }}円</dd>
            </dl>
            <dl class="ticket__dl">
              <dt>開催日時:</dt>
              <dd>{{ date('Y/m/d', strtotime($data->open_date)) }}({{ config('week_name.'.date('w', strtotime($data->open_date))) }}){{ date('H:i', strtotime($data->open_date)) }}</dd>
            </dl>
            <dl class="ticket__dl">
              <dt>開催場所:</dt>
              <dd>{{ $data->place_name }} <br>{!! nl2br($data->place) !!}</dd>
            </dl>
            <dl class="ticket__dl">
              <dt>詳　　細:</dt>
              <dd>{!! nl2br($data->ticket_explain) !!}</dd>
            </dl>
          </div>
          <div class="ticket__detail">
            <h2 class="heading1">チケットのご利用方法</h2>
            <div class="flow">
              <h3 class="heading2">QRコードの表示</h3>
              <p class="u-mb-16">ログイン後マイページのチケット購入履歴で確認ができます。</p>
              <img src="./assets/images/sample/flow.png" alt="">
            </div>
            <div class="flow">
              <h3 class="heading2">QRコードの使用方法</h3>
              <p class="u-mb-16">当日、会場でQRコードの確認を致します。QRコードをご用意の上ご来場ください。<br />確認後、席情報がマイページに掲載されます。</p>
              <img src="./assets/images/sample/flow.png" alt="">
            </div>

            <!--
            <div class="flow">
              <h3 class="heading2">STEP.3 見出しテキスト</h3>
              <p class="u-mb-16">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
              <img src="./assets/images/sample/flow.png" alt="">
            </div>
            -->

          </div>

          <div class="ticket__qr">
            <h2 class="heading1">QRコード</h2>
            <div class="flow">
              <p class="u-mb-16">

                @php

                $now = date("Y-m-d H:i:s");

                $target_date_ins = new DateTime($data->open_date);
                $target_date = $target_date_ins->modify("-1 day")->format("Y-m-d H:i:s");

                if($now > $target_date) {

                  echo '<p class="u-mb-16">チケット番号：'.$data->user_ticket_id."</p>"; 

                  if($data->come_flg == 1) {

                    echo '<p class="u-mb-16">座席番号：'.$data->seat."</p>";

                  }

                  echo QrCode::size(300)->generate($data->qr_code);

                  
                  
                } else {
                  echo "チケットのQRコードは開催時間の24時間前から表示できます。";
                }


                @endphp

              </p>

              <img src="./assets/images/sample/flow.png" alt="">
            </div>
          </div>
          <div class="btn__wrap u-w-100 u-mt-24">
            <a href="#" class="btn ticket__qr__btn">ＱＲコードを表示する</a>
            <div class="btn btn--white ticket__detail__btn">詳細を見る</div>
          </div>
        </div>
      </div>
      @endforeach
      @endif


    </div>


  </div><!-- end .container -->

</article>

@endsection
