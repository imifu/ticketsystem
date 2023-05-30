
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

  <!-- Sidebar mobile toggler -->
  <div class="sidebar-mobile-toggler text-center">
    <a href="#" class="sidebar-mobile-main-toggle">
      <i class="icon-arrow-left8"></i>
    </a>
    Navigation
    <a href="#" class="sidebar-mobile-expand">
      <i class="icon-screen-full"></i>
      <i class="icon-screen-normal"></i>
    </a>
  </div>
  <!-- /sidebar mobile toggler -->


  <!-- Sidebar content -->
  <div class="sidebar-content">

    <!-- User menu -->
    <div class="sidebar-user">
      <div class="card-body">
        <div class="media">
          <div class="mr-3">
            <a href="#"><img src="{{ asset('img/site-logo.png') }}" style="max-width:100px;" class="rounded-circle" alt=""></a>
          </div>

          <div class="media-body">
            <div class="media-title font-weight-semibold">{{ Auth::user()->name }}　さん</div>
            <div class="font-size-xs opacity-50">
              <i class="icon-pin font-size-sm"></i> &nbsp;ログイン中
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /user menu -->


    <!-- Main navigation -->
    <div class="card card-sidebar-mobile">
      <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main -->

        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">メニュー</div> <i class="icon-menu" title="Main"></i></li>
        <li class="nav-item">
          <a href="{{ route('admin.top') }}" class="nav-link active">
            <i class="icon-home5"></i>
            <span>
              トップ
            </span>
          </a>
        </li>


        @if(Auth::user()->admin_flg == 0)


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

        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-ticket"></i> <span>来場者 管理</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Themes">
            <li class="nav-item"><a href="{{ route('admin.enter_seat') }}" class="nav-link">販売済チケットの座席管理</a></li>
            <li class="nav-item"><a href="{{ route('admin.sumally') }}" class="nav-link">来場者サマリー</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.payments') }}" id="" class="nav-link"><i class="icon-coins"></i> <span>売上ログ</span></a>
        </li>

        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-mail-read"></i> <span>メルマガ 管理</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Themes">
            <li class="nav-item"><a href="{{ route('admin.mail_magazine_search') }}" class="nav-link">メルマガ送信先の検索</a></li>
            <li class="nav-item"><a href="{{ route('admin.mail_magazine') }}" class="nav-link">メルマガ新規作成</a></li>
          </ul>
        </li>

        @endif

        <li class="nav-item">
          <a href="{{ route('admin.qr') }}" id="" class="qrcode_href nav-link"><i class="icon-qrcode"></i> <span>QRコードリーダー</span></a>
        </li>

        <li class="nav-item">
          <a href="#" id="logout_href" class="nav-link"><i class="icon-exit3"></i> <span>ログアウト</span></a>
        </li>

        <!-- /layout -->

      </ul>

      <script>

        $("#logout_href").click(function() {
          $("#logout-form-sidenav").submit();
        });
      </script>

      <form id="logout-form-sidenav" action="{{ route('admin.logout') }}" method="POST" class="d-none">
          @csrf
      </form>


    </div>
    <!-- /main navigation -->

  </div>
  <!-- /sidebar content -->

</div>
