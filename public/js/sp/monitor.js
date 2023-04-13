$(function() {
  $('.search_area_li_parent_ttl').click(function() {
    $(this).next('.search_area_ul_child').slideToggle();
  })
  $('.monitor_search_wrap').click(function() {
		$.when(
			$(this).next('.search_area').slideToggle(),
			$(this).next('.search_txt').slideToggle()
		).done(function(){
			console.log("done");
	    $(this).toggleClass('active');
		});
  })

	// ajaxローディング「次の10件を表示」
	// $('#loading').css('display', 'none');
	// $.autopager({
	// 	content : '.monitor_list .monitor_item',// 読み込むコンテンツ
	// 	link : '#more a', // 次ページへのリンク
	// 	autoLoad : false,// スクロールの自動読込み解除

	// 	start : function(current, next) {
	// 		$('#loading').css('display', 'block');
	// 		$('#more a').css('display', 'none');
	// 	},

	// 	load : function(current, next) {
	// 		$('#loading').css('display', 'none');
	// 		$('#more a').css('display', 'block');
	// 	}
	// });

	// $('#more a').click(function() { // 次ページへのリンクボタン
	// 	$.autopager('load'); // 次ページを読み込む
	// 	return false;
	// });

	//
	$(".section01_hd_ttl03").each(function() {
		var txt = $(this).text();
		$(this).text(txt.replace(/9999-12-31 23:59:59/g, "--"));
	});
	if ($('.monitor_map').length) {
		var oldUrl = $('.monitor_map').attr('src');
		var newUrl = oldUrl.replace('http://', 'https://');
		$('.monitor_map').attr({
			'src' : newUrl
		});
	}
});