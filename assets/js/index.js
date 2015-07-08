$(function()
{

  initIntro();
  initFirstView();
  initNavigation();
  initInViewItem();
  initSmoothScroll();
  initTumblr();
  initSPnav();

  $(window).resize(initResize);
  $('head').append( '<style type="text/css">#container { display: none; }</style>');

});


/* ----------------------------------------------------
 *  イントロ処理
 * ------------------------------------------------- */
 
 function initIntro()
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
        $('.container') .fadeIn(800, "easeInExpo").css("display","block");
				$(this).remove();
			});
		}, 4000);
	} else {
		$(config.opening).hide();
	}
  
}


/* ----------------------------------------------------
 *  ファーストビュー処理
 * ------------------------------------------------- */

function initFirstView()
{
  initResize();
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
 *  ナビゲーション処理
 * ------------------------------------------------- */

function initNavigation()
{
			
			var header = $(".global-nav");
			var contentsBox = $(".contents").offset();//現在の情報を取得
			var contents = contentsBox.top;
			
			header.css({"top":-60});
			
			//スクロールの監視
			$(window).scroll(function(){

				//指定範囲内で表示
				if($(window).scrollTop() > contents ){			
			
					header.css({"display": "inline","position": "fixed","left": 0,"right": 0, "z-index": 999});
					header.stop().animate({opacity:'1',"top":0},100);
					
				//制御解除
				}else if($(window).scrollTop() < contents){
					
					header.stop().animate({opacity:'0',"top":-60},100);
				}
			
				
			});
}


/* ----------------------------------------------------
 *  コンテンツフェード処理
 * ------------------------------------------------- */

function initInViewItem()
{
  
  var inViewItem = [
    '.news',
    '.about',
    '.summary',
    '.greeting',
    '.member',
    '.donation',
    '.books'
  ];
  
  $(inViewItem.join(',')).css('opacity', '0')

	var inViewdelay=100;
	var inViewfade=800;
	
	//ブラウザの表示域に表示されたときに実行する処理
	$('.news').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });
	$('.about').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });
	$('.summary').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });
	$('.greeting').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });
	$('.member').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });
	$('.donation').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });
	$('.books').on('inview', function() { $(this).delay(inViewdelay).fadeTo(inViewfade, 1, 'easeInOutSine'); });

}

/* ----------------------------------------------------
 *  スムーズスクロール処理
 * ------------------------------------------------- */

function initSmoothScroll(){

	$("a[href^='#']").bind('click', function(event){
		if(event){ event.preventDefault(); }else if(window.event){ window.event.returnValue = false; }
		var targetId = $(this).attr('href');
		var pos = $(targetId).offset();
		var navh = $('.global-nav').height();

		var ty = Math.min(pos.top, ($(document).height() - $(window).height()));
  		$('html,body').animate({ scrollTop: ty - 70 }, 1000, 'easeOutExpo');
	});

}


/* ----------------------------------------------------
 *  リサイズ処理
 * ------------------------------------------------- */

function initResize()
{
	var h = $(window).height();
	var wh = window.innerWidth;

	if (h >= "725"){
    	$(".index-header").css("height", h + "px");
    	$(".slider li").css("height", h + "px");
  	} else {
    	$(".index-header").css("height", "725px");
    	$(".slider li").css("height", "725px");
  	}
}



/* ----------------------------------------------------
 *  Tumblr API処理
 * ------------------------------------------------- */

function initTumblr()
{
  domain ="reizeike.tumblr.com";
  latest ="3";
  $.getJSON("http://"+domain+"/api/read/json?num="+latest+"&callback=?",function(data){
    $.each(data.posts, function(i, posts) {
      var rt = posts['regular-title'];
      var url = this['url'];
      var date = posts["date-gmt"].substr(0, 10).split("-").join(".");
      if(i > -1 == i<latest){
        if(rt.length > 45) {rt = rt.substring(0, 44) + " ...";}
        $('.news ul').append('<li><time datatime="'+posts["date-gmt"]+'">'+date+'</time><a href="'+url+'" target="_blank">'+rt+'</a></li>');
      }
    });
  });
}



function initSPnav()
{
    $(".menu-btn").click(function(){
      $(this).toggleClass("active"); 
        if($(this).hasClass("active")){
          //alert("アクティブ");
          //$("body").css("oveflow", "hidden");
          //$(".global-m-nav nav").show().fadeIn(1500, "easeInExpo").css("display","block");
          $(".global-m-nav nav").fadeIn(800, 'easeInOutSine').css("display","block");
        }else{
          //alert("非アクティブ");
          $(".global-m-nav nav").fadeOut(1000, 'easeInOutSine').css("display","none");          //$(".global-m-nav nav").show().fadeOut(1500, "easeOutExpo").css("display","none");
          //.animate({"left": "100%"}, 400, function(){$(".global-m-nav nav").hide(); $("body").css("oveflow", "visuble");});
        }
      return false;
    });
    $(".global-m-nav nav a").click(function(){
        $(".menu-btn").removeClass("active");
        $(".global-m-nav nav").fadeOut(1000, 'easeInOutSine').css("display","none");
    });
}


