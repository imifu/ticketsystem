@extends('layouts.page')

@section('contents')



<article>

  <div class="container">

    <div class="wrap">
      <h2 class="heading1">{{ $data->title }}</h2>
      <div class="slider slider--ticket">
        <div class="slider__item"><img src="{{ asset($data->image) }}" alt=""></div>
        <div class="slider__item"><img src="{{ asset($data->image2) }}" alt=""></div>
        <div class="slider__item"><img src="{{ asset($data->image3) }}" alt=""></div>
      </div>

      <div class="u-mb-40">
        <h3 class="heading2">開催日時</h3>
        <p>
          {{ date('Y/m/d', strtotime($data->open_date)) }}({{ config('week_name.'.date('w', strtotime($data->open_date))) }}){{ date('H:i', strtotime($data->open_date)) }}
          〜
          {{ date('Y/m/d', strtotime($data->close_date)) }}({{ config('week_name.'.date('w', strtotime($data->close_date))) }}){{ date('H:i', strtotime($data->close_date)) }}
        </p>
      </div>

      <div class="u-mb-40">
        <h3 class="heading2">販売期間</h3>
        <p>
          {{ date('Y/m/d', strtotime($data->receive_from)) }}({{ config('week_name.'.date('w', strtotime($data->receive_from))) }}){{ date('H:i', strtotime($data->receive_from)) }}
          〜
          {{ date('Y/m/d', strtotime($data->receive_to)) }}({{ config('week_name.'.date('w', strtotime($data->receive_to))) }}){{ date('H:i', strtotime($data->receive_to)) }}
        </p>
      </div>

      <div class="u-mb-40">
        <h3 class="heading2">開催場所</h3>
        <p>{{ $data->place_name }}</p>
      </div>

      <div class="u-mb-40">
        <h3 class="heading2">会場情報</h3>
        <p>{{ $data->place }}</p>
      </div>

      <div class="u-mb-40 u-pb-40 u-bb">
        <h3 class="heading2">詳細</h3>
        <p>{{ $data->ticket_explain }}</p>
      </div>

      <div class="u-mb-40">
        <h3 class="heading2">チケットを選択</h3>
        <div class="ticket__wrap">
          <p class="ticket__time">[開 場] {{ date('H:i', strtotime($data->open_date)) }}　[閉 演]{{ date('H:i', strtotime($data->close_date)) }}</p>
          <ul class="sheet__list">


            @if(!empty($ticket_details))

              @foreach($ticket_details as $ticket_details_key => $ticket_detail)

                  @if($ticket_detail->sold_out_flg == 0)
                  <li class="sheet__item">
                    <a class="sheet__item__inner" href="{{ route('users.buyTicket', ['id' => $ticket_detail->id]) }}">
                      <div class="sheet__item__status sheet__item__status--onsale">発売中</div>
                      <p class="sheet__item__txt">{{ $ticket_detail->ticket_name }}<br>{{ number_format($ticket_detail->amount) }}円</p>
                      <p class="sheet__item__choice">選択する</p>
                    </a>
                  </li>
                  @else
                  <li class="sheet__item">
                    <div class="sheet__item__inner">
                      <div class="sheet__item__status sheet__item__status--soldout">受付終了</div>
                      <p class="sheet__item__txt">{{ $ticket_detail->ticket_name }}<br>{{ number_format($ticket_detail->amount) }}円</p>
                    </div>
                  </li>
                  @endif


              @endforeach


            @else
            <li class="sheet__item">
              <div class="sheet__item__inner">
                <div class="sheet__item__status sheet__item__status--soldout">受付終了</div>
                <p class="sheet__item__txt">*席<br>****円</p>
              </div>
            </li>
            @endif
          </ul>
        </div>
      </div>

    </div><!-- end .wrap -->

  </div><!-- end .container -->

</article>


@endsection
