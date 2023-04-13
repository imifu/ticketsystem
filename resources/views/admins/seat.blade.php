
@extends('layouts.admin')

@section('contents')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">

<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">販売チケット詳細</span></h4>
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

            @if ($sold_tickets)
            <div class="col-lg-12">
                <div class="alert alert-success border-0 alert-dismissible fade show">
                    <span class="fw-semibold">現在 {{ $sold_tickets }} 枚のチケットが販売済みです</span>
                </div>
            </div>
            @endif

			<!-- Form validation -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">販売チケット作成</h5>
				</div>

				<div class="card-body">

					<p class="mb-4">販売チケットデータの内容</p>

                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">対象ライブチケット</h5>
                            <div class="header-elements">

                            </div>
                        </div>

                        <div class="card-body">
                            以下の<code>ライブ情報</code>についての座席チケットを作成してください.
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>チケット名</th>
                                        <th>アーティスト名</th>
                                        <th>開場時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $ticket_data->id }}</td>
                                        <td>{{ $ticket_data->title }}</td>
                                        <td>{{ $ticket_data->owner_name }}</td>
                                        <td>{{ date("Y/m/d H:i", strtotime($ticket_data->open_date)) }}～</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
				    </div>
					

					@if ($errors->any())
						@foreach ($errors->all() as $error)
						<div class="card-body alert alert-danger mb-10">{{$error}}</div>
						@endforeach
					@endif

					<form action="{{ route('admin.seatSave') }}" enctype="multipart/form-data" method="POST">
						@csrf
                        <input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
						<input type="hidden" name="ticket_id" value="{{ old('ticket_id' , !empty($ticket_data['id']) ? $ticket_data['id'] : null ) }}" />
						<fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">販売チケット名（席名・VIPなど） <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="ticket_name" class="form-control" required placeholder="S席" value="{{ old('ticket_name' , !empty($data['ticket_name']) ? $data['ticket_name'] : null ) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">販売枚数 <span class="text-danger">*</span></label>
                            <div class="col-lg-1">

                                <div class="input-group">
                                    <input type="number" name="ticket_amount" class="form-control" required placeholder="50" value="{{ old('ticket_amount' , !empty($data['ticket_amount']) ? $data['ticket_amount'] : null ) }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-light">枚</button>
                                    </div>
                                </div>
                               
                            </div>

                            @if(!empty($sold_tickets))
                            <div class="col-lg-1">
                                <strong>現在：{{ $sold_tickets }}枚</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">金額 <span class="text-danger">*</span></label>
                            <div class="col-lg-2">

                            <div class="input-group">
                                <input type="number" name="amount" class="form-control" required placeholder="50" value="{{ old('amount' , !empty($data['amount']) ? $data['amount'] : null ) }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light">円</button>
                                </div>
                            </div>
                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">売り切れフラグON/OFF <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="sold_out_flg" value="0" {{ !empty($data['sold_out_flg']) && $data["sold_out_flg"] == "0" ? 'checked' : '' }} />売り切れOFF
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="sold_out_flg" value="1" {{ !empty($data['sold_out_flg']) && $data["sold_out_flg"] == "1" ? 'checked' : '' }} />売り切れON
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- /basic text input -->


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
