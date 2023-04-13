
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

			<!-- Form validation -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">販売チケット作成</h5>
				</div>

				<div class="card-body">
					<p class="mb-4">販売チケットデータの内容</p>
					

					@if ($errors->any())
						@foreach ($errors->all() as $error)
						<div class="card-body alert alert-danger mb-10">{{$error}}</div>
						@endforeach
					@endif

					<form action="{{ route('admin.ticketSave') }}" enctype="multipart/form-data" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{ old('id' , !empty($data['id']) ? $data['id'] : null ) }}" />
						<fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">チケットタイトル <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="title" class="form-control" required placeholder="チケットタイトルをご入力ください" value="{{ old('title') ? old('title') : null }}{{ !empty($data['title']) ? $data['title'] : null }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">チケット説明文 <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                            <textarea name="ticket_explain" id="ticket_explain" class="form-control" cols="30" rows="10">{{ old('ticket_explain') ? old('ticket_explain') : null }}{{ !empty($data['ticket_explain']) ? $data['ticket_explain'] : null }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">
                                サムネイル画像①<br>推奨サイズ 700px x 312px　<span class="text-danger">*</span>
                            
                            </label>
                            <div class="col-lg-9">
                                <input type="file" name="image" class="form-control">
                                <?php if(!empty($data["image"])) { ?>
                                    <img src="{{ asset($data['image']) }}" style="margin-top:20px; max-width:320px;"/>
                                    <input type="hidden" name="image_old" value="{{$data['image']}}" />
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">サムネイル画像② <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="file" name="image2" class="form-control">
                                <?php if(!empty($data["image2"])) { ?>
                                    <img src="{{ asset($data['image2']) }}" style="margin-top:20px; max-width:320px;"/>
                                    <input type="hidden" name="image_old2" value="{{$data['image2']}}" />
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">サムネイル画像③ <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="file" name="image3" class="form-control">
                                <?php if(!empty($data["image3"])) { ?>
                                    <img src="{{ asset($data['image3']) }}" style="margin-top:20px; max-width:320px;"/>
                                    <input type="hidden" name="image_old3" value="{{$data['image3']}}" />
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">出演アーティスト名 <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="owner_name" class="form-control" required placeholder="出演アーティストをご入力ください" value="{{ old('owner_name') ? old('owner_name') : null }}{{ !empty($data['owner_name']) ? $data['owner_name'] : null }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">ライブ情報 <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="live_name" id="live_name" class="form-control" cols="30" rows="3">{{ old('live_name') ? old('live_name') : null }}{{ !empty($data['live_name']) ? $data['live_name'] : null }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">表示ON/OFF <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="show_flg" value="1" {{ !empty($data['show_flg']) && $data["show_flg"] == "1" ? 'checked' : '' }} />表示ON
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="show_flg" value="2" {{ !empty($data['show_flg']) && $data["show_flg"] == "2" ? 'checked' : '' }} />表示OFF
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">おすすめ表示ON/OFF <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="reco_flg" value="1" {{ !empty($data['reco_flg']) && $data["reco_flg"] == "1" ? 'checked' : '' }} />おすすめON
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="reco_flg" value="2" {{ !empty($data['reco_flg']) && $data["reco_flg"] == "2" ? 'checked' : '' }} />おすすめOFF
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">売り切れフラグ <span class="text-danger">*</span></label>
                            <div class="col-lg-1">
                            <select name="sold_out_flg" class="form-control">
                                <option value="0" {{ old("sold_out_flg") == 0 || (isset($data["sold_out_flg"]) && $data["sold_out_flg"] == 0)? 'selected' : '' }}>販売中</option>
                                <option value="1" {{ old("sold_out_flg") == 1 || (isset($data["sold_out_flg"]) && $data["sold_out_flg"] == 1) ? 'selected' : '' }}>売り切れ</option>
                            </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">チケット情報表示開始～終了時間<span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <input type="text" id="timecale1_f" name="show_from" class="form-control required" required placeholder="表示開始時間" value="{{ old('show_from' , !empty($data['show_from']) ? $data['show_from'] : null ) }}">
                            </div>

                            <div class="col-lg-2">
                                <input type="text" id="timecale1_t" name="show_to" class="form-control required" required placeholder="表示終了時間" value="{{ old('show_to' , !empty($data['show_to']) ? $data['show_to'] : null ) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">販売開始時間～終了時間<span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <input type="text" id="timecale2_f" name="receive_from" class="form-control required" required placeholder="販売開始時間" value="{{ old('receive_from' , !empty($data['receive_from']) ? $data['receive_from'] : null ) }}">
                            </div>

                            <div class="col-lg-2">
                                <input type="text" id="timecale2_t" name="receive_to" class="form-control required" required placeholder="販売終了時間" value="{{ old('receive_to' , !empty($data['receive_to']) ? $data['receive_to'] : null ) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">ライブ会場開場時間～閉場時間<span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <input type="text" id="timecale3_f" name="open_date" class="form-control required" required placeholder="開場時間" value="{{ old('open_date' , !empty($data['open_date']) ? $data['open_date'] : null ) }}">
                            </div>

                            <div class="col-lg-2">
                                <input type="text" id="timecale3_t" name="close_date" class="form-control required" required placeholder="閉場時間" value="{{ old('close_date' , !empty($data['close_date']) ? $data['close_date'] : null ) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">ライブの開催場所 <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="place_name" class="form-control" required placeholder="出演アーティストをご入力ください" value="{{ old('place_name') ? old('place_name') : null }}{{ !empty($data['place_name']) ? $data['place_name'] : null }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">ライブ会場情報 <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="place" id="place" class="form-control" cols="30" rows="10">{{ old('place', !empty($data["place"]) ? $data["place"] : null) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">アクセス情報 <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="access" id="access" class="form-control" cols="30" rows="10">{{ old('access') ? old('access') : null }}{{ !empty($data['access']) ? $data['access'] : null }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">並び順変更(数字を上げると優先表示) <span class="text-danger">*</span></label>
                            <div class="col-lg-1">
                                <input type="number" name="order_num" class="form-control" required placeholder="並び順をご入力ください" value="{{ old('order_num') ? old('order_num') : null }}{{ !empty($data['order_num']) ? $data['order_num'] : 0 }}">
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

<script>

$(function () {
  $("#timecale1_f").datetimepicker(
    {
        format:'Y-m-d H:00:00'
    }
  );
});

$(function () {
  $("#timecale1_t").datetimepicker(
    {
        format:'Y-m-d H:59:59'
    }
  );
});

$(function () {
  $("#timecale2_f").datetimepicker(
    {
        format:'Y-m-d H:00:00'
    }
  );
});
$(function () {
  $("#timecale2_t").datetimepicker(
    {
        format:'Y-m-d H:59:59'
    }
  );
});

$(function () {
  $("#timecale3_f").datetimepicker(
    {
        format:'Y-m-d H:00:00'
    }
  );
});
$(function () {
  $("#timecale3_t").datetimepicker(
    {
        format:'Y-m-d H:59:59'
    }
  );
});


</script>

@endsection
