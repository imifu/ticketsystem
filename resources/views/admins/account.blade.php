@extends('layouts.admin')

@section('contents')

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">投稿用アカウント詳細</span></h4>
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
								<h5 class="card-title">投稿用アカウント作成</h5>
							</div>

							<div class="card-body">
								<p class="mb-4">投稿用アカウントデータの内容を登録してください。</p>

								{{Form::open(['action' => 'App\Http\Controllers\AdminController@accountSave', 'class' => 'form-validate-jquery'])}}
								<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />

									<fieldset class="mb-3">
										<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>


										<!-- Multiple select -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">所属院 <span class="text-danger">*</span>
											</label>
											<div class="col-lg-9">
												<select name="clinic_id" class="form-control" multiple required>
													@foreach ($clinics as $c)
													<option value="{{$c->id}}" {{ old("clinic_id") == $c->id || !empty($data["clinic_id"]) ? $data["clinic_id"] == $c->id  ? 'selected' : '' : null}} >{{$c->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<!-- /multiple select -->

										<!-- Basic text input -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">投稿用アカウント名 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="name" class="form-control required" required placeholder="アカウント名をご入力ください"
												value="{{ old('name' , !empty($data['name']) ? $data['name'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">投稿用ログインID <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="username" class="form-control" required placeholder="半角英数でご入力ください"
												value="{{ old('username' ,!empty($data['username']) ? $data['username'] : null ) }}">
											</div>
										</div>
										<!-- /basic text input -->


										<!-- Password field -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">投稿用パスワード <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="password" name="password" id="password" class="form-control" required placeholder="8文字以上でご入力ください" value="{{ old('password') }}">
											</div>
										</div>
										<!-- /password field -->


										<!-- Repeat password -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">投稿用パスワード確認 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="password" name="repeat_password" class="form-control" required placeholder="パスワード再入力"
												 value="{{ old('repeat_password') }}">
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
