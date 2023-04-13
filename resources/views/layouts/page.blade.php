<!DOCTYPE HTML>
<html lang="ja">
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# article: https://ogp.me/ns/article#">

@include('elements/page_inhead')


</head>

<body>

@include('elements/page_header')

<div id="main">
@yield('contents')
</div><!-- end #main -->

@include('elements/page_footer')

</body>
</html>