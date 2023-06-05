@extends('layouts.admin')

@section('contents')

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">メール送信内容の選択</span></h4>
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
                    <form action=""></form>
                    <table class="table text-nowrap">
                        <tr>
                            <td>
                                <form action="{{ route('admin.user_mails') }}" method="POST">
                                    @csrf
                                    <select name="mail_id" class="form-control">
                                        <option>送信するメール内容を選択してください</option>
                                        @foreach($datas as $key => $data)
                                            <option value="{{ $data->id }}">{{ $data->title }}</option>
                                            @endforeach
                                        </div>
                                    </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <button type="submit" class="btn btn-primary">送信内容の決定 <i class="ph-paper-plane-tilt ms-2"></i></button>
                            </td>
                        </tr>
                        </form>
                        </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /marketing campaigns -->
        </div>
    </div>
    <!-- /content area -->
    @endsection
