//別ページからのアンカーリンク設定
$(window).on("load",function(e){
  //アンカーリンク取得
  var hash = location.hash;
  //アンカーリンクがあった場合
  if($(hash).length){
    e.preventDefault();
    //ヘッダーの高さ取得
    var headerH = $('#header').height() + 20;
    //IE判別
    var ua = window.navigator.userAgent.toLowerCase();
    var isIE = (ua.indexOf('msie') >= 0 || ua.indexOf('trident') >= 0);
    //IEだった場合
    if (isIE) {
      setTimeout(function(){
        var position = $(hash).offset().top;
        $("html, body").scrollTop(Number(position)-headerH);
      },500);
    //IE以外
    } else {
      //アンカーリンクの位置取得
      var position = $(hash).offset().top;
      //アンカーリンクの位置まで移動
      $("html, body").scrollTop(Number(position)-headerH);
    }
  }
});

// チケット詳細ボタン
$(function(){
  $('.ticket__detail__btn').click(function(){
    $(this).closest('.ticket__wrap').find('.ticket__detail').addClass('active');
    $(this).hide();
    return false;
  });

  $('.ticket__qr__btn').click(function(){
    $(this).closest('.ticket__wrap').find('.ticket__qr').addClass('active');
    $(this).hide();
    return false;
  });

});

// スムーススクロール
$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href === "#" || href === "" ? 'html' : href);
    var headerH = $('#header').height() + 40;
    // var headerH = 0;
    var position = target.offset().top - headerH;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});

// スライダー
$(function(){
  var slider = $('.slider');
  if($('.slider .slider__item').length>1){
    slider.slick({
      autoplay: true,
      infinite: true,
      arrows: false,
      dots: true,
      slidesToShow: 1,
      variableWidth: true,
      centerMode: true,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            variableWidth: false,
            centerMode: false,
          }
        }
      ]
    });
  }
});