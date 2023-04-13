<!DOCTYPE html>
<html lang="en">
<head>
	@include('elements/admin_inhead')
</head>

<body>

	<!-- Page content -->
	<div class="page-content">


		<!-- Main sidebar -->
		@include('elements/admin_menu')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			@yield('contents')

			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2023-. <a href="{{ route('admin.top') }}">{{ config('const.SITE_TITLE'); }} 管理システム</a></a>
					</span>

					<!--
					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item"><a href="./" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> 操作マニュアル</a></li>
					</ul>
				-->
				
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
