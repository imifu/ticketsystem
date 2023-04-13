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

});