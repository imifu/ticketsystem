@extends('layouts.admin')

@section('contents')

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">モニター記事一覧</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					{{Form::open(['action' => 'App\Http\Controllers\AdminController@monitors', 'id' => '', 'class' => '', 'enctype' => '', 'method' => 'get'])}}
					<div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">
						<div class="btn-group">
							<div class="input-group">
								<input type="text" name="search" class="form-control" placeholder="検索">

								<span class="input-group-append search_start">
									<span class="input-group-text"><i class="icon-search4"></i></span>
								</span>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
			<!-- /page header -->

			<script>
			$(".search_start").click(function() {
					$(this).parents('form').submit();
			});

			</script>

			<div class="card">
				<div class="card-body">
					<p class="mb-4">モニター記事の情報を登録してください。投稿用アカウントからは<strong>24時間に2回の投稿まで</strong>行う事が可能です。<br />
					限度数に達した状態でも投稿済みの記事を編集する事は可能です。編集を行っても表示の順番に影響は与えません。</p>

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
											<th>記事ID</th>
											<th>投稿院</th>
											<th>タイトル</th>
											<th>ステータス</th>
											<th>記事作成日</th>
											<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
										</tr>
									</thead>
									<tbody>
										@if (!empty($error))
										<tr>
											<td colspan="5">
											<div class="card-body alert alert-danger mb-10">{{$error}}</div>
										</td>
										@endif

										@foreach ($datas as $data)
										<tr>
											<td>
												<span class="text-default font-weight-semibold">{{$data->id}}</span>
											</td>
											<td><span class="text-default font-weight-semibold">{{$data->clinic_name}}</span></td>
											<td><span class="text-default font-weight-semibold">{{$data->title}}</span></td>
											<td><span class="text-muted">@if($data->post_status == 0) 公開 @else 下書き @endif</span></td>
											<td><span class="text-muted">{{ $data->created_at }}</span></td>
											<td class="text-center">
												<div class="list-icons">
													<div class="dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/monitor/{{ $data->id }}" class="dropdown-item"><i class="icon-pencil5"></i> 編集</a>
															<a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/showPreview/{{ $data->id }}" target="_blank" class="dropdown-item"><i class="icon-file-eye"></i> プレビュー</a>
															<div class="dropdown-divider"></div>
															<a href="{{url('/')}}/{{config('const.ADMIN_URL')}}/monitorDelete/{{ $data->id }}" onclick="return confirm('削除しますか？');" class="dropdown-item text-danger"><i class="icon-trash"></i> 削除</a>
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

					</div>
			</div>


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
