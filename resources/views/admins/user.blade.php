
@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">サイト会員詳細</span></h4>
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
					<h5 class="card-title">サイト会員作成</h5>
				</div>

				<div class="card-body">
					<p class="mb-4">サイト会員データの内容</p>
					

					@if ($errors->any())
						@foreach ($errors->all() as $error)
						<div class="card-body alert alert-danger mb-10">{{$error}}</div>
						@endforeach
					@endif

					<form action="{{ route('admin.userSave') }}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null) }}" />
						<fieldset class="mb-3">
							<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

							<!-- Basic text input -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">名前（姓　名） <span class="text-danger">*</span></label>
								<div class="col-lg-3">
									<input type="text" name="last_name" class="form-control required" required placeholder="名字をご入力ください" value="{{ old('last_name' ,!empty($data['last_name']) ? $data['last_name'] : null) }}">
								</div>
								<div class="col-lg-3">
									<input type="text" name="first_name" class="form-control required" required placeholder="名前をご入力ください" value="{{ old('first_name' ,!empty($data['first_name']) ? $data['first_name'] : null) }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">性別 <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="sex" value="1" {{ old('sex' ,!empty($data['sex']) ? $data['sex'] : null) == "1" ? 'checked' : '' }} />男性</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="sex" value="2" {{ old('sex' ,!empty($data['sex']) ? $data['sex'] : null) == "2" ? 'checked' : '' }} />女性</label>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-form-label col-lg-3">メールアドレス <span class="text-danger">*</span></label>
								<div class="col-lg-6">
									<input type="text" name="email" class="form-control" required placeholder="半角英数でご入力ください" value="{{ old('email' ,!empty($data['email']) ? $data['email'] : null) }}">
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

							<div class="form-group row">
								<label class="col-form-label col-lg-3">電話番号<span class="text-danger">*</span></label>
								<div class="col-lg-5">
									<input type="text" name="tel" class="form-control required" required placeholder="111-1111" value="{{ old('tel' ,!empty($data['tel']) ? $data['tel'] : null) }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-form-label col-lg-3">郵便番号<span class="text-danger">*</span></label>
								<div class="col-lg-3">
									<input type="text" name="post_code" class="form-control required" required placeholder="111-1111" value="{{ old('post_code' ,!empty($data['post_code']) ? $data['post_code'] : null) }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-form-label col-lg-3">都道府県<span class="text-danger">*</span></label>
								<div class="col-lg-2">
									<select name="pref" class="form-control" required>
										@foreach(config('pref') as $pref_id => $name)
										<option value="{{ $pref_id }}" {{ old('pref', !empty($data['pref']) ? $data['pref'] : null) == $pref_id ? "selected" : ""}}>{{ $name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-form-label col-lg-3">都道府県以降 <span class="text-danger">*</span></label>
								<div class="col-lg-2">
									<input type="text" name="address" class="form-control required" required placeholder="千代田区千代田1-1-1" value="{{ old('address' ,!empty($data['address']) ? $data['address'] : null) }}">
								</div>
							</div>


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
