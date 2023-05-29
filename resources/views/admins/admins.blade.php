
@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">管理者アカウント一覧</span></h4>
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
                <th>管理者名</th>
                <th>メールアドレス</th>
                <th>種別</th>
                <th>作成日</th>
                <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datas as $data)
              <tr>
                <td>
                  <span class="text-default font-weight-semibold">{{ $data->id }}</span>
                </td>
                <td><span class="text-default font-weight-semibold">{{ $data->name }}</span></td>
                <td><span class="text-default font-weight-semibold">{{ $data->email }}</span></td>
                <td><span class="text-default font-weight-semibold">{{ config('flg.ADMIN_FLG.'.$data->admin_flg) }}</span></td>
                <td><span class="text-default font-weight-semibold">{{ $data->created_at }}</span></td>
                <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
                      <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('admin.detail', ['id' => $data->id] ); }}" class="dropdown-item"><i class="icon-pencil5"></i> 編集</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.delete', ['id' => $data->id] ); }}" onclick="return confirm('削除しますか？');" class="dropdown-item text-danger"><i class="icon-trash"></i> アカウント削除</a>
                      </div>
                    </div>
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
