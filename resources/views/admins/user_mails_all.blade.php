@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">メールの一覧</span></h4>
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
                            @csrf
                            <tr>
                                <th>ID</th>
                                <th>会員名</th>
                                <th>送信メール</th>
                                <th>送信先メールアドレス</th>
                                <th>送信予定時間</th>
                                <th>送信済/未送信</th>
                                <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>
                                    <span class="text-default font-weight-semibold">{{ $data->user_mail_id }}</span>
                                </td>
                                <td><span class=" text-default font-weight-semibold">{{ $data->last_name }} {{ $data->first_name }}</span>
                                </td>
                                <td><span class="text-default font-weight-semibold">{{ $data->title }}</span></td>
                                <td><span class="text-default font-weight-semibold">{{ $data->email }}</span></td>
                                <td><span class="text-default font-weight-semibold">{{ $data->send_time }}</span></td>
                                <td><span class="text-default font-weight-semibold">{{ config('flg.send_flg.'.$data->send_flg) }}</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('admin.user_mail_delete', ['id' => $data->user_mail_id] ); }}" onclick="return confirm('削除しますか？');" class="dropdown-item text-danger">
                                                    <i class="icon-trash"></i> データ削除</a>
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
