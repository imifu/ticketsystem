
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
            <div class="media-title font-weight-semibold">{{AUTH_NAME}}　さん</div>
            <div class="font-size-xs opacity-50">
              <i class="icon-pin font-size-sm"></i> &nbsp;ログイン中
            </div>
          </div>

          <div class="ml-3 align-self-center">

            @if(empty(CLINIC_ID))
            <a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/admin/{{AUTH_ID}}" class="text-white"><i class="icon-cog3"></i></a>
            @endif

            @if(!empty(CLINIC_ID))
            <a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/account/{{AUTH_ID}}" class="text-white"><i class="icon-cog3"></i></a>
            @endif

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
          <a href="{{url('/')}}/{{config('const.ADMIN_URL')}}" class="nav-link active">
            <i class="icon-home5"></i>
            <span>
              トップ
            </span>
          </a>
        </li>

        @if (empty(CLINIC_ID))
        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-users"></i> <span>管理者アカウント</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Layouts">
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/admins" class="nav-link">管理者アカウント一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/admin" class="nav-link">管理者アカウント新規追加</a></li>
          </ul>
        </li>
        @endif

        @if (empty(CLINIC_ID))
        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-pencil6"></i> <span>投稿用アカウント</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Layouts">
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/accounts" class="nav-link">投稿用アカウント一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/account" class="nav-link">投稿用アカウント新規追加</a></li>
          </ul>
        </li>
        @endif

        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-file-text"></i> <span>モニター記事管理</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Themes">
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/monitors" class="nav-link">モニター記事一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/monitor" class="nav-link">モニター記事投稿<span class="badge bg-transparent align-self-center ml-auto">マスター用</span></a></li>
          </ul>
        </li>

        @if (empty(CLINIC_ID))
        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-address-book2"></i> <span>ドクター管理</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Themes">
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/doctors" class="nav-link">ドクター一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/doctor" class="nav-link">ドクター新規追加</a></li>
          </ul>
        </li>
        @endif

        @if (empty(CLINIC_ID))
        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-office"></i> <span>医院管理</span></a>

          <ul class="nav nav-group-sub" data-submenu-title="Themes">
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/clinics" class="nav-link">医院一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/clinic" class="nav-link">医院新規追加</a></li>
          </ul>
        </li>
        @endif

        @if (empty(CLINIC_ID))
        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-price-tags"></i> <span>タグ管理</span></a>
          <ul class="nav nav-group-sub" data-submenu-title="Themes">
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/tags" class="nav-link">タグ一覧<span class="badge bg-transparent align-self-center ml-auto"></span></a></li>
            <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/tag" class="nav-link">タグ管理 新規追加</a></li>
          </ul>
        </li>
        @endif

        <li class="nav-item"><a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/logout" class="nav-link"><i class="icon-exit3"></i> <span>ログアウト</span></a></li>

        <!-- /layout -->

      </ul>
    </div>
    <!-- /main navigation -->

  </div>
  <!-- /sidebar content -->

</div>
