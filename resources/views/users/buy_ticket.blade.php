@extends('layouts.page')

@section('contents')

<article>
  <h1 class="heading3 u-mb-16">決済方法選択</h1>

  @if(!empty($data))
    <p class="u-fz-14 u-ta-c u-mb-40">※まだ購入は完了していません。</p>
  @else
    <p class="u-fz-14 u-ta-c u-mb-40">※こちらのチケットは販売を終了致しました。</p>
    <div class="btn__wrap" style="margin-bottom:20px;">
        <button class="btn btn--white" type="button" onclick="history.back()">戻る</button>
    </div>
  @endif



  @if(!empty($data))
  <div class="container">

    <form action="{{ route('users.buyTicketConfirm') }}" method="POST">
      @csrf

      <input type="hidden" name="ticket_detail_id" value="{{ $data->ticket_detail_id }}">

      <div class="u-mb-56">
        <h2 class="heading1">ご購入されるチケット</h2>
        <div class="ticket__wrap">
          <div class="ticket__inner">
            <div class="ticket__item__img"><img src="{{ asset($data->image) }}" alt=""></div>
            <div class="ticket__item__outline">
              <p class="ticket__item__artist">{{ $data->owner_name }}</p>
              <p class="ticket__item__eventTitle">{{ $data->live_name }}</p>
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
                <dd>{{ $data->place_name }}<br>{!! nl2br($data->place) !!}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <div class="u-mb-56">
        <h2 class="heading1">決済方法を選択してください</h2>
        <div class="payment__radio">
          <label for="radio-1">
            <input type="radio" name="payment_flg" value="1" id="radio-1">
            <span><img src="{{ asset('assets/images/icon_card.svg') }}" alt=""> {{ config('payment_flg.1') }}</span>
          </label>
          <label for="radio-2">
            <input type="radio" name="payment_flg" value="2" id="radio-2">
            <span><img src="{{ asset('assets/images/icon_convinience.svg') }}" alt=""> {{ config('payment_flg.2') }}</span>
          </label>
        </div>
      </div>

      <div class="btn__wrap u-mt-0">
        <button class="btn" type="submit" name="submit">購入内容を確認する</button>
        <a href="ticket.html" class="btn btn--white">チケット選択へ戻る</a>
      </div>

    </form>

  </div>
  @endif



</article>

@endsection
