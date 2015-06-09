$(function(){
  if (!Array.indexOf) {
    Array.prototype.indexOf = function(o) {
      for (var i in this) {
        if (this[i] === o) {
          return i;
        }
      }
      return -1;
    };
  }


  /*==========================
  UserAgentCheck
  ==========================*/
  var strUserAgent, uaDevice;
  var uaCheck = function(){
    strUserAgent = window.navigator.userAgent.toLowerCase();

    if(strUserAgent.indexOf('iphone') > 0 || strUserAgent.indexOf('mobile') > 0 || strUserAgent.indexOf('iPad') > 0){
      uaDevice = 'isMobile';
    } else {
      uaDevice = 'isDesktop';
    }
    return uaDevice;
  };
  window.uaCheck = uaCheck;

  /*==========================
  viewModeCheck
  ==========================*/
  var viewMode = '';
  var viewModeCheck = function(){
    if(window.innerWidth > 970){
      viewMode = 'isDesktop';
    }
    else if(window.innerWidth <= 970 && window.innerWidth > 600){
      viewMode = 'isTablet';
    }
    else if(window.innerWidth <= 600){
      viewMode = 'isPhone';
    }
    else{
      viewMode = 'isDesktop';
    }
    return viewMode;
  };
  window.viewModeCheck = viewModeCheck;
  viewMode = viewModeCheck();





});