@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">トップ</span> - Dashboard</h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
  </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content pt-0">

<ul class="nav nav-sidebar" data-nav-type="accordion">

<!-- Main -->

<li class="nav-item nav-item-submenu">
  <a href="#" class="nav-link"><i class="icon-lock"></i> <span>管理者 管理</span></a>

  <ul class="nav nav-group-sub" data-submenu-title="Themes">
    <li class="nav-item"><a href="{{ route('admin.admins') }}" class="nav-link">管理者一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
    <li class="nav-item"><a href="{{ route('admin.admin') }}" class="nav-link">管理者作成</a></li>
  </ul>
</li>

<li class="nav-item nav-item-submenu">
  <a href="#" class="nav-link"><i class="icon-new"></i> <span>お知らせ 管理</span></a>

  <ul class="nav nav-group-sub" data-submenu-title="Themes">
    <li class="nav-item"><a href="{{ route('admin.news') }}" class="nav-link">お知らせ一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
    <li class="nav-item"><a href="{{ route('admin.createDetail') }}" class="nav-link">新規作成</a></li>
  </ul>
</li>

<li class="nav-item nav-item-submenu">
  <a href="#" class="nav-link"><i class="icon-users"></i> <span>サイト会員 管理</span></a>

  <ul class="nav nav-group-sub" data-submenu-title="Themes">
    <li class="nav-item"><a href="{{ route('admin.users') }}" class="nav-link">サイト会員一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
    <li class="nav-item"><a href="{{ route('admin.createUser') }}" class="nav-link">新規会員作成</a></li>
  </ul>
</li>

<li class="nav-item nav-item-submenu">
  <a href="#" class="nav-link"><i class="icon-cart"></i> <span>販売チケット 管理</span></a>

  <ul class="nav nav-group-sub" data-submenu-title="Themes">
    <li class="nav-item"><a href="{{ route('admin.tickets') }}" class="nav-link">販売チケット一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
    <li class="nav-item"><a href="{{ route('admin.ticket') }}" class="nav-link">チケット作成</a></li>
    <li class="nav-item"><a href="{{ route('admin.seatsAll') }}" class="nav-link">座席一覧</a></li>
    <li class="nav-item"><a href="{{ route('admin.seats') }}" class="nav-link">販売座席作成</a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="{{ route('admin.payments') }}" id="" class="nav-link"><i class="icon-coins"></i> <span>売上ログ</span></a>
</li>

<li class="nav-item">
  <a href="{{ route('admin.qr') }}" id="" class="nav-link qrcode_href"><i class="icon-qrcode" id=""></i> <span>QRコードリーダー</span></a>
</li>

<li class="nav-item">
  <a href="#" id="" class="nav-link logout_href"><i class="icon-exit3"></i> <span>ログアウト</span></a>
</li>

<form id="logout-form-sidenav2" action="{{ route('admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script>

$(".logout_href").click(function() {
  $("#logout-form-sidenav2").submit();
});
</script>

<!-- /layout -->

</ul>

</div>
<!-- /content area -->


@endsection

