function initIntro(){var e={opening:".opening",element:[".opening h1",".opening h2",".opening h3"],speed:2e3,delay:400,range:10},n=document.referrer,i=location.hostname;n.match(i)?$(e.opening).hide():(setTimeout(function(){for(var n=0,i=e.element.length;i>n;n++){var t=$(e.element[n]);$(e.element[n]).delay(e.delay*n).animate({opacity:1},e.speed,"swing")}},1e3),setTimeout(function(){$(e.opening).fadeOut("slow",function(){$(".container").fadeIn(800,"easeInExpo").css("display","block"),$(this).remove()})},4e3))}function initFirstView(){initResize(),$(".bxslider,.bxsliderSp").bxSlider({speed:1500,pause:4e3,mode:"fade",auto:!0,infiniteLoop:!0,adaptiveHeight:!0,controls:!1,pager:!1})}function initNavigation(){var e=$(".global-nav"),n=$(".contents").offset(),i=n.top;e.css({top:-60}),$(window).scroll(function(){$(window).scrollTop()>i?(e.css({display:"inline",position:"fixed",left:0,right:0,"z-index":999}),e.stop().animate({opacity:"1",top:0},100)):$(window).scrollTop()<i&&e.stop().animate({opacity:"0",top:-60},100)})}function initInViewItem(){var e=[".news",".about",".summary",".greeting",".member",".donation",".books"];$(e.join(",")).css("opacity","0");var n=100,i=800;$(".news").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")}),$(".about").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")}),$(".summary").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")}),$(".greeting").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")}),$(".member").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")}),$(".donation").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")}),$(".books").on("inview",function(){$(this).delay(n).fadeTo(i,1,"easeInOutSine")})}function initSmoothScroll(){$("a[href^='#']").bind("click",function(e){e?e.preventDefault():window.event&&(window.event.returnValue=!1);var n=$(this).attr("href"),i=$(n).offset(),t=$(".global-nav").height(),o=Math.min(i.top,$(document).height()-$(window).height());$("html,body").animate({scrollTop:o-70},1e3,"easeOutExpo")})}function initResize(){var e=$(window).height(),n=window.innerWidth;e>="725"?($(".index-header").css("height",e+"px"),$(".slider li").css("height",e+"px")):($(".index-header").css("height","725px"),$(".slider li").css("height","725px"))}function initTumblr(){domain="reizeike.tumblr.com",latest="3",$.getJSON("http://"+domain+"/api/read/json?num="+latest+"&callback=?",function(e){$.each(e.posts,function(e,n){var i=n["regular-title"],t=this.url,o=n["date-gmt"].substr(0,10).split("-").join(".");e>-1==e<latest&&(i.length>45&&(i=i.substring(0,44)+" ..."),$(".news ul").append('<li><time datatime="'+n["date-gmt"]+'">'+o+'</time><a href="'+t+'" target="_blank">'+i+"</a></li>"))})})}function initSPnav(){$(".menu-btn").click(function(){return $(this).toggleClass("active"),$(this).hasClass("active")?$(".global-m-nav nav").fadeIn(800,"easeInOutSine").css("display","block"):$(".global-m-nav nav").fadeOut(1e3,"easeInOutSine").css("display","none"),!1}),$(".global-m-nav nav a").click(function(){$(".menu-btn").removeClass("active"),$(".global-m-nav nav").fadeOut(1e3,"easeInOutSine").css("display","none")})}$(function(){initIntro(),initFirstView(),initNavigation(),initInViewItem(),initSmoothScroll(),initTumblr(),initSPnav(),$(window).resize(initResize),$("head").append('<style type="text/css">#container { display: none; }</style>')});