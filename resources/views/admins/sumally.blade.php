
@extends('layouts.admin')

@section('contents')



<!-- Page header -->
<div class="page-header">

	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">来場者　サマリー</span></h4>
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

            @if (session('msg'))
            <div class="col-lg-12">
                <div class="alert alert-success border-0 alert-dismissible fade show">
                    <span class="fw-semibold">{{ session('msg') }}</span>
                </div>
            </div>
            @endif

			<!-- Form validation -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">来場者　サマリー</h5>
				</div>

				<div class="card-body">
                    <form action="{{ route('admin.sumallySearch') }}" enctype="multipart/form-data" method="POST">
						@csrf
						<fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">データ検索</legend>

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">対象チケット<span class="text-danger">*</span></label>
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
							<button type="submit" class="btn btn-primary ml-3">照会 <i class="icon-checkmark-circle ml-2"></i></button>
						</div>
                    </form>


                    
				</div>
			</div>
			<!-- /form validation -->

            @php $total_amount = 0; @endphp

            @if(!empty($datas))
            <div class="card">
                <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th>購入ID</th>
                        <th>会員名</th>
                        <th>購入チケット</th>
                        <th>メールアドレス</th>
                        <th>座席</th>
                        <th>金額</th>
                        <th>来場</th>
                        <th>購入日</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total_amount = 0; @endphp

                    @foreach ($datas as $data)

                        @php $total_amount += $data->amount; @endphp

                    <tr>
                      <td><span class="text-default font-weight-semibold">{{ $data->user_ticket_id }}</span></td>
                      <td><span class="text-default font-weight-semibold">{{ $data->last_name }} {{ $data->first_name }}</span></td>
                      
                      <td><span class="text-default font-weight-semibold">{{ $data->title }}</span></td>
                      <td><span class="text-default font-weight-semibold">{{ $data->email }}</span></td>
                      <td><span class="text-default font-weight-semibold">{{ $data->seat }}</span></td>
                      <td><span class="text-default font-weight-semibold">{{ number_format($data->amount) }} 円</span></td>
                      <td><span class="text-default font-weight-semibold come_flg{{ $data->come_flg }}">{{ config('flg.COME_FLG.'.$data->come_flg); }}</span></td>
                      <td><span class="text-default font-weight-semibold">{{ date("Y/m/d H:i:s", strtotime($data->user_ticket_created_at)) }}</span></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right">合計</td>
                        <td><span class="text-default font-weight-semibold">{{ number_format($total_amount) }} 円</span></td>
                    </tr>
                    </tbody>
                </table>
              </div>
            </div>
		</div>


        @endif

             <!-- /marketing campaigns -->
      <div class="dataTables_paginate paging_simple_numbers">
				@if($datas->currentPage() != 1)
				<a class="paginate_button previous" href="{{ $datas->previousPageUrl() }}">←</a>
				@endif

				<span>

					@for ($i = 1; $i <= $datas->lastPage(); $i++)
					<a class="paginate_button @if($datas->currentPage() == $i) current @endif" href="{{ $datas->url($i) }}">{{ $i }}</a>
					@endfor

				</span>
					@if($datas->hasMorePages())
					<a class="paginate_button next" href="{{ $datas->nextPageUrl() }}">→</a>
					@endif
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