var $contentNews,$contentAbout,$contentSummary,$contentGreeting,$contentMember,$contentBooks;

$(document).ready(function(){
    $('html,body').animate({ scrollTop: 0 }, '1');
});
$(window).load(function(){
    $('html,body').animate({ scrollTop: 0 }, '1');
});

$(function()
{
  $contentHeader	= $('.contents header');
  $contentNav	= $('.global-nav');
  $contentNews	= $('.news');
  $contentAbout	= $('.about');
  $contentSummary	= $('.summary');
  $contentGreeting= $('.greeting');
  $contentMember	= $('.member');
  $contentBooks	= $('.books');

	$contentNews.hide();
	$contentAbout.hide();
	$contentSummary.hide();
	$contentGreeting.hide();
	$contentMember.hide();
	$contentBooks.hide();

  initNavFixed();
  initSmoothScroll();

  $('.contents').hide();
  $('.wrapper').hide();
  $('.scroll').hide();

  $('.opening') .css("display","block");
  showOpeningSection();
  $(window).resize(onResizeHandler);

  var viewMode = '';
  viewMode = viewModeCheck();
});


/* ----------------------------------------------------
 *  オープニング関係
 * ------------------------------------------------- */

function showOpeningSection()
{
	var config = {
		"opening": ".opening",
		"element": [".opening h1", ".opening h2", ".opening h3"],
		"speed": 2000,
		"delay": 400,
		"range": 10
	};

	var referrer = document.referrer;
	var host = location.hostname;
	if(!referrer.match(host)) {
		setTimeout(function() {
			for(var i = 0, n = config.element.length; i < n; i++) {
				var $el = $(config.element[i]);
				$(config.element[i]).delay(config.delay*i).animate({
					"opacity": 1
				}, config.speed, "swing");
			}
		}, 1000);

		setTimeout(function() {
			$(config.opening).fadeOut("slow", function() {
				$(this).remove();
        $('.scroll').fadeIn(400);
        $('.container') .css("display","block");
        showIntroSection();
			});
		}, 4000);
	} else {
		$(config.opening).hide();
	}

}

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
	$('.wrapper').show();

	onResizeHandler();
	slidersetup();

	$('.scroll').on('click',function()
	{

		$('.contents').show();
		$('.wrapper').show();

		$(this).fadeOut(100,function(){$(this).remove();});

		$('.container').animate({height:0},800,'easeOutCubic',function()
		{

			$('.wrapper').remove();
			$contentHeader.fadeIn(400);
			$contentNav.fadeIn(400);
			$contentNews.fadeIn(400);
			$contentAbout.fadeIn(400);
			$contentSummary.fadeIn(400);
      	$contentGreeting.fadeIn(400);
      	$contentMember.fadeIn(400);
      	$contentBooks.fadeIn(400);

			$('body').css({overflow:'auto'});

		});

  });

	var mousewheelevent = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';
	$(document).on(mousewheelevent,function(e)
	{
		e.preventDefault();
		var delta = e.originalEvent.deltaY ? -(e.originalEvent.deltaY) : e.originalEvent.wheelDelta ? e.originalEvent.wheelDelta : -(e.originalEvent.detail);
		if (delta < 0) //下にスクロールした時
		{
			$('.scroll').trigger('click');
			$(document).off(mousewheelevent);
		}
		else //上にスクロールした時
		{}
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

/* ----------------------------------------------------
 *  Smooth Scroll
 * ------------------------------------------------- */

function initSmoothScroll(){
  initNavFixed();
	$("a[href^='#']").bind('click', function(event){
		if(event){ event.preventDefault(); }else if(window.event){ window.event.returnValue = false; }
		var targetId = $(this).attr('href');
		var pos = $(targetId).offset();
		var ty = Math.min(pos.top, ($(document).height() - $(window).height()));
		$('html,body').animate({ scrollTop: ty - 70 }, 1000, 'easeOutExpo');
	});
}

/* ----------------------------------------------------
 *  Navigation Fixed
 * ------------------------------------------------- */

function initNavFixed(){
    var nav = $('.global-nav');
    //表示位置
    var navTop = nav.offset().top+500;
    //ナビゲーションの高さ（シャドウの分だけ足してます）
    var navHeight = nav.height()+10;
    var showFlag = false;
    nav.css('top', -navHeight+'px');
    //ナビゲーションの位置まできたら表示
    $(window).scroll(function () {
        var winTop = $(this).scrollTop();
        if (winTop >= navTop) {
            if (showFlag == false) {
                showFlag = true;
                nav
                    .addClass('fixed')
                    .stop().animate({'top' : '0px'}, 200);
            }
        } else if (winTop <= navTop) {
            if (showFlag) {
                showFlag = false;
                nav.stop().animate({'top' : -navHeight+'px'}, 200, function(){
                    nav.removeClass('fixed');
                });
            }
        }
    });
}
