@extends('layouts.admin')

@section('contents')



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('/froala/css/froala_editor.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/froala_style.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/code_view.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/draggable.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/colors.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/emoticons.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/image_manager.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/image.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/line_breaker.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/table.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/char_counter.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/video.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/fullscreen.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/file.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/quick_insert.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/help.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/third_party/spell_checker.css') }}">
<link rel="stylesheet" href="{{ asset('/froala/css/plugins/special_characters.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">


			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">モニター記事詳細</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->
			@if ($errors->any())
						<div class="alert alert-danger">
								<ul>
										@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
										@endforeach
								</ul>
						</div>
				@endif
			<!-- Content area -->
			<div class="content pt-0">

				<!-- Main charts -->
				<div class="row">
					<div class="col-xl-12">
						@if ($errors->any())
									<div class="alert alert-danger">
											<ul>
													@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
													@endforeach
											</ul>
									</div>
							@endif
						<!-- Form validation -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">モニター記事</h5>
							</div>

							<div class="card-body">
								<p class="mb-4">モニター記事の情報を登録してください。投稿用アカウントからは<strong>24時間に2回の投稿まで</strong>行う事が可能です。<br />
								限度数に達した状態でも投稿済みの記事を編集する事は可能です。編集を行っても表示の順番に影響は与えません。</p>

								{{Form::open(['action' => 'App\Http\Controllers\AdminController@monitorSave', 'id' => 'monitor_form', 'class' => 'form-validate-jquery', 'enctype' => 'multipart/form-data'])}}
								<input type="hidden" name="del_flg" value="0" />
								<input type="hidden" name="id" value="{{ old('id'  , !empty($data['id']) ? $data['id'] : null ) }}" />
									<fieldset class="mb-3">
										<legend class="text-uppercase font-size-sm font-weight-bold">データ内容</legend>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">投稿ステータス <span class="text-danger">*</span></label>
											<div class="col-lg-9">
											<select name="post_status" class="form-control">
																				<?php  if(empty($data)) { $data["post_status"] = null; }?>
												<option value="0" {{ old("post_status") == 0 || $data["post_status"] == 0 ? 'selected' : '' }}>公開</option>
												<option value="1" {{ old("post_status") == 1 || $data["post_status"] == 1 ? 'selected' : '' }}>下書き</option>
											</select>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">公開日 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="date" name="start_date" required placeholder="公開日をご入力ください"
												value="{{ old('start_date' , !empty($data['start_date']) ? $data['start_date'] : null ) }}">
											</div>
										</div>


										<!-- Basic text input -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">タイトル <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="title" class="form-control required" required placeholder="タイトルをご入力ください"
												value="{{ old('title' , !empty($data['title']) ? $data['title'] : null) }}">
											</div>
										</div>
										<!-- /basic text input -->

										<!-- Multiple select -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">
													担当ドクター <span class="text-danger">*</span>
											</label>
											<div class="col-lg-9">
												<select name="doctor_id" class="form-control" multiple required>

													<?php  if(empty($data) || empty($data["doctor_id"])) { $data["doctor_id"] = "";} ?>

													@foreach ($doctors as $d)
													<option value="{{$d->doctor_id}}" {{ old("doctor_id") == $d->doctor_id || !empty($data["doctor_id"]) ? $data["doctor_id"] == $d->doctor_id ? 'selected' : '' : '' }} >{{$d->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<!-- /multiple select -->

										<!-- Multiple select -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">募集院 <span class="text-danger">*</span>
											</label>
											<div class="col-lg-9">
												<select name="clinic_id" class="form-control" multiple required>
													<?php  if(empty($data) || empty($data["clinic_id"])) { $data["clinic_id"] = "";} ?>

													@foreach ($clinics as $c)
													<option value="{{$c->id}}" {{ old("clinic_id") == $c->id || !empty($Data["clinic_id"]) ? $data["clinic_id"] == $c->id  ? 'selected' : '' : '' }} >{{$c->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<!-- /multiple select -->
										<!-- Basic select -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">診療内容 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<select name="genre" class="form-control" required>
													<?php  if(empty($data) || empty($data["genre"])) { $data["genre"] = "";} ?>

													<optgroup label="お顔">
														<option value="二重・目もと・まぶた" {{ old("genre") == "二重・目もと・まぶた" || $data["genre"] == "二重・目もと・まぶた" ? 'selected' : '' }}>二重・目もと・まぶた</option>
														<option value="プチ整形・プチシワ取り"  {{ old("genre") == "プチ整形・プチシワ取り" || $data["genre"] == "プチ整形・プチシワ取り" ? 'selected' : '' }} >プチ整形・プチシワ取り</option>
														<option value="小顔・顔痩せ"  {{ old("genre") == "小顔・顔痩せ" || $data["genre"] == "小顔・顔痩せ" ? 'selected' : '' }} >小顔・顔痩せ</option>
														<option value="若返り・エイジングケア"  {{ old("genre") == "若返り・エイジングケア" || $data["genre"] == "若返り・エイジングケア" ? 'selected' : '' }} >若返り・エイジングケア</option>
														<option value="鼻の整形（鼻を高く・小さく）"  {{ old("genre") == "鼻の整形（鼻を高く・小さく）" || $data["genre"] == "鼻の整形（鼻を高く・小さく）" ? 'selected' : '' }} >鼻の整形（鼻を高く・小さく）</option>
														<option value="アゴ・フェイスライン・額"  {{ old("genre") == "アゴ・フェイスライン・額" || $data["genre"] == "アゴ・フェイスライン・額" ? 'selected' : '' }} >アゴ・フェイスライン・額</option>
													</optgroup>
													<optgroup label="お肌">
														<option value="スキンケア"  {{ old("genre") == "スキンケア" || $data["genre"] == "スキンケア" ? 'selected' : '' }} >スキンケア</option>
														<option value="シミ・そばかす・くすみ"  {{ old("genre") == "シミ・そばかす・くすみ" || $data["genre"] == "シミ・そばかす・くすみ" ? 'selected' : '' }} >シミ・そばかす・くすみ</option>
														<option value="シワ・ほうれい線"  {{ old("genre") == "シワ・ほうれい線" || $data["genre"] == "シワ・ほうれい線" ? 'selected' : '' }} >シワ・ほうれい線</option>
														<option value="たるみ"  {{ old("genre") == "たるみ" || $data["genre"] == "たるみ" ? 'selected' : '' }} >たるみ</option>
														<option value="ニキビ・ニキビ跡・毛穴"  {{ old("genre") == "ニキビ・ニキビ跡・毛穴" || $data["genre"] == "ニキビ・ニキビ跡・毛穴" ? 'selected' : '' }} >ニキビ・ニキビ跡・毛穴</option>
														<option value="ほくろ"  {{ old("genre") == "ほくろ" || $data["genre"] == "ほくろ" ? 'selected' : '' }} >ほくろ</option>
													</optgroup>
													<optgroup label="ボディ"  {{ old("genre") == "ボディ" || $data["genre"] == "ボディ" ? 'selected' : '' }} >
														<option value="痩身・部分痩せ"  {{ old("genre") == "痩身・部分痩せ" || $data["genre"] == "痩身・部分痩せ" ? 'selected' : '' }} >痩身・部分痩せ</option>
														<option value="肩こり"  {{ old("genre") == "肩こり" || $data["genre"] == "肩こり" ? 'selected' : '' }} >肩こり</option>
														<option value="ワキガ・多汗症"  {{ old("genre") == "ワキガ・多汗症" || $data["genre"] == "ワキガ・多汗症" ? 'selected' : '' }} >ワキガ・多汗症</option>
													</optgroup>
													<optgroup label="その他">
														<option value="その他"  {{ old("genre") == "その他" || $data["genre"] == "その他" ? 'selected' : '' }} >その他</option>
													</optgroup>
												</select>
											</div>
										</div>
										<!-- /basic select -->

										<!-- Basic text input -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">施術名 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="med_name" class="form-control required" required placeholder="施術名をご入力ください"
												value="{{ old('med_name' , !empty($data['med_name']) ? $data['med_name'] : null ) }}">
											</div>
										</div>
										<!-- /basic text input -->

										<!-- Basic text input -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">施術概要 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="med_explain" class="form-control required" required placeholder="施術概要をご入力ください"
												value="{{ old('med_explain' , !empty($data['med_explain']) ? $data['med_explain'] : null ) }}">
											</div>
										</div>
										<!-- /basic text input -->

										<!-- Basic file uploader -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">メイン画像 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="file" name="image" class="form-control">
													<?php if(!empty($data["image"])) { ?>
														<img src="{{url('/')}}/img/monitor/{{ $data['image'] }}" style="margin-top:20px; max-width:100%;"/>
														<input type="hidden" name="image_old" value="{{$data['image']}}" />
													<?php } ?>

											</div>
										</div>
										<!-- /basic file uploader -->

										<div class="form-group row">
											<label class="col-form-label col-lg-3">募集終了日 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="date" name="end_date" required placeholder="募集終了日をご入力ください"
												value="{{ old('end_date' , !empty($data['end_date']) ? $data['end_date'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">モニター価格下限（税抜き） <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="number" name="monitor_money" class="form-control required" placeholder="モニター価格の下限（税抜き）を半角数字でご入力ください。空の場合は特別価格と表記されます。"
												value="{{ old('monitor_money' , !empty($data['monitor_money']) ? $data['monitor_money'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">モニター価格下限（税込み） <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="number" name="money" class="form-control required" placeholder="モニター価格の下限（税込み）を半角数字でご入力ください。空の場合は特別価格と表記されます。"
												value="{{ old('money' , !empty($data['money']) ? $data['money'] : null ) }}">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-lg-3">モニター価格上限（税込み）</label>
											<div class="col-lg-9">
												<input type="number" name="money_max" class="form-control" placeholder="モニター価格の上限（税込み）を半角数字でご入力ください。空の場合は下限価格もしくは特別価格と表記されます。"
												value="{{ old('money_max' , !empty($data['money_max']) ? $data['money_max'] : null ) }}">
											</div>
										</div>


<!--
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">金額の「～」を表示 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" class="form-check-input" name="money_range" value="0" {{ empty($data['money_range']) ? 'checked' : '' }} />～ を表示しない</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" class="form-check-input" name="money_range" value="1" {{ !empty($data['money_range']) ? 'checked' : '' }} />～ を表示する</label>
												</div>
											</div>
										</div>
-->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">こんなお悩みの方におすすめ</label>
											<div class="col-lg-9">
												<input type="text" name="recommend1" class="form-control" placeholder="こんなお悩みの方におすすめ ①" value="{{ old('recommend1' , !empty($data['recommend1']) ? $data['recommend1'] : null ) }}"><br />
												<input type="text" name="recommend2" class="form-control" placeholder="こんなお悩みの方におすすめ ②" value="{{ old('recommend2' , !empty($data['recommend2']) ? $data['recommend2'] : null ) }}"><br />
												<input type="text" name="recommend3" class="form-control" placeholder="こんなお悩みの方におすすめ ③" value="{{ old('recommend3' , !empty($data['recommend3']) ? $data['recommend3'] : null ) }}"><br />
												<input type="text" name="recommend4" class="form-control" placeholder="こんなお悩みの方におすすめ ④" value="{{ old('recommend4' , !empty($data['recommend4']) ? $data['recommend4'] : null ) }}">
											</div>
										</div>

										<!-- Basic textarea -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">記事内容 <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<textarea id="monitor_main" style="min-height:500px;" rows="20" cols="5" name="contents" class="form-control" required placeholder="記事内容を記述してください">{{ old('contents' , !empty($data['contents']) ? $data['contents'] : null ) }}</textarea>
											</div>
										</div>
										<!-- /basic textarea -->

										<!-- Inline checkbox group -->
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">タグの設定①(効果)</label>
											<div class="col-lg-9">

												<?php  if(empty($data) || empty($data["tag1"])) { $data["tag1"] = "";} ?>

												<?php
												$arr = !empty($tags[0]) ? $tags[0] : array();
												$key = 0;
												foreach($arr as $key => $ar) {
												 ?>
												<div class="form-check form-check-inline">
													<label class="form-check-label"><input type="checkbox" class="form-check-input" name="tag1[{{$key}}]" value="{{$ar}}" {{ ( is_array(old("tag1")) && in_array($ar, old("tag1")) ) || ( is_array($data["tag1"]) && in_array($ar, $data["tag1"]) ) ? 'checked' : '' }} /><?php echo $ar; ?></label>
												</div>
											<?php } ?>
											</div>
										</div>
										<!-- /inline checkbox group -->
										<!-- Inline checkbox group -->
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">タグの設定②(施術内容)</label>
											<div class="col-lg-9">

												<?php  if(empty($data) || empty($data["tag2"])) { $data["tag2"] = "";} ?>

												<?php
												$arr = !empty($tags[1]) ? $tags[1] : array();
												$key = 0;
												foreach($arr as $key => $ar) {
												 ?>
												<div class="form-check form-check-inline">
													<label class="form-check-label"><input type="checkbox" class="form-check-input" name="tag2[{{$key}}]" value="{{$ar}}" {{ ( is_array(old("tag2")) && in_array($ar, old("tag2")) ) || ( is_array($data["tag2"]) && in_array($ar, $data["tag2"]) ) ? 'checked' : '' }} /><?php echo $ar; ?></label>
												</div>
											<?php } ?>
											</div>
										</div>
										<!-- /inline checkbox group -->
										<!-- URL validation -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">予約フォームURL(PC) <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="pc_url" class="form-control" required placeholder="https://" value="{{ old('pc_url' , !empty($data['pc_url']) ? $data['pc_url'] : null ) }}">
											</div>
										</div>
										<!-- /url validation -->

										<!-- URL validation -->
										<div class="form-group row">
											<label class="col-form-label col-lg-3">予約フォームURL(SP) <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" name="sp_url" class="form-control" required placeholder="https://" value="{{ old('sp_url' , !empty($data['sp_url']) ? $data['sp_url'] : null ) }}">
											</div>
										</div>
										<!-- /url validation -->

									<div class="d-flex justify-content-end align-items-center">
										<button type="reset" class="btn btn-light" id="reset">リセット <i class="icon-reload-alt ml-2"></i></button>
										<span name="preview" style="cursor:pointer;" value="preview" class="preview_btn btn btn-danger ml-3">プレビュー <i class="icon-checkmark-circle ml-2"></i></span>
										<button name="preview" type="submit" value="プレビュー" class="hdn_pre" style="display:none;" />
										<button type="submit" class="btn btn-primary ml-3">保存 <i class="icon-checkmark-circle ml-2"></i></button>
									</div>

									<script>
											$(".preview_btn").click(function() {
												$("#monitor_form").attr("target", "_blank");
												$(".hdn_pre").click();
												$("#monitor_form").attr("target", "_self");

											});
									</script>


								</form>
							</div>
						</div>
						<!-- /form validation -->

					</div>
			</div>
			<!-- /content area -->


			<script type="text/javascript"
				src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
			<script type="text/javascript"
				src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

			<script type="text/javascript" src="{{ asset('/froala/js/froala_editor.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/align.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/char_counter.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/code_beautifier.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/code_view.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/colors.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/draggable.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/emoticons.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/entities.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/file.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/font_size.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/font_family.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/fullscreen.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/image.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/image_manager.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/line_breaker.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/inline_style.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/link.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/lists.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/paragraph_format.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/paragraph_style.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/quick_insert.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/quote.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/table.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/save.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/url.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/video.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/help.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/print.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/third_party/spell_checker.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/special_characters.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('/froala/js/plugins/word_paste.min.js') }}"></script>

			<script type="text/javascript" src="{{ asset('/froala/js/languages/ja.js') }}"></script>

			<script>
				(function () {
					new FroalaEditor("#monitor_main", {
						key:"Kb3A3pC3E1B1A4C3J4ogB-16E-13yyC-8H-8lA-21B5B-16pmA-9H3E2J2C4C6C3C2B5B1A1==",
						language: 'ja',
						toolbarButtons: [ 'fullscreen', 'bold', 'italic', 'underline', 'strikeThrough','fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'clearFormatting','paragraphFormat', 'align', 'formatOL'
						, 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'insertTable'
						, '|', 'emoticons', 'fontAwesome', 'specialCharacters', 'insertHR', 'selectAll'
						, '|','help', 'html',
						'|', 'undo', 'redo' ],

						imageUploadURL: '{{url('/')}}/b8HZk2Yvxipupload_imagebackend.php',
					})
				})()
			</script>


@endsection
