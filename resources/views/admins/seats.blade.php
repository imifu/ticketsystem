
@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">販売チケット一覧</span></h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
    <div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">
      <div class="btn-group">
        <div class="input-group">
          <!--<input type="text" class="form-control" placeholder="検索">
					<span class="input-group-append">
						<span class="input-group-text"><i class="icon-search4"></i></span>
					</span>-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content pt-0">

  <!-- Main charts -->
  <div class="row">
    <div class="col-xl-12">
      <!-- Marketing campaigns -->
      <div class="card">
        <div class="table-responsive">
          <table class="table text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>チケット名</th>
                <th>アーティスト</th>
                <th>販売 開始時間</th>
                <th>販売状況</th>
                <th class="text-center" style="width: 20px;">座席操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datas as $data)
              <tr>
                <td>
                  <span class="text-default font-weight-semibold">{{ $data->id }}</span>
                </td>
                <td><span class="text-default font-weight-semibold">{{ $data->title }}</span></td>
                <td><span class="text-default font-weight-semibold">{{ $data->owner_name }}</span></td>
                <td><span class="text-default font-weight-semibold">{{ date("Y/m/d H:i", strtotime($data->receive_from)) }}</span></td>
                <td><span class="text-default font-weight-semibold">{{ config('flg.SOLD_OUT.'.$data->sold_out_flg) }}</span></td>
                <td class="text-center">
                  <div>
                    <a href="{{ route('admin.seat', ['ticket_id' => $data->id]) }}" class="btn bg-indigo-300"><i class="icon-statistics mr-2"></i> 座席チケット作成</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
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
</div>
<!-- /content area -->


@endsection
