@extends('layouts.page')

@section('contents')



<article>

  <div class="container">

    <div class="wrap">
      <h1 class="heading1">お知らせ</h1>

      @if(!empty($datas))
      <ul class="news__list">

        @foreach($datas as $key => $data)
        <li class="news__item">
          <a href="{{ route('page.newsdetail', ['id' => $data->id]) }}">
            <time class="news__item__date" datetime="{{ date('Y-m-d', strtotime($data->created_at)) }}">{{ date('Y/m/d', strtotime($data->created_at)) }}({{ config('week_name.'.date('w', strtotime($data->created_at))) }})</time>
            <p class="news__item__ttl">{{ $data->title }}</p>
          </a>
        </li>
        @endforeach
      </ul><!-- end .news__list -->
      @endif

      
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

  </div><!-- end .container -->

</article>


@endsection
