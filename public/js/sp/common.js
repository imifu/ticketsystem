/* ===========================================
common.js
ver 2.0.1
lastUpdate 2014-12-10
=========================================== */
$(document).ready(function(){

/* smoothScroll
------------------------------------- */
jQuery.easing.quart = function(x, t, b, c, d){
	return -c * ((t=t/d-1)*t*t*t - 1) + b;
};
$('a[href*=#]').click(function(){
	if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname){
		var $target = $(this.hash);
		$target = $target.length && $target || $('[name='+this.hash.slice(1)+']');
		if($target.length){
			var targetOffset = $target.offset().top;
			var targetTag = navigator.appName.match(/Opera/)? "html" : "html,body";
			$(targetTag).animate({scrollTop: targetOffset}, 'quart');
			return false;
		}
	}
});

/* toggleNav
------------------------------------- */
var displayH = $(window).height();
var navH = (displayH - 50) + 'px';
$('#nav-clinic,#nav-treat').css('height', navH);
// #nav-clinic
$('#open-clinic,#close-clinic').click(function(){
	// if clinic close
	if($('#nav-clinic').css('display') == 'none'){
		$('#nav-clinic').slideDown('slow');
		$('#open-clinic').addClass('open');
		$('#mainImg,.btnContact,#contents,#gFooter').addClass('disnon');
		// if treat close
		$('#nav-treat').hide();
		$('#open-treat').removeClass('open');
	// if clinic open
	} else {
		$('#nav-clinic').slideUp('slow');
		$('#open-clinic').removeClass('open');
		$('#mainImg,.btnContact,#contents,#gFooter').removeClass('disnon');
	}
});
// #nav-treat
$('#open-treat,#close-treat').click(function(){
	// if clinic close
	if($('#nav-treat').css('display') == 'none'){
		$('#nav-treat').slideDown('slow');
		$('#open-treat').addClass('open');
		$('#mainImg,.btnContact,#contents,#gFooter').addClass('disnon')
		// if clinic close
		$('#nav-clinic').hide();
		$('#open-clinic').removeClass('open');
	// if clinic open
	} else {
		$('#nav-treat').slideUp('slow');
		$('#open-treat').removeClass('open');
		$('#mainImg,.btnContact,#contents,#gFooter').removeClass('disnon');
	}
});

/* toggleContent
------------------------------------- */
if($('.toggle-content').length){
	$('.toggle-content').hide();
	$('.toggle-open').click(function(){
		$(this).toggleClass('open');
		$(this).next('.toggle-content').slideToggle();
	});
}


/* jsTabs
----------------------------------- */
if($("#js-tabs").length) {
	$('#js-tabs li').click(function() {
		//num set
		var num = $('#js-tabs li').index(this);
	
		//class="active" set in contents
		$('.js-content').removeClass('active');
		$('.js-content').eq(num).addClass('active');
	
		//class="active" set in tabs
		$('#js-tabs li').removeClass('active');
		$(this).addClass('active');
	});
}

});