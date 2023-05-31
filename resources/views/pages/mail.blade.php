@extends('layouts.page')

@section('contents')



<article>

    <div class="container">

        <div class="wrap">
            <h1 class="heading1">メール</h1>

            @if(!empty($datas))
            <ul class="mail__list">

                @foreach($datas as $key => $data)
                <li class="mail__item">
                    <a href="{{ route('page.maildetail', ['id' => $data->id]) }}">
                        <time class="mail__item__date" datetime="{{ date('Y-m-d', strtotime($data->created_at)) }}">{{ date('Y/m/d', strtotime($data->created_at)) }}({{ config('week_name.'.date('w', strtotime($data->created_at))) }})</time>
                        <p class="mail__item__ttl">{{ $data->title }}</p>
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
