
$(document).ready(function(){ 

	
	/*-- Upper button start  --*/
	$(window).scroll(function(){
		var x = $(window).scrollTop();
		if(x>800){
			$('#upper').fadeIn(1000);
		}else{
			$('#upper').fadeOut(1000);
		}
	
	});
	$('#upper').click(function(){
		$('html').animate({scrollTop: 0},2000);
	});
	
});

	
