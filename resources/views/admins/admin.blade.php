
@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">管理者アカウント詳細</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content pt-0">

	<!-- Main charts -->
	<div class="row">
		<div class="col-xl-12">

			<!-- Form validation -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">管理者アカウント作成</h5>
				</div>

				<div class="card-body">
					<p class="mb-4">管理者アカウントデータの内容を登録してください。</p>
					

					@if ($errors->any())
						@foreach ($errors->all() as $error)
						<div class="card-body alert alert-danger mb-10">{{$error}}</div>
						@endforeach
					@endif

					<form action="{{ route('admin.adminSave') }}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
						<fieldset class="mb-3">
							<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

							<!-- Basic text input -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">アカウント名 <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="name" class="form-control required" required placeholder="アカウント名をご入力ください" value="{{ old('name' , !empty($data['name']) ? $data['name'] : null ) }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-form-label col-lg-3">メールアドレス <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="email" class="form-control" required placeholder="半角英数でご入力ください" value="{{ old('email' , !empty($data['email']) ? $data['email'] : null ) }}">
								</div>
							</div>
							<!-- /basic text input -->


							<!-- Password field -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">パスワード <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="password" name="password" id="password" class="form-control" required placeholder="8文字以上でご入力ください" value="{{ old('password') }}">
								</div>
							</div>
							<!-- /password field -->


							<!-- Repeat password -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">パスワード確認 <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="password" name="password_confirmation" class="form-control" required placeholder="パスワード再入力" value="{{ old('password_confirmation') }}">
								</div>
							</div>
							<!-- /repeat password -->

						<div class="d-flex justify-content-end align-items-center">
							<button type="reset" class="btn btn-light" id="reset">リセット <i class="icon-reload-alt ml-2"></i></button>
							<button type="submit" class="btn btn-primary ml-3">保存 <i class="icon-checkmark-circle ml-2"></i></button>
						</div>

					</form>
				</div>
			</div>
			<!-- /form validation -->

		</div>
</div>
<!-- /content area -->

@endsection
