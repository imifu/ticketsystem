@if(!empty(CLINIC_ID))
<?php exit; ?>
@endif

@extends('layouts.admin')

@section('contents')

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ドクター情報詳細</span></h4>
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
								<h5 class="card-title">ドクター情報</h5>
							</div>

							<div class="card-body">
								<p class="mb-4">ドクターの情報を登録してください。所属院の選択は<a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/clinics/">医院一覧に登録</a>された医院のみ選択可能です。</p>

								{{Form::open(['action' => 'App\Http\Controllers\AdminController@doctorSave', 'class' => 'form-validate-jquery', 'enctype' => 'multipart/form-data'])}}
								<form class="form-validate-jquery" action="#">
									<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
									<fieldset class="mb-3">
										<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>


										<!-- Basic text input -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">ドクター名 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="name" class="form-control required"
												required placeholder="ドクター名をご入力ください"
												value="{{ old('name' , !empty($data['name']) ? $data['name'] : null ) }}">
											</div>
										</div>
										<!-- /basic text input -->

										<!-- Inline checkbox group -->
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">所属院 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												@foreach ($clinics as $c)
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="checkbox" name="clinic_id[{{$c->id}}]"
														value="{{$c->id}}" {{ old("clinic_id") === "1" || in_array($c->id, $handlings) ? 'checked="checked"' : '' }} />　{{$c->name}}
													</label>
												</div>
												@endforeach
											</div>
										</div>
										<!-- /inline checkbox group -->

										<!-- Basic file uploader -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">画像 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="file" name="main_image_up" class="form-control" <?php if(empty($data["main_image"])) { ?>required <?php } ?>>
												<?php if(!empty($data["main_image"])) { ?>
													<img src="{{url('/')}}/img/doctor/{{ $data['main_image'] }}" style="margin-top:20px; max-width:50px;"/>
													<input type="hidden" name="main_image" value="{{$data['main_image']}}" />
												<?php } ?>
											</div>
										</div>
										<!-- /basic file uploader -->

										<!-- Basic textarea -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">ドクターのコメント</label>
											<div class="col-lg-9">
												<textarea rows="5" cols="5" name="comment" class="form-control" required placeholder="ドクターのコメントを入力してください">{{ old('comment' , !empty($data['comment']) ? $data['comment'] : null ) }}</textarea>
											</div>
										</div>
										<!-- /basic textarea -->

										<!-- URL validation -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">症例写真URL</label>
											<div class="col-lg-9">
												<input type="text" name="photo_url" class="form-control" required placeholder="https://" value="{{ old('photo_url' , !empty($data['photo_url']) ? $data['photo_url'] : null ) }}">
											</div>
										</div>
										<!-- /url validation -->

										<!-- URL validation -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">プロフィールページURL</label>
											<div class="col-lg-9">
												<input type="text" name="profile_url" class="form-control" required placeholder="https://" value="{{ old('profile_url' , !empty($data['profile_url']) ? $data['profile_url'] : null ) }}">
											</div>
										</div>
										<!-- /url validation -->

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
