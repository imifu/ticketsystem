
<meta charset="utf-8">

<meta name="viewport" content="width=device-width">
<script src="{{ asset('assets/js/viewport-extra.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var ua = navigator.userAgent
  var isSmartPhone = ua.indexOf('iPhone') > -1 ||
    (ua.indexOf('Android') > -1 && ua.indexOf('Mobile') > -1)
  var isTablet = !isSmartPhone && (
    ua.indexOf('iPad') > -1 ||
    (ua.indexOf('Macintosh') > -1 && 'ontouchend' in document) ||
    ua.indexOf('Android') > -1
  )
  ViewportExtra.setContent({ minWidth: isTablet ? 1040 : 375 })
})
</script>

<title>{{ config('const.SITE_TITLE') }}</title>
<meta name="description" content="TicketParkはチケット販売サイトです。コンサート・ライブ・スポーツ・演劇・舞台・お笑い・クラシック・ミュージカル・イベント・レジャー・映画などチケット購入ならチケットパーク">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

<!-- ▼fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<!-- ▼css -->
<link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" media="all and (min-width : 768px)">
<link rel="stylesheet" href="{{ asset('assets/css/style_sp.css') }}" media="all and (max-width : 767px)">
<link rel="stylesheet" href="{{ asset('assets/css/utility.css') }}">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>