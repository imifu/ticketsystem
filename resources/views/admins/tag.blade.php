@if(!empty(CLINIC_ID))
<?php exit; ?>
@endif

@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">タグ詳細</span></h4>
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
					<h5 class="card-title">タグ作成</h5>
				</div>

				<div class="card-body">
					<p class="mb-4">タグデータの内容を登録してください。</p>

					{{Form::open(['action' => 'App\Http\Controllers\AdminController@tagSave', 'class' => 'form-validate-jquery'])}}
					<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
						<fieldset class="mb-3">
							<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

							<!-- Basic text input -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">タグ <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="name" class="form-control required" required placeholder="タグをご入力ください" value="{{ old('name' , !empty($data['name']) ? $data['name'] : null ) }}">
								</div>
							</div>
							<!-- /basic text input -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">タグの種類 <span class="text-danger">*</span></label>
								<div class="col-lg-9">
										<select name="tag_type" class="form-control">

											<?php
											if(empty($data)) {
												$data = array();
												$data["tag_type"] = null;
											}

											 ?>
												<option value="0" {{ old("tag_type") == 0 || $data["tag_type"] == 0 ? 'selected' : '' }}>設定①(効果)</option>
												<option value="1" {{ old("tag_type") == 1 || $data["tag_type"] == 1 ? 'selected' : '' }}>設定②(施術内容)</option>
										</select>
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
