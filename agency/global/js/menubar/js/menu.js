$.menu = function(){
	$('#menu li').each(function() {
	   $(this).mouseover(function(e){
		  $(this).addClass('hover');
	   });

	   $(this).mouseout(function(e){
		    $(this).removeClass('hover');
	   });

	   var offsetWidth  = 0;

	   $('#menu ul li').each(function(e) {
		  offsetWidth = (offsetWidth >=  this.offsetWidth) ? offsetWidth :  this.offsetWidth;
	   });

	   $('#menu ul li').each(function(e) {
		  $(this).css({width:offsetWidth+'px'});
	   });
	   
	 /*  $('ul#menu ul li ul li ul').each(function(e) {
		  offsetWidth = (offsetWidth >=  this.offsetWidth) ? offsetWidth :  this.offsetWidth;
	   });
	   
	   $('ul#menu ul li ul li ul').each(function(e) {
		  $(this).css({width:offsetWidth+'px'});
	   });*/


	});

}
