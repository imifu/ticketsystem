
@extends('layouts.admin')

@section('contents')


<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">売上データの照会</span></h4>
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
					<h5 class="card-title">売上データ照会</h5>
				</div>

				<div class="card-body">
                    <form action="{{ route('admin.paymentSearch') }}" enctype="multipart/form-data" method="GET">
						@csrf
						<fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">データ検索</legend>

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">照会範囲（From～To） <span class="text-danger">*</span></label>
                            <div class="col-lg-3">
                                <input type="date" name="from_date" class="form-control" required placeholder="日付FROM" value="{{ old('from_date') ? old('titlfrom_datee') : null }}">
                            </div>
                            <div class="col-lg-3">
                                <input type="date" name="to_date" class="form-control" required placeholder="日付TO" value="{{ old('to_date') ? old('to_date') : null }}">
                            </div>
                        </div>
						<div class="d-flex justify-content-end align-items-center">
							<button type="submit" class="btn btn-primary ml-3">検索 <i class="icon-checkmark-circle ml-2"></i></button>
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
                        <th>ID</th>
                        <th>チケット名</th>
                        <th>座席チケット名</th>
                        <th>支払い方法</th>
                        <th>金額</th>
                        <th>決済日</th>
                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($datas as $data)

                        @php $total_amount += $data->amount; @endphp

                    <tr>
                        <td>
                        <span class="text-default font-weight-semibold">{{ $data->id }}</span>
                        </td>
                        <td><span class="text-default font-weight-semibold">{{ $data->title }}</span></td>
                        <td><span class="text-default font-weight-semibold">{{ $data->ticket_name }}</span></td>
                        <td><span class="text-default font-weight-semibold">{{ config('payment_flg.'.$data->payment_flg) }}</span></td>
                        <td><span class="text-default font-weight-semibold">{{ number_format($data->amount) }} 円</span></td>
                        <td><span class="text-default font-weight-semibold">{{ $data->payment_date }}</span></td>

                        <!--
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
                        -->
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
