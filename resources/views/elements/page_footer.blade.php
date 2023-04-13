
@php

$now_route = \Route::currentRouteName();

@endphp

@if( $now_route !== "users.buyTicket" && $now_route !== "users.buyTicketConfirm" && $now_route !== "users.buyTicketThanks")
<footer id="footer">
  <ul class="footer__nav">
    <li class="footer__nav__item"><a href="{{ route('page.raw') }}">特定商取引法に基づく表示</a></li>
    <li class="footer__nav__item"><a href="{{ route('page.privacy') }}">プライバシーポリシー</a></li>

  </ul>
  <ul class="footer__nav">
    <li class="footer__nav__item"><a href="{{ route('page.company') }}">運営会社</a></li>
  </ul>
  <a href="{{ route('page.index') }}" class="footer__logo"><img src="{{ asset('assets/images/logo_w.svg') }}" alt=""></a>
  <div class="copyright">Copyright &copy; 2023 {{ config('const.SITE_TITLE') }}.</div>
</footer><!-- end #footer -->
@else
<footer id="footer" class="footer--white">
  <div class="copyright">Copyright &copy; 2023 {{ config('const.SITE_TITLE') }}.</div>
</footer><!-- end #footer -->
@endif


<!-- ▼js -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>