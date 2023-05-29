@extends('layouts.page')

@section('contents')

<article>

  @if(!empty($bunner_datas))
  <div class="slider">
    
    @foreach($bunner_datas as $b_key => $b_data)
    <div class="slider__item"><a href="{{ route('page.ticket', ['id' => $b_data->id]) }}"><img src="{{ asset($b_data->image) }}" alt=""></a></div>
    @endforeach

  </div>
  @endif

  <div class="container">

    <div class="wrap">
      <h2 class="heading1">チケット一覧</h2>
      <ul class="ticket__list">

      @if(!empty($datas))

        @foreach($datas as $key => $data)


        @php
            
          $now = date("Y-m-d H:i:s");
          $target = date("Y-m-d H:i:s", strtotime($data->receive_from));
          $target2 = date("Y-m-d H:i:s", strtotime($data->receive_to));

          $link_str = "";
          $link_href = "";


          if($target <= $now && $now <= $target2) {

            $link_href = route('page.ticket', ['id' => $data->id]);
            $link_str = "選択する";

          } else {



            if($target > $now) {

              $link_href = 'javascript:return false;';
              $link_str = "販売前";

            } else if($now > $target2) {

              $link_href = 'javascript:return false;';
              $link_str = "受付終了";

            }

          }

          

        @endphp


        <li class="ticket__item">
          <a href="{{ route('page.ticket', ['id' => $data->id]) }}">
            <time class="ticket__item__date" datetime="{{ date('Y-m-d', strtotime($data->show_from)) }}">
              {{ date('Y', strtotime($data->open_date)) }}/<span>{{ date('m/d', strtotime($data->open_date)) }}({{ config('week_name.'.date('w', strtotime($data->open_date))) }})</span>
            </time>
            <div class="ticket__item__img"><img src="{{ asset($data->image) }}" alt=""></div>
            <div class="ticket__item__outline">
              <p class="ticket__item__artist">{{ $data->owner_name }}</p>
              <p class="ticket__item__eventTitle">{{ $data->title }}</p>
              <p class="ticket__item__term">
                販売期間: {{ date('Y/m/d', strtotime($data->receive_from)) }}({{ config('week_name.'.date('w', strtotime($data->receive_from))) }}){{ date('H:i', strtotime($data->receive_from)) }}
                〜
                {{ date('Y/m/d', strtotime($data->receive_to)) }}({{ config('week_name.'.date('w', strtotime($data->receive_to))) }}){{ date('H:i', strtotime($data->receive_to)) }}</p>
              <p class="ticket__item__place">開催場所: {{ $data->place_name }}</p>
            </div>
            <div class="ticket__item__choice">{{ $link_str }}</div>
          </a>
        </li>
        @endforeach

      @endif

      </ul><!-- end .ticket__list -->
      <ul class="pager">

        @if($datas->currentPage() != 1)
          <li><a href="{{ $datas->previousPageUrl() }}">前へ</a></li>
        @endif

        @for ($i = 1; $i <= $datas->lastPage(); $i++)

          @if($datas->currentPage() == $i)
            <li><span>{{ $datas->currentPage() }}</span></li>
          @else
            <li><a href="{{ $datas->url($i) }}">{{ $i }}</a></li>
          @endif
        @endfor

        @if($datas->hasMorePages())
          <li><a href="{{ $datas->nextPageUrl() }}">次へ</a></li>
        @endif
      </ul>
    </div><!-- end .wrap -->


    @if(!empty($news_datas))
    <div class="wrap">
      <h2 class="heading1">お知らせ</h2>
      <ul class="news__list">

        @foreach($news_datas as $n_key => $news)
        <li class="news__item">
          <a href="{{ route('page.newsdetail',['id' => $news->id]) }}">
            <time class="news__item__date" datetime="{{ date('Y-m-d', strtotime($news->created_at)) }}">{{ date('Y/m/d', strtotime($news->created_at)) }}({{ config('week_name.'.date('w', strtotime($news->created_at))) }})</time>
            <p class="news__item__ttl">{{ $news->title }}</p>
          </a>
        </li>
        @endforeach
      </ul><!-- end .news__list -->
      <div class="btn__wrap">
        <a href="{{ route('page.news') }}" class="btn">お知らせ一覧</a>
      </div>
    </div><!-- end .wrap -->
    @endif

  </div><!-- end .container -->

</article>

@endsection
