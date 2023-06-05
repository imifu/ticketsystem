@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">メール送信先一覧</span></h4>
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


            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">会員データ照会</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.users') }}" enctype="multipart/form-data" method="GET">
                        @csrf
                        <fieldset class="mb-3">
                            <legend class="text-uppercase font-size-sm font-weight-bold">データ検索</legend>

                            <!-- Basic text input -->
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">名前（曖昧検索）</label>
                                <div class="col-lg-3">
                                    <input type="text" name="name" class="form-control" placeholder="名前や名字" value="{{ !empty($param['name']) ? $param['name'] : null }}">
                                </div>
                                <label class="col-form-label col-lg-2">メールアドレス（曖昧検索）</label>
                                <div class="col-lg-3">
                                    <input type="text" name="email" class="form-control" placeholder="メールアドレス" value="{{ !empty($param['email']) ? $param['email'] : null }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary ml-3">検索 <i class="icon-checkmark-circle ml-2"></i></button>
                            </div>
                    </form>



                </div>
            </div>


            <!-- Marketing campaigns -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>送信対象</th>
                                <th>ID</th>
                                <th>会員名</th>
                                <th>メールアドレス</th>
                                <th>入会日</th>
                                <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(!empty($datas))

                            @foreach ($datas as $data)
                            <form action="{{ route('admin.mail_send_choose') }}" method="POST">
                                @csrf
                                <tr>

                                    <td>
                                        <label>
                                            <input type="checkbox" name="user_mails[]" class="form-checkbox" value="{{ $data['id'] }}" checked />
                                            選択
                                        </label>

                                    </td>
                                    <td>
                                        <span class="text-default font-weight-semibold">{{ $data->id }}</span>
                                    </td>
                                    <td><span class=" text-default font-weight-semibold">{{ $data->last_name }} {{ $data->first_name }}</span>
                                    </td>
                                    <td><span class="text-default font-weight-semibold">{{ $data->email }}</span></td>
                                    <td><span class="text-muted">{{ $data->created_at }}</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{ route('admin.user', ['id' => $data->id] ); }}" class="dropdown-item"><i class="icon-pencil5"></i> 編集</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="{{ route('admin.userDelete', ['id' => $data->id] ); }}" onclick="return confirm('削除しますか？');" class="dropdown-item text-danger">
                                                        <i class="icon-trash"></i> データ削除</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <tr>

                                    <td colspan="6">
                                        <button type="submit" class="btn btn-primary">送信先として決定する <i class="ph-paper-plane-tilt ms-2"></i></button>
                                    </td>

                                </tr>

                                @endif
                                </from>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /marketing campaigns -->
        </div>
    </div>
    <!-- /content area -->


    @endsection
