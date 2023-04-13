
@extends('layouts.admin')

@section('contents')


<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">座席管理</span></h4>
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
					<h5 class="card-title">座席を決定したいチケットを選択</h5>
				</div>

				<div class="card-body">
                    <form action="{{ route('admin.enterSeatSearch') }}" enctype="multipart/form-data" method="POST">
						@csrf
						<fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">データ検索</legend>

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">座席管理対象チケット<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="ticket_id" id="" class="form-control">
                                    <option value="">選択してください</option>

                                    @if(!empty($selects))
                                      @foreach($selects as $key => $select)
                                        <option value="{{ $select->id }}">{{ $select->title }}</option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>
						<div class="d-flex justify-content-end align-items-center">
							<button type="submit" class="btn btn-primary ml-3">このチケットの座席を管理するCSVをダウンロード <i class="icon-download ml-2"></i></button>
						</div>
                    </form>


                    
				</div>
			</div>
			<!-- /form validation -->


			<!-- Form validation -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">座席を決定するCSVをアップロード</h5>
				</div>

				<div class="card-body">
                    <form action="{{ route('admin.enterSeatUpload') }}" enctype="multipart/form-data" method="POST">
						@csrf
						<fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">データ検索</legend>

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">座席管理CSV<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="file" name="csv" class="form-control">
                            </div>

                        </div>
						<div class="d-flex justify-content-end align-items-center">
							<button type="submit" class="btn btn-success ml-3">座席を決定するCSVをアップロード <i class="icon-upload ml-2"></i></button>
						</div>
                    </form>


                    
				</div>
			</div>
			<!-- /form validation -->
		</div>


</div>
<!-- /content area -->

<style>

.come_flg1 {
    color: red;
    font-weight: bold;
}
</style>

@endsection