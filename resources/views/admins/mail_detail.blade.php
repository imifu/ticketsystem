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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">メール詳細</span></h4>
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
                    <h5 class="card-title">メール作成</h5>
                </div>

                <div class="card-body">
                    <p class="mb-4">メールデータの内容を登録してください。</p>


                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="card-body alert alert-danger mb-10">{{$error}}</div>
                    @endforeach
                    @endif

                    <form action="{{ route('admin.mailSave') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
                        <fieldset class="mb-3">
                            <legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

                            <!-- Basic text input -->
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">件名 <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="title" class="form-control required" required placeholder="タイトルをご入力ください" value="{{ old('title' , !empty($data['title']) ? $data['title'] : null ) }}">
                                </div>
                            </div>
                            <!-- /basic text input -->

                            <!-- Repeat password -->
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">メール本文(HTML可) <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="message" id="message" class="form-control" cols="30" rows="10">{{ old('id' , !empty($data['message']) ? $data['message'] : null ) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">送信時間<span class="text-danger">*</span></label>
                                <div class="col-lg-2">
                                    <input type="text" id="send_time" name="send_time" class="form-control required" required placeholder="表示開始時間" value="{{ old('send_time' , !empty($data['send_time']) ? $data['send_time'] : null ) }}">
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


    <script>
        $(function() {
            $("#send_time").datetimepicker({
                format: 'Y-m-d H:i:00'
            });
        });
    </script>
    @endsection
