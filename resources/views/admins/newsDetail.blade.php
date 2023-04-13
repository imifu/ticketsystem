
@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">お知らせ詳細</span></h4>
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
					<h5 class="card-title">お知らせ作成</h5>
				</div>

				<div class="card-body">
					<p class="mb-4">お知らせデータの内容を登録してください。</p>
					

					@if ($errors->any())
						@foreach ($errors->all() as $error)
						<div class="card-body alert alert-danger mb-10">{{$error}}</div>
						@endforeach
					@endif

					<form action="{{ route('admin.newsSave') }}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
						<fieldset class="mb-3">
							<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

							<!-- Basic text input -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">タイトル <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="title" class="form-control required" required placeholder="タイトルをご入力ください" value="{{ old('title' , !empty($data['title']) ? $data['title'] : null ) }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">重要トップ表示ON/OFF <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="reco_flg" value="0" {{ empty($data['reco_flg']) ? 'checked' : '' }} />無効</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="reco_flg" value="1" {{ !empty($data['reco_flg']) ? 'checked' : '' }} />有効</label>
									</div>
								</div>
							</div>

							
							<!-- /basic text input -->


							<!-- Password field -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">見出し <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="header_text" class="form-control required" required placeholder="見出しをご入力ください" value="{{ old('header_text' , !empty($data['header_text']) ? $data['header_text'] : null ) }}">
								</div>
							</div>
							<!-- /password field -->


							<!-- Repeat password -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">お知らせ本文(HTML可) <span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<textarea name="detail" id="detail" class="form-control" cols="30" rows="10">{{ old('id' , !empty($data['detail']) ? $data['detail'] : null ) }}</textarea>
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
