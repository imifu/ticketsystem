@if(!empty(CLINIC_ID))
<?php exit; ?>
@endif

@extends('layouts.admin')

@section('contents')

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">院情報詳細</span></h4>
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
								<h5 class="card-title">院情報</h5>
							</div>

							<div class="card-body">
								<p class="mb-4">院の情報を登録してください。ここでのデータは<a href="./ドクター.html">ドクターデータの登録</a>に使用されます。</p>

									{{Form::open(['action' => 'App\Http\Controllers\AdminController@clinicSave', 'class' => 'form-validate-jquery'])}}

									<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
									<fieldset class="mb-3">
										<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>


										<!-- Basic text input -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">クリニック名 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="name" class="form-control required" required placeholder="クリニック名をご入力ください" value="{{ old('name' , !empty($data['name']) ? $data['name'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">予約受付時間 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="reserve_time" class="form-control required" required placeholder="予約受付時間をご入力ください" value="{{ old('reserve_time' , !empty($data['reserve_time']) ? $data['reserve_time'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">診療受付時間 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="open_time" class="form-control required" required placeholder="診療受付時間をご入力ください" value="{{ old('open_time' , !empty($data['open_time']) ? $data['open_time'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">電話番号 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="tel" class="form-control required" required placeholder="電話番号をご入力ください" value="{{ old('tel' , !empty($data['tel']) ? $data['tel'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">所在地</label>
											<div class="col-lg-9">
												<input type="text" name="address" class="form-control required" required placeholder="所在地をご入力ください" value="{{ old('address' , !empty($data['address']) ? $data['address'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">最寄り駅からのアクセス</label>
											<div class="col-lg-9">
												<input type="text" name="access" class="form-control required" required placeholder="最寄り駅からのアクセスをご入力ください" value="{{ old('access' , !empty($data['access']) ? $data['access'] : null ) }}">
											</div>
										</div>
										<!-- /basic text input -->

										<!-- URL validation -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">GoogleマップURL</label>
											<div class="col-lg-9">
												<input type="text" name="gmap_url" class="form-control url" required placeholder="https://www.google.co.jp/maps/" value="{{ old('gmap_url' , !empty($data['gmap_url']) ? $data['gmap_url'] : null ) }}">
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
