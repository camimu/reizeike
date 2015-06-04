$(document).ready(function(){
    $('html,body').animate({ scrollTop: 0 }, '1');
});
$(window).load(function(){
    $('html,body').animate({ scrollTop: 0 }, '1');
});


$(function()
{
  $('.contents').hide();

  showIntroSection();
  $(window).resize(onResizeHandler);
});


/* ----------------------------------------------------
 *  リサイズ処理関係
 * ------------------------------------------------- */

function onResizeHandler(event)
{
	var w = $(window).innerWidth();
	var h = $(window).innerHeight();
	$('.wrapper').height(h);
	$('.wrapper header').height(h);
	$('.wrapper .slider').height(h);
	$('.wrapper .slider li').height(h);
}

/* ----------------------------------------------------
 *  イントロセクション処理関係
 * ------------------------------------------------- */

function showIntroSection()
{

	onResizeHandler();
	slidersetup();

	$('.cursor').on('click',function()
	{
		$('.contents').show();
		$('.wrapper').show();
		$(this).fadeOut(100,function(){$(this).remove()});
		
		$('.wrapper .slider li').animate({top:10},850,'easeOutCubic');
		$('.wrapper').animate({height:0},800,'easeOutCubic',function()
		{

/*			$bgIllust.fadeIn(400);
			$searchBox.fadeIn(400);
			$langBox.fadeIn(400);*/
			$(this).remove();
			$('body').css({overflow:'auto'});

		});

  });



}




function slidersetup(){
      $('.bxslider,.bxsliderSp').bxSlider({
        speed: 1500,
        pause: 4000,
        mode:'fade',
        auto:true,
        infiniteLoop:true,
        adaptiveHeight:true,
        controls:false,
        pager: false,
      });
}


