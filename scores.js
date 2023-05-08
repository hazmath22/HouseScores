$(function(){
	$('.bars li .bari').each(function(key, bari){
		var percentage=$(this).data('percentage');
		$(this).animate({
			'height' : percentage + '%'
			
		},1000);
	});
});
	$(function(){
	$('.bars li .barsir').each(function(key, barsir){
		var percentage=$(this).data('percentage');
		$(this).animate({
			'height' : percentage + '%'
			
		},1000);
	});
});
	$(function(){
	$('.bars li .barj').each(function(key, barj){
		var percentage=$(this).data('percentage');
		$(this).animate({
			'height' : percentage + '%'
			
		},1000);
	});
});