@extends('layouts.page')

@section('contents')



<article>

  <div class="container">

    <div class="wrap">
      <div class="u-mb-48">
        <h1 class="heading1 u-mb-24">{{ $data->title }}</h1>
        <p>{{ date('Y/m/d', strtotime($data->created_at)) }}({{ config('week_name.'.date('w', strtotime($data->created_at))) }}){{ date('H:00', strtotime($data->created_at)) }}</p>
      </div>

      <h2 class="heading2">{{ $data->header_text }}</h2>
      <p class="u-mb-40">
        {!! nl2br($data->detail) !!}
      </p>
      <div class="btn__wrap">
        <a href="{{ route('page.news') }}" class="btn">お知らせ一覧へ</a>
      </div>

    </div><!-- end .wrap -->

  </div><!-- end .container -->

</article>


@endsection
