/*! iScroll v5.0.5 ~ (c) 2008-2013 Matteo Spinelli ~ http://cubiq.org/license */

if (window.addEventListener) {
    var IScroll=function(t,i,s){function e(t,s){this.wrapper="string"==typeof t?i.querySelector(t):t,this.scroller=this.wrapper.children[0],this.scrollerStyle=this.scroller.style,this.options={resizeIndicator:!0,mouseWheelSpeed:20,snapThreshold:.334,startX:0,startY:0,scrollY:!0,directionLockThreshold:5,momentum:!0,bounce:!0,bounceTime:600,bounceEasing:"",preventDefault:!0,preventDefaultException:{tagName:/^(INPUT|TEXTAREA|BUTTON|SELECT)$/},HWCompositing:!0,useTransition:!0,useTransform:!0};for(var e in s)this.options[e]=s[e];this.translateZ=this.options.HWCompositing&&h.hasPerspective?" translateZ(0)":"",this.options.useTransition=h.hasTransition&&this.options.useTransition,this.options.useTransform=h.hasTransform&&this.options.useTransform,this.options.eventPassthrough=this.options.eventPassthrough===!0?"vertical":this.options.eventPassthrough,this.options.preventDefault=!this.options.eventPassthrough&&this.options.preventDefault,this.options.scrollY="vertical"==this.options.eventPassthrough?!1:this.options.scrollY,this.options.scrollX="horizontal"==this.options.eventPassthrough?!1:this.options.scrollX,this.options.freeScroll=this.options.freeScroll&&!this.options.eventPassthrough,this.options.directionLockThreshold=this.options.eventPassthrough?0:this.options.directionLockThreshold,this.options.bounceEasing="string"==typeof this.options.bounceEasing?h.ease[this.options.bounceEasing]||h.ease.circular:this.options.bounceEasing,this.options.resizePolling=void 0===this.options.resizePolling?60:this.options.resizePolling,this.options.tap===!0&&(this.options.tap="tap"),this.options.invertWheelDirection=this.options.invertWheelDirection?-1:1,this.x=0,this.y=0,this.directionX=0,this.directionY=0,this._events={},this._init(),this.refresh(),this.scrollTo(this.options.startX,this.options.startY),this.enable()}function o(t,s,e){var o=i.createElement("div"),n=i.createElement("div");return e===!0&&(o.style.cssText="position:absolute;z-index:9999",n.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);border-radius:3px"),n.className="iScrollIndicator","h"==t?(e===!0&&(o.style.cssText+=";height:7px;left:2px;right:2px;bottom:0",n.style.height="100%"),o.className="iScrollHorizontalScrollbar"):(e===!0&&(o.style.cssText+=";width:7px;bottom:2px;top:2px;right:1px",n.style.width="100%"),o.className="iScrollVerticalScrollbar"),s||(o.style.pointerEvents="none"),o.appendChild(n),o}function n(s,e){this.wrapper="string"==typeof e.el?i.querySelector(e.el):e.el,this.indicator=this.wrapper.children[0],this.indicatorStyle=this.indicator.style,this.scroller=s,this.options={listenX:!0,listenY:!0,interactive:!1,resize:!0,defaultScrollbars:!1,speedRatioX:0,speedRatioY:0};for(var o in e)this.options[o]=e[o];this.sizeRatioX=1,this.sizeRatioY=1,this.maxPosX=0,this.maxPosY=0,this.options.interactive&&(h.addEvent(this.indicator,"touchstart",this),h.addEvent(this.indicator,"MSPointerDown",this),h.addEvent(this.indicator,"mousedown",this),h.addEvent(t,"touchend",this),h.addEvent(t,"MSPointerUp",this),h.addEvent(t,"mouseup",this))}var r=t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||t.msRequestAnimationFrame||function(i){t.setTimeout(i,1e3/60)},h=function(){function e(t){return r===!1?!1:""===r?t:r+t.charAt(0).toUpperCase()+t.substr(1)}var o={},n=i.createElement("div").style,r=function(){for(var t,i=["t","webkitT","MozT","msT","OT"],s=0,e=i.length;e>s;s++)if(t=i[s]+"ransform",t in n)return i[s].substr(0,i[s].length-1);return!1}();o.getTime=Date.now||function(){return(new Date).getTime()},o.extend=function(t,i){for(var s in i)t[s]=i[s]},o.addEvent=function(t,i,s,e){t.addEventListener(i,s,!!e)},o.removeEvent=function(t,i,s,e){t.removeEventListener(i,s,!!e)},o.momentum=function(t,i,e,o,n){var r,h,a=t-i,l=s.abs(a)/e,c=6e-4;return r=t+l*l/(2*c)*(0>a?-1:1),h=l/c,o>r?(r=n?o-n/2.5*(l/8):o,a=s.abs(r-t),h=a/l):r>0&&(r=n?n/2.5*(l/8):0,a=s.abs(t)+r,h=a/l),{destination:s.round(r),duration:h}};var h=e("transform");return o.extend(o,{hasTransform:h!==!1,hasPerspective:e("perspective")in n,hasTouch:"ontouchstart"in t,hasPointer:navigator.msPointerEnabled,hasTransition:e("transition")in n}),o.isAndroidBrowser=/Android/.test(t.navigator.appVersion)&&/Version\/\d/.test(t.navigator.appVersion),o.extend(o.style={},{transform:h,transitionTimingFunction:e("transitionTimingFunction"),transitionDuration:e("transitionDuration"),transformOrigin:e("transformOrigin")}),o.hasClass=function(t,i){var s=new RegExp("(^|\\s)"+i+"(\\s|$)");return s.test(t.className)},o.addClass=function(t,i){if(!o.hasClass(t,i)){var s=t.className.split(" ");s.push(i),t.className=s.join(" ")}},o.removeClass=function(t,i){if(o.hasClass(t,i)){var s=new RegExp("(^|\\s)"+i+"(\\s|$)","g");t.className=t.className.replace(s," ")}},o.offset=function(t){for(var i=-t.offsetLeft,s=-t.offsetTop;t=t.offsetParent;)i-=t.offsetLeft,s-=t.offsetTop;return{left:i,top:s}},o.preventDefaultException=function(t,i){for(var s in i)if(i[s].test(t[s]))return!0;return!1},o.extend(o.eventType={},{touchstart:1,touchmove:1,touchend:1,mousedown:2,mousemove:2,mouseup:2,MSPointerDown:3,MSPointerMove:3,MSPointerUp:3}),o.extend(o.ease={},{quadratic:{style:"cubic-bezier(0.25, 0.46, 0.45, 0.94)",fn:function(t){return t*(2-t)}},circular:{style:"cubic-bezier(0.1, 0.57, 0.1, 1)",fn:function(t){return s.sqrt(1- --t*t)}},back:{style:"cubic-bezier(0.175, 0.885, 0.32, 1.275)",fn:function(t){var i=4;return(t-=1)*t*((i+1)*t+i)+1}},bounce:{style:"",fn:function(t){return(t/=1)<1/2.75?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375}},elastic:{style:"",fn:function(t){var i=.22,e=.4;return 0===t?0:1==t?1:e*s.pow(2,-10*t)*s.sin((t-i/4)*2*s.PI/i)+1}}}),o.tap=function(t,s){var e=i.createEvent("Event");e.initEvent(s,!0,!0),e.pageX=t.pageX,e.pageY=t.pageY,t.target.dispatchEvent(e)},o.click=function(t){var s,e=t.target;"SELECT"!=e.tagName&&"INPUT"!=e.tagName&&"TEXTAREA"!=e.tagName&&(s=i.createEvent("MouseEvents"),s.initMouseEvent("click",!0,!0,t.view,1,e.screenX,e.screenY,e.clientX,e.clientY,t.ctrlKey,t.altKey,t.shiftKey,t.metaKey,0,null),s._constructed=!0,e.dispatchEvent(s))},o}();return e.prototype={version:"5.0.5",_init:function(){this._initEvents(),(this.options.scrollbars||this.options.indicators)&&this._initIndicators(),this.options.mouseWheel&&this._initWheel(),this.options.snap&&this._initSnap(),this.options.keyBindings&&this._initKeys()},destroy:function(){this._initEvents(!0),this._execEvent("destroy")},_transitionEnd:function(t){t.target==this.scroller&&(this._transitionTime(0),this.resetPosition(this.options.bounceTime)||this._execEvent("scrollEnd"))},_start:function(t){if(!(1!=h.eventType[t.type]&&0!==t.button||!this.enabled||this.initiated&&h.eventType[t.type]!==this.initiated)){!this.options.preventDefault||h.isAndroidBrowser||h.preventDefaultException(t.target,this.options.preventDefaultException)||t.preventDefault();var i,e=t.touches?t.touches[0]:t;this.initiated=h.eventType[t.type],this.moved=!1,this.distX=0,this.distY=0,this.directionX=0,this.directionY=0,this.directionLocked=0,this._transitionTime(),this.isAnimating=!1,this.startTime=h.getTime(),this.options.useTransition&&this.isInTransition&&(i=this.getComputedPosition(),this._translate(s.round(i.x),s.round(i.y)),this.isInTransition=!1),this.startX=this.x,this.startY=this.y,this.absStartX=this.x,this.absStartY=this.y,this.pointX=e.pageX,this.pointY=e.pageY,this._execEvent("scrollStart")}},_move:function(t){if(this.enabled&&h.eventType[t.type]===this.initiated){this.options.preventDefault&&t.preventDefault();var i,e,o,n,r=t.touches?t.touches[0]:t,a=this.hasHorizontalScroll?r.pageX-this.pointX:0,l=this.hasVerticalScroll?r.pageY-this.pointY:0,c=h.getTime();if(this.pointX=r.pageX,this.pointY=r.pageY,this.distX+=a,this.distY+=l,o=s.abs(this.distX),n=s.abs(this.distY),!(c-this.endTime>300&&10>o&&10>n)){if(this.directionLocked||this.options.freeScroll||(this.directionLocked=o>n+this.options.directionLockThreshold?"h":n>=o+this.options.directionLockThreshold?"v":"n"),"h"==this.directionLocked){if("vertical"==this.options.eventPassthrough)t.preventDefault();else if("horizontal"==this.options.eventPassthrough)return this.initiated=!1,void 0;l=0}else if("v"==this.directionLocked){if("horizontal"==this.options.eventPassthrough)t.preventDefault();else if("vertical"==this.options.eventPassthrough)return this.initiated=!1,void 0;a=0}i=this.x+a,e=this.y+l,(i>0||i<this.maxScrollX)&&(i=this.options.bounce?this.x+a/3:i>0?0:this.maxScrollX),(e>0||e<this.maxScrollY)&&(e=this.options.bounce?this.y+l/3:e>0?0:this.maxScrollY),this.directionX=a>0?-1:0>a?1:0,this.directionY=l>0?-1:0>l?1:0,this.moved=!0,this._translate(i,e),c-this.startTime>300&&(this.startTime=c,this.startX=this.x,this.startY=this.y)}}},_end:function(t){if(this.enabled&&h.eventType[t.type]===this.initiated){this.options.preventDefault&&!h.preventDefaultException(t.target,this.options.preventDefaultException)&&t.preventDefault();var i,e,o=(t.changedTouches?t.changedTouches[0]:t,h.getTime()-this.startTime),n=s.round(this.x),r=s.round(this.y),a=s.abs(n-this.startX),l=s.abs(r-this.startY),c=0,p="";if(this.scrollTo(n,r),this.isInTransition=0,this.initiated=0,this.endTime=h.getTime(),!this.resetPosition(this.options.bounceTime)){if(!this.moved)return this.options.tap&&h.tap(t,this.options.tap),this.options.click&&h.click(t),void 0;if(this._events.flick&&200>o&&100>a&&100>l)return this._execEvent("flick"),void 0;if(this.options.momentum&&300>o&&(i=this.hasHorizontalScroll?h.momentum(this.x,this.startX,o,this.maxScrollX,this.options.bounce?this.wrapperWidth:0):{destination:n,duration:0},e=this.hasVerticalScroll?h.momentum(this.y,this.startY,o,this.maxScrollY,this.options.bounce?this.wrapperHeight:0):{destination:r,duration:0},n=i.destination,r=e.destination,c=s.max(i.duration,e.duration),this.isInTransition=1),this.options.snap){var d=this._nearestSnap(n,r);this.currentPage=d,c=this.options.snapSpeed||s.max(s.max(s.min(s.abs(n-d.x),1e3),s.min(s.abs(r-d.y),1e3)),300),n=d.x,r=d.y,this.directionX=0,this.directionY=0,p=this.options.bounceEasing}return n!=this.x||r!=this.y?((n>0||n<this.maxScrollX||r>0||r<this.maxScrollY)&&(p=h.ease.quadratic),this.scrollTo(n,r,c,p),void 0):(this._execEvent("scrollEnd"),void 0)}}},_resize:function(){var t=this;clearTimeout(this.resizeTimeout),this.resizeTimeout=setTimeout(function(){t.refresh()},this.options.resizePolling)},resetPosition:function(t){var i=this.x,s=this.y;return t=t||0,!this.hasHorizontalScroll||this.x>0?i=0:this.x<this.maxScrollX&&(i=this.maxScrollX),!this.hasVerticalScroll||this.y>0?s=0:this.y<this.maxScrollY&&(s=this.maxScrollY),i==this.x&&s==this.y?!1:(this.scrollTo(i,s,t,this.options.bounceEasing),!0)},disable:function(){this.enabled=!1},enable:function(){this.enabled=!0},refresh:function(){this.wrapper.offsetHeight,this.wrapperWidth=this.wrapper.clientWidth,this.wrapperHeight=this.wrapper.clientHeight,this.scrollerWidth=this.scroller.offsetWidth,this.scrollerHeight=this.scroller.offsetHeight,this.maxScrollX=this.wrapperWidth-this.scrollerWidth,this.maxScrollY=this.wrapperHeight-this.scrollerHeight,this.hasHorizontalScroll=this.options.scrollX&&this.maxScrollX<0,this.hasVerticalScroll=this.options.scrollY&&this.maxScrollY<0,this.hasHorizontalScroll||(this.maxScrollX=0,this.scrollerWidth=this.wrapperWidth),this.hasVerticalScroll||(this.maxScrollY=0,this.scrollerHeight=this.wrapperHeight),this.endTime=0,this.directionX=0,this.directionY=0,this.wrapperOffset=h.offset(this.wrapper),this._execEvent("refresh"),this.resetPosition()},on:function(t,i){this._events[t]||(this._events[t]=[]),this._events[t].push(i)},_execEvent:function(t){if(this._events[t]){var i=0,s=this._events[t].length;if(s)for(;s>i;i++)this._events[t][i].call(this)}},scrollBy:function(t,i,s,e){t=this.x+t,i=this.y+i,s=s||0,this.scrollTo(t,i,s,e)},scrollTo:function(t,i,s,e){e=e||h.ease.circular,!s||this.options.useTransition&&e.style?(this._transitionTimingFunction(e.style),this._transitionTime(s),this._translate(t,i)):this._animate(t,i,s,e.fn)},scrollToElement:function(t,i,e,o,n){if(t=t.nodeType?t:this.scroller.querySelector(t)){var r=h.offset(t);r.left-=this.wrapperOffset.left,r.top-=this.wrapperOffset.top,e===!0&&(e=s.round(t.offsetWidth/2-this.wrapper.offsetWidth/2)),o===!0&&(o=s.round(t.offsetHeight/2-this.wrapper.offsetHeight/2)),r.left-=e||0,r.top-=o||0,r.left=r.left>0?0:r.left<this.maxScrollX?this.maxScrollX:r.left,r.top=r.top>0?0:r.top<this.maxScrollY?this.maxScrollY:r.top,i=void 0===i||null===i||"auto"===i?s.max(s.abs(this.x-r.left),s.abs(this.y-r.top)):i,this.scrollTo(r.left,r.top,i,n)}},_transitionTime:function(t){t=t||0,this.scrollerStyle[h.style.transitionDuration]=t+"ms",this.indicator1&&this.indicator1.transitionTime(t),this.indicator2&&this.indicator2.transitionTime(t)},_transitionTimingFunction:function(t){this.scrollerStyle[h.style.transitionTimingFunction]=t,this.indicator1&&this.indicator1.transitionTimingFunction(t),this.indicator2&&this.indicator2.transitionTimingFunction(t)},_translate:function(t,i){this.options.useTransform?this.scrollerStyle[h.style.transform]="translate("+t+"px,"+i+"px)"+this.translateZ:(t=s.round(t),i=s.round(i),this.scrollerStyle.left=t+"px",this.scrollerStyle.top=i+"px"),this.x=t,this.y=i,this.indicator1&&this.indicator1.updatePosition(),this.indicator2&&this.indicator2.updatePosition()},_initEvents:function(i){var s=i?h.removeEvent:h.addEvent,e=this.options.bindToWrapper?this.wrapper:t;s(t,"orientationchange",this),s(t,"resize",this),s(this.wrapper,"mousedown",this),s(e,"mousemove",this),s(e,"mousecancel",this),s(e,"mouseup",this),h.hasPointer&&(s(this.wrapper,"MSPointerDown",this),s(e,"MSPointerMove",this),s(e,"MSPointerCancel",this),s(e,"MSPointerUp",this)),h.hasTouch&&(s(this.wrapper,"touchstart",this),s(e,"touchmove",this),s(e,"touchcancel",this),s(e,"touchend",this)),s(this.scroller,"transitionend",this),s(this.scroller,"webkitTransitionEnd",this),s(this.scroller,"oTransitionEnd",this),s(this.scroller,"MSTransitionEnd",this)},getComputedPosition:function(){var i,s,e=t.getComputedStyle(this.scroller,null);return this.options.useTransform?(e=e[h.style.transform].split(")")[0].split(", "),i=+(e[12]||e[4]),s=+(e[13]||e[5])):(i=+e.left.replace(/[^-\d]/g,""),s=+e.top.replace(/[^-\d]/g,"")),{x:i,y:s}},_initIndicators:function(){var t,i,s=this.options.interactiveScrollbars,e=("object"!=typeof this.options.scrollbars,"string"!=typeof this.options.scrollbars);this.options.scrollbars?(this.options.scrollY&&(t={el:o("v",s,this.options.scrollbars),interactive:s,defaultScrollbars:!0,customStyle:e,resize:this.options.resizeIndicator,listenX:!1},this.wrapper.appendChild(t.el)),this.options.scrollX&&(i={el:o("h",s,this.options.scrollbars),interactive:s,defaultScrollbars:!0,customStyle:e,resize:this.options.resizeIndicator,listenY:!1},this.wrapper.appendChild(i.el))):(t=this.options.indicators.length?this.options.indicators[0]:this.options.indicators,i=this.options.indicators[1]&&this.options.indicators[1]),t&&(this.indicator1=new n(this,t)),i&&(this.indicator2=new n(this,i)),this.on("refresh",function(){this.indicator1&&this.indicator1.refresh(),this.indicator2&&this.indicator2.refresh()}),this.on("destroy",function(){this.indicator1&&(this.indicator1.destroy(),this.indicator1=null),this.indicator2&&(this.indicator2.destroy(),this.indicator2=null)})},_initWheel:function(){h.addEvent(this.wrapper,"mousewheel",this),h.addEvent(this.wrapper,"DOMMouseScroll",this),this.on("destroy",function(){h.removeEvent(this.wrapper,"mousewheel",this),h.removeEvent(this.wrapper,"DOMMouseScroll",this)})},_wheel:function(t){if(this.enabled){var i,s,e,o,n=this;if(clearTimeout(this.wheelTimeout),this.wheelTimeout=setTimeout(function(){n._execEvent("scrollEnd")},400),t.preventDefault(),"wheelDeltaX"in t)i=t.wheelDeltaX/120,s=t.wheelDeltaY/120;else if("wheelDelta"in t)i=s=t.wheelDelta/120;else{if(!("detail"in t))return;i=s=-t.detail/3}if(i*=this.options.mouseWheelSpeed,s*=this.options.mouseWheelSpeed,this.hasVerticalScroll||(i=s,s=0),this.options.snap)return e=this.currentPage.pageX,o=this.currentPage.pageY,i>0?e--:0>i&&e++,s>0?o--:0>s&&o++,this.goToPage(e,o),void 0;e=this.x+(this.hasHorizontalScroll?i*this.options.invertWheelDirection:0),o=this.y+(this.hasVerticalScroll?s*this.options.invertWheelDirection:0),e>0?e=0:e<this.maxScrollX&&(e=this.maxScrollX),o>0?o=0:o<this.maxScrollY&&(o=this.maxScrollY),this.scrollTo(e,o,0)}},_initSnap:function(){this.currentPage={},"string"==typeof this.options.snap&&(this.options.snap=this.scroller.querySelectorAll(this.options.snap)),this.on("refresh",function(){var t,i,e,o,n,r,h=0,a=0,l=0,c=this.options.snapStepX||this.wrapperWidth,p=this.options.snapStepY||this.wrapperHeight;if(this.pages=[],this.wrapperWidth&&this.wrapperHeight&&this.scrollerWidth&&this.scrollerHeight){if(this.options.snap===!0)for(e=s.round(c/2),o=s.round(p/2);l>-this.scrollerWidth;){for(this.pages[h]=[],t=0,n=0;n>-this.scrollerHeight;)this.pages[h][t]={x:s.max(l,this.maxScrollX),y:s.max(n,this.maxScrollY),width:c,height:p,cx:l-e,cy:n-o},n-=p,t++;l-=c,h++}else for(r=this.options.snap,t=r.length,i=-1;t>h;h++)(0===h||r[h].offsetLeft<=r[h-1].offsetLeft)&&(a=0,i++),this.pages[a]||(this.pages[a]=[]),l=s.max(-r[h].offsetLeft,this.maxScrollX),n=s.max(-r[h].offsetTop,this.maxScrollY),e=l-s.round(r[h].offsetWidth/2),o=n-s.round(r[h].offsetHeight/2),this.pages[a][i]={x:l,y:n,width:r[h].offsetWidth,height:r[h].offsetHeight,cx:e,cy:o},l>this.maxScrollX&&a++;this.goToPage(this.currentPage.pageX||0,this.currentPage.pageY||0,0),0===this.options.snapThreshold%1?(this.snapThresholdX=this.options.snapThreshold,this.snapThresholdY=this.options.snapThreshold):(this.snapThresholdX=s.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].width*this.options.snapThreshold),this.snapThresholdY=s.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].height*this.options.snapThreshold))}}),this.on("flick",function(){var t=this.options.snapSpeed||s.max(s.max(s.min(s.abs(this.x-this.startX),1e3),s.min(s.abs(this.y-this.startY),1e3)),300);this.goToPage(this.currentPage.pageX+this.directionX,this.currentPage.pageY+this.directionY,t)})},_nearestSnap:function(t,i){if(!this.pages.length)return{x:0,y:0,pageX:0,pageY:0};var e=0,o=this.pages.length,n=0;if(s.abs(t-this.absStartX)<this.snapThresholdX&&s.abs(i-this.absStartY)<this.snapThresholdY)return this.currentPage;for(t>0?t=0:t<this.maxScrollX&&(t=this.maxScrollX),i>0?i=0:i<this.maxScrollY&&(i=this.maxScrollY);o>e;e++)if(t>=this.pages[e][0].cx){t=this.pages[e][0].x;break}for(o=this.pages[e].length;o>n;n++)if(i>=this.pages[0][n].cy){i=this.pages[0][n].y;break}return e==this.currentPage.pageX&&(e+=this.directionX,0>e?e=0:e>=this.pages.length&&(e=this.pages.length-1),t=this.pages[e][0].x),n==this.currentPage.pageY&&(n+=this.directionY,0>n?n=0:n>=this.pages[0].length&&(n=this.pages[0].length-1),i=this.pages[0][n].y),{x:t,y:i,pageX:e,pageY:n}},goToPage:function(t,i,e,o){o=o||this.options.bounceEasing,t>=this.pages.length?t=this.pages.length-1:0>t&&(t=0),i>=this.pages[t].length?i=this.pages[t].length-1:0>i&&(i=0);var n=this.pages[t][i].x,r=this.pages[t][i].y;e=void 0===e?this.options.snapSpeed||s.max(s.max(s.min(s.abs(n-this.x),1e3),s.min(s.abs(r-this.y),1e3)),300):e,this.currentPage={x:n,y:r,pageX:t,pageY:i},this.scrollTo(n,r,e,o)},next:function(t,i){var s=this.currentPage.pageX,e=this.currentPage.pageY;s++,s>=this.pages.length&&this.hasVerticalScroll&&(s=0,e++),this.goToPage(s,e,t,i)},prev:function(t,i){var s=this.currentPage.pageX,e=this.currentPage.pageY;s--,0>s&&this.hasVerticalScroll&&(s=0,e--),this.goToPage(s,e,t,i)},_initKeys:function(){var i,s={pageUp:33,pageDown:34,end:35,home:36,left:37,up:38,right:39,down:40};if("object"==typeof this.options.keyBindings)for(i in this.options.keyBindings)"string"==typeof this.options.keyBindings[i]&&(this.options.keyBindings[i]=this.options.keyBindings[i].toUpperCase().charCodeAt(0));else this.options.keyBindings={};for(i in s)this.options.keyBindings[i]=this.options.keyBindings[i]||s[i];h.addEvent(t,"keydown",this),this.on("destroy",function(){h.removeEvent(t,"keydown",this)})},_key:function(t){if(this.enabled){var i,e=this.options.snap,o=e?this.currentPage.pageX:this.x,n=e?this.currentPage.pageY:this.y,r=h.getTime(),a=this.keyTime||0,l=.25;switch(this.options.useTransition&&this.isInTransition&&(i=this.getComputedPosition(),this._translate(s.round(i.x),s.round(i.y)),this.isInTransition=!1),this.keyAcceleration=200>r-a?s.min(this.keyAcceleration+l,50):0,t.keyCode){case this.options.keyBindings.pageUp:this.hasHorizontalScroll&&!this.hasVerticalScroll?o+=e?1:this.wrapperWidth:n+=e?1:this.wrapperHeight;break;case this.options.keyBindings.pageDown:this.hasHorizontalScroll&&!this.hasVerticalScroll?o-=e?1:this.wrapperWidth:n-=e?1:this.wrapperHeight;break;case this.options.keyBindings.end:o=e?this.pages.length-1:this.maxScrollX,n=e?this.pages[0].length-1:this.maxScrollY;break;case this.options.keyBindings.home:o=0,n=0;break;case this.options.keyBindings.left:o+=e?-1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.up:n+=e?1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.right:o-=e?-1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.down:n-=e?1:5+this.keyAcceleration>>0}if(e)return this.goToPage(o,n),void 0;o>0?(o=0,this.keyAcceleration=0):o<this.maxScrollX&&(o=this.maxScrollX,this.keyAcceleration=0),n>0?(n=0,this.keyAcceleration=0):n<this.maxScrollY&&(n=this.maxScrollY,this.keyAcceleration=0),this.scrollTo(o,n,0),this.keyTime=r}},_animate:function(t,i,s,e){function o(){var d,u,m,g=h.getTime();return g>=p?(n.isAnimating=!1,n._translate(t,i),n.resetPosition(n.options.bounceTime)||n._execEvent("scrollEnd"),void 0):(g=(g-c)/s,m=e(g),d=(t-a)*m+a,u=(i-l)*m+l,n._translate(d,u),n.isAnimating&&r(o),void 0)}var n=this,a=this.x,l=this.y,c=h.getTime(),p=c+s;this.isAnimating=!0,o()},handleEvent:function(t){switch(t.type){case"touchstart":case"MSPointerDown":/*case"mousedown":*/this._start(t);break;case"touchmove":case"MSPointerMove":/*case"mousemove":*/this._move(t);break;case"touchend":case"MSPointerUp":/*case"mouseup":*/case"touchcancel":case"MSPointerCancel":case"mousecancel":this._end(t);break;case"orientationchange":case"resize":this._resize();break;case"transitionend":case"webkitTransitionEnd":case"oTransitionEnd":case"MSTransitionEnd":this._transitionEnd(t);break;case"DOMMouseScroll":case"mousewheel":this._wheel(t);break;case"keydown":this._key(t)}}},n.prototype={handleEvent:function(t){switch(t.type){case"touchstart":case"MSPointerDown":case"mousedown":this._start(t);break;case"touchmove":case"MSPointerMove":case"mousemove":this._move(t);break;case"touchend":case"MSPointerUp":case"mouseup":case"touchcancel":case"MSPointerCancel":case"mousecancel":this._end(t)}},destroy:function(){this.options.interactive&&(h.removeEvent(this.indicator,"touchstart",this),h.removeEvent(this.indicator,"MSPointerDown",this),h.removeEvent(this.indicator,"mousedown",this),h.removeEvent(t,"touchmove",this),h.removeEvent(t,"MSPointerMove",this),h.removeEvent(t,"mousemove",this),h.removeEvent(t,"touchend",this),h.removeEvent(t,"MSPointerUp",this),h.removeEvent(t,"mouseup",this)),this.options.defaultScrollbars&&this.wrapper.parentNode.removeChild(this.wrapper)},_start:function(i){var s=i.touches?i.touches[0]:i;i.preventDefault(),i.stopPropagation(),this.transitionTime(0),this.initiated=!0,this.moved=!1,this.lastPointX=s.pageX,this.lastPointY=s.pageY,this.startTime=h.getTime(),h.addEvent(t,"touchmove",this),h.addEvent(t,"MSPointerMove",this),h.addEvent(t,"mousemove",this),this.scroller._execEvent("scrollStart")},_move:function(t){var i,s,e,o,n=t.touches?t.touches[0]:t;h.getTime(),this.moved=!0,i=n.pageX-this.lastPointX,this.lastPointX=n.pageX,s=n.pageY-this.lastPointY,this.lastPointY=n.pageY,e=this.x+i,o=this.y+s,this._pos(e,o),t.preventDefault(),t.stopPropagation()},_end:function(i){if(this.initiated){if(this.initiated=!1,i.preventDefault(),i.stopPropagation(),h.removeEvent(t,"touchmove",this),h.removeEvent(t,"MSPointerMove",this),h.removeEvent(t,"mousemove",this),this.scroller.options.snap){var e=this.scroller._nearestSnap(this.scroller.x,this.scroller.y),o=this.options.snapSpeed||s.max(s.max(s.min(s.abs(this.scroller.x-e.x),1e3),s.min(s.abs(this.scroller.y-e.y),1e3)),300);(this.scroller.x!=e.x||this.scroller.y!=e.y)&&(this.scroller.directionX=0,this.scroller.directionY=0,this.scroller.currentPage=e,this.scroller.scrollTo(e.x,e.y,o,this.scroller.options.bounceEasing))}this.moved&&this.scroller._execEvent("scrollEnd")}},transitionTime:function(t){t=t||0,this.indicatorStyle[h.style.transitionDuration]=t+"ms"},transitionTimingFunction:function(t){this.indicatorStyle[h.style.transitionTimingFunction]=t},refresh:function(){this.transitionTime(0),this.indicatorStyle.display=this.options.listenX&&!this.options.listenY?this.scroller.hasHorizontalScroll?"block":"none":this.options.listenY&&!this.options.listenX?this.scroller.hasVerticalScroll?"block":"none":this.scroller.hasHorizontalScroll||this.scroller.hasVerticalScroll?"block":"none",this.scroller.hasHorizontalScroll&&this.scroller.hasVerticalScroll?(h.addClass(this.wrapper,"iScrollBothScrollbars"),h.removeClass(this.wrapper,"iScrollLoneScrollbar"),this.options.defaultScrollbars&&this.options.customStyle&&(this.options.listenX?this.wrapper.style.right="8px":this.wrapper.style.bottom="8px")):(h.removeClass(this.wrapper,"iScrollBothScrollbars"),h.addClass(this.wrapper,"iScrollLoneScrollbar"),this.options.defaultScrollbars&&this.options.customStyle&&(this.options.listenX?this.wrapper.style.right="2px":this.wrapper.style.bottom="2px")),this.wrapper.offsetHeight,this.options.listenX&&(this.wrapperWidth=this.wrapper.clientWidth,this.options.resize?(this.indicatorWidth=s.max(s.round(this.wrapperWidth*this.wrapperWidth/(this.scroller.scrollerWidth||this.wrapperWidth||1)),8),this.indicatorStyle.width=this.indicatorWidth+"px"):this.indicatorWidth=this.indicator.clientWidth,this.maxPosX=this.wrapperWidth-this.indicatorWidth,this.sizeRatioX=this.options.speedRatioX||this.scroller.maxScrollX&&this.maxPosX/this.scroller.maxScrollX),this.options.listenY&&(this.wrapperHeight=this.wrapper.clientHeight,this.options.resize?(this.indicatorHeight=s.max(s.round(this.wrapperHeight*this.wrapperHeight/(this.scroller.scrollerHeight||this.wrapperHeight||1)),8),this.indicatorStyle.height=this.indicatorHeight+"px"):this.indicatorHeight=this.indicator.clientHeight,this.maxPosY=this.wrapperHeight-this.indicatorHeight,this.sizeRatioY=this.options.speedRatioY||this.scroller.maxScrollY&&this.maxPosY/this.scroller.maxScrollY),this.updatePosition()},updatePosition:function(){var t=s.round(this.sizeRatioX*this.scroller.x)||0,i=s.round(this.sizeRatioY*this.scroller.y)||0;this.options.ignoreBoundaries||(0>t?t=0:t>this.maxPosX&&(t=this.maxPosX),0>i?i=0:i>this.maxPosY&&(i=this.maxPosY)),this.x=t,this.y=i,this.scroller.options.useTransform?this.indicatorStyle[h.style.transform]="translate("+t+"px,"+i+"px)"+this.scroller.translateZ:(this.indicatorStyle.left=t+"px",this.indicatorStyle.top=i+"px")},_pos:function(t,i){0>t?t=0:t>this.maxPosX&&(t=this.maxPosX),0>i?i=0:i>this.maxPosY&&(i=this.maxPosY),t=this.options.listenX?s.round(t/this.sizeRatioX):this.scroller.x,i=this.options.listenY?s.round(i/this.sizeRatioY):this.scroller.y,this.scroller.scrollTo(t,i)}},e.ease=h.ease,e}(window,document,Math);
} else {
    /*!
     * Modified source: https://iscroll.googlegroups.com/attach/40d472f42a1d3c3a/iscroll.js?pli=1&view=1&part=4
     *
     * iScroll v4.1.9 ~ Copyright (c) 2011 Matteo Spinelli, http://cubiq.org
     * Released under MIT license, http://cubiq.org/license
     */

    (function () {
        var m = Math,
            vendor = (/webkit/i).test(navigator.appVersion) ? 'webkit' :
                (/firefox/i).test(navigator.userAgent) ? 'Moz' :
                        'opera' in window ? 'O' : '',

        // Browser capabilities
            has3d = 'WebKitCSSMatrix' in window && 'm11' in new WebKitCSSMatrix(),
            hasTouch = 'ontouchstart' in window,
            hasTransform = vendor + 'Transform' in document.documentElement.style,
            isAndroid = (/android/gi).test(navigator.appVersion),
            isIDevice = (/iphone|ipad/gi).test(navigator.appVersion),
            isPlaybook = (/playbook/gi).test(navigator.appVersion),
            isIE = (!window.addEventListener),
            hasTransitionEnd = isIDevice || isPlaybook,
            nextFrame = (function() {
                return window.requestAnimationFrame
                    || window.webkitRequestAnimationFrame
                    || window.mozRequestAnimationFrame
                    || window.oRequestAnimationFrame
                    || window.msRequestAnimationFrame
                    || function(callback) { return setTimeout(callback, 1); }
            })(),
            cancelFrame = (function () {
                return window.cancelRequestAnimationFrame
                    || window.webkitCancelRequestAnimationFrame
                    || window.mozCancelRequestAnimationFrame
                    || window.oCancelRequestAnimationFrame
                    || window.msCancelRequestAnimationFrame
                    || clearTimeout
            })(),

        // Events
            RESIZE_EV = 'onorientationchange' in window ? 'orientationchange' : 'resize',
            START_EV = hasTouch ? 'touchstart' : 'mousedown',
            MOVE_EV = hasTouch ? 'touchmove' : 'mousemove',
            END_EV = hasTouch ? 'touchend' : 'mouseup',
            CANCEL_EV = hasTouch ? 'touchcancel' : 'mouseup',
            WHEEL_EV = vendor == 'Moz' ? 'DOMMouseScroll' : 'mousewheel',

        // Helpers
            trnOpen = 'translate' + (has3d ? '3d(' : '('),
            trnClose = has3d ? ',0)' : ')',

        // Constructor
            IScroll_IE8 = function (el, options) {
                var that = this,
                    doc = document,
                    i;

                that.wrapper = typeof el === 'object' ? el : doc.getElementById(el);

                that.wrapper.style.overflow = 'hidden';
                that.scroller = that.wrapper.children[0];

                var wrapperHeight = that.scroller.offsetHeight,
                    maxWrapperHeight = parseInt(that.wrapper.offsetHeight, 10);

                if (wrapperHeight > maxWrapperHeight) {
                    wrapperHeight = $(that.wrapper).height();
                }

                that.wrapper.style.width = that.scroller.offsetWidth + 'px';
                that.wrapper.style.height = wrapperHeight + 'px';
                that.scroller.style.width = '100%';

                // Default options
                that.options = {
                    hScroll: true,
                    vScroll: true,
                    bounce: true,
                    bounceLock: false,
                    momentum: true,
                    lockDirection: true,
                    useTransform: true,
                    useTransition: false,
                    topOffset: 0,
                    checkDOMChanges: false,         // Experimental

                    // Scrollbar
                    hScrollbar: true,
                    vScrollbar: true,
                    fixedScrollbar: isAndroid,
                    hideScrollbar: isIDevice,
                    fadeScrollbar: isIDevice && has3d,
                    scrollbarClass: '',

                    // Zoom
                    zoom: false,
                    zoomMin: 1,
                    zoomMax: 4,
                    doubleTapZoom: 2,
                    wheelAction: 'scroll',

                    // Snap
                    snap: false,
                    snapThreshold: 1,

                    // Events
                    onRefresh: null,
                    onBeforeScrollStart: function (e) {
                        if (e.preventDefault) {
                            e.preventDefault();
                        } else {
                            e.returnValue = false;
                        }
                    },
                    onScrollStart: null,
                    onBeforeScrollMove: null,
                    onScrollMove: null,
                    onBeforeScrollEnd: null,
                    onScrollEnd: null,
                    onTouchEnd: null,
                    onDestroy: null,
                    onZoomStart: null,
                    onZoom: null,
                    onZoomEnd: null
                };

                // User defined options
                for (i in options) that.options[i] = options[i];

                // Normalize options
                that.options.useTransform = hasTransform ? that.options.useTransform : false;
                that.options.hScrollbar = that.options.hScroll && that.options.hScrollbar;
                that.options.vScrollbar = that.options.vScroll && that.options.vScrollbar;
                that.options.zoom = that.options.useTransform && that.options.zoom;
                that.options.useTransition = hasTransitionEnd && that.options.useTransition;

                // Set some default styles
                that.scroller.style[vendor + 'TransitionProperty'] = that.options.useTransform ? '-' + vendor.toLowerCase() + '-transform' : 'top left';
                that.scroller.style[vendor + 'TransitionDuration'] = '0';
                that.scroller.style[vendor + 'TransformOrigin'] = '0 0';
                if (that.options.useTransition) that.scroller.style[vendor + 'TransitionTimingFunction'] = 'cubic-bezier(0.33,0.66,0.66,1)';

                if (that.options.useTransform) that.scroller.style[vendor + 'Transform'] = trnOpen + '0,0' + trnClose;
                else that.scroller.style.cssText += ';position:absolute;top:0;left:0';

                if (that.options.useTransition) that.options.fixedScrollbar = true;

                that.refresh();

                that._bind(RESIZE_EV, window);
                that._bind(START_EV);
                if (!hasTouch) {
                    that._bind('mouseout', that.wrapper);
                    that._bind(WHEEL_EV);
                }

                if (that.options.checkDOMChanges) that.checkDOMTime = setInterval(function () {
                    that._checkDOMChanges();
                }, 500);

                if (!window.getComputedStyle) {
                    window.getComputedStyle = function(el, pseudo) {
                        this.el = el;
                        this.getPropertyValue = function(prop) {
                            var re = /(\-([a-z]){1})/g;
                            if (prop == 'float') prop = 'styleFloat';
                            if (re.test(prop)) {
                                prop = prop.replace(re, function () {
                                    return arguments[2].toUpperCase();
                                });
                            }
                            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
                        }
                        return this;
                    }
                }
            };

// Prototype
        IScroll_IE8.prototype = {
            enabled: true,
            x: 0,
            y: 0,
            steps: [],
            scale: 1,
            currPageX: 0, currPageY: 0,
            pagesX: [], pagesY: [],
            aniTime: null,
            wheelZoomCount: 0,

            handleEvent: function (e) {
                var that = this;

                if(!e) {
                    e = window.event;
                    e.type = e.type.slice(2);
                }
                switch(e.type) {
                case START_EV:
                    if (!hasTouch && e.button == 2) return; // right button
                    that._start(e);
                    break;
                case MOVE_EV:
                    if(isIE && e.button === 0 ) {
                        that._end(e); break; // missed a mouseup?
                    } else {
                        that._move(e); break;
                    }
                case END_EV:
                case CANCEL_EV: that._end(e); break;
                case RESIZE_EV: that._resize(); break;
                case WHEEL_EV: that._wheel(e); break;
                case 'mouseout': that._mouseout(e); break;
                case 'webkitTransitionEnd': that._transitionEnd(e); break;
                }
            },

            _checkDOMChanges: function () {
                if (this.moved || this.zoomed || this.animating ||
                    (this.scrollerW == this.scroller.offsetWidth * this.scale && this.scrollerH == this.scroller.offsetHeight * this.scale)) return;

                this.refresh();
            },

            _scrollbar: function (dir) {
                var that = this,
                    doc = document,
                    bar;

                if (!that[dir + 'Scrollbar']) {
                    if (that[dir + 'ScrollbarWrapper']) {
                        if (hasTransform) that[dir + 'ScrollbarIndicator'].style[vendor + 'Transform'] = '';
                        that[dir + 'ScrollbarWrapper'].parentNode.removeChild(that[dir + 'ScrollbarWrapper']);
                        that[dir + 'ScrollbarWrapper'] = null;
                        that[dir + 'ScrollbarIndicator'] = null;
                    }

                    return;
                }

                if (!that[dir + 'ScrollbarWrapper']) {
                    // Create the scrollbar wrapper
                    bar = doc.createElement('div');

                    if (that.options.scrollbarClass) bar.className = that.options.scrollbarClass + dir.toUpperCase();
                    else bar.style.cssText = 'position:absolute;z-index:100;' + (dir == 'h' ? 'height:7px;bottom:1px;left:2px;right:' + (that.vScrollbar ? '7' : '2') + 'px' : 'width:7px;bottom:' + (that.hScrollbar ? '7' : '2') + 'px;top:2px;right:1px');

                    bar.style.cssText += ';pointer-events:none;-' + vendor + '-transition-property:opacity;-' + vendor + '-transition-duration:' + (that.options.fadeScrollbar ? '350ms' : '0') + ';overflow:hidden;opacity:' + (that.options.hideScrollbar ? '0' : '1');

                    that.wrapper.appendChild(bar);
                    that[dir + 'ScrollbarWrapper'] = bar;

                    // Create the scrollbar indicator
                    bar = doc.createElement('div');
                    if (!that.options.scrollbarClass) {
                        bar.style.cssText = 'position:absolute;z-index:100;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);-' + vendor + '-background-clip:padding-box;-' + vendor + '-box-sizing:border-box;' + (dir == 'h' ? 'height:100%' : 'width:100%') + ';-' + vendor + '-border-radius:3px;border-radius:3px';
                    }
                    bar.style.cssText += ';pointer-events:none;-' + vendor + '-transition-property:-' + vendor + '-transform;-' + vendor + '-transition-timing-function:cubic-bezier(0.33,0.66,0.66,1);-' + vendor + '-transition-duration:0;-' + vendor + '-transform:' + trnOpen + '0,0' + trnClose;

                    if (that.options.useTransition) bar.style.cssText += ';-' + vendor + '-transition-timing-function:cubic-bezier(0.33,0.66,0.66,1)';

                    that[dir + 'ScrollbarWrapper'].appendChild(bar);
                    that[dir + 'ScrollbarIndicator'] = bar;
                }

                if (dir == 'h') {
                    that.hScrollbarSize = that.hScrollbarWrapper.clientWidth;
                    that.hScrollbarIndicatorSize = m.max(m.round(that.hScrollbarSize * that.hScrollbarSize / that.scrollerW), 8);
                    that.hScrollbarIndicator.style.width = that.hScrollbarIndicatorSize + 'px';
                    that.hScrollbarMaxScroll = that.hScrollbarSize - that.hScrollbarIndicatorSize;
                    that.hScrollbarProp = that.hScrollbarMaxScroll / that.maxScrollX;
                } else {
                    that.vScrollbarSize = that.vScrollbarWrapper.clientHeight;
                    that.vScrollbarIndicatorSize = m.max(m.round(that.vScrollbarSize * that.vScrollbarSize / that.scrollerH), 8);
                    that.vScrollbarIndicator.style.height = that.vScrollbarIndicatorSize + 'px';
                    that.vScrollbarMaxScroll = that.vScrollbarSize - that.vScrollbarIndicatorSize;
                    that.vScrollbarProp = that.vScrollbarMaxScroll / that.maxScrollY;
                }

                // Reset position
                that._scrollbarPos(dir, true);
            },

            _resize: function () {
                var that = this;
                setTimeout(function () { that.refresh(); }, isAndroid ? 200 : 0);
            },

            _pos: function (x, y) {
                x = this.hScroll ? x : 0;
                y = this.vScroll ? y : 0;

                if (this.options.useTransform) {
                    this.scroller.style[vendor + 'Transform'] = trnOpen + x + 'px,' + y + 'px' + trnClose + ' scale(' + this.scale + ')';
                } else {
                    x = m.round(x);
                    y = m.round(y);
                    this.scroller.style.left = x + 'px';
                    this.scroller.style.top = y + 'px';
                }

                this.x = x;
                this.y = y;

                this._scrollbarPos('h');
                this._scrollbarPos('v');
            },

            _scrollbarPos: function (dir, hidden) {
                var that = this,
                    pos = dir == 'h' ? that.x : that.y,
                    size;


                if (!that[dir + 'Scrollbar']) return;

                pos = that[dir + 'ScrollbarProp'] * pos;

                if (pos < 0) {
                    if (!that.options.fixedScrollbar) {
                        size = that[dir + 'ScrollbarIndicatorSize'] + m.round(pos * 3);
                        if (size < 8) size = 8;
                        that[dir + 'ScrollbarIndicator'].style[dir == 'h' ? 'width' : 'height'] = size + 'px';
                    }
                    pos = 0;
                } else if (pos > that[dir + 'ScrollbarMaxScroll']) {
                    if (!that.options.fixedScrollbar) {
                        size = that[dir + 'ScrollbarIndicatorSize'] - m.round((pos - that[dir + 'ScrollbarMaxScroll']) * 3);
                        if (size < 8) size = 8;
                        that[dir + 'ScrollbarIndicator'].style[dir == 'h' ? 'width' : 'height'] = size + 'px';
                        pos = that[dir + 'ScrollbarMaxScroll'] + (that[dir + 'ScrollbarIndicatorSize'] - size);
                    } else {
                        pos = that[dir + 'ScrollbarMaxScroll'];
                    }
                }

                that[dir + 'ScrollbarWrapper'].style[vendor + 'TransitionDelay'] = '0';
                that[dir + 'ScrollbarWrapper'].style.opacity = hidden && that.options.hideScrollbar ? '0' : '1';
                that[dir + 'ScrollbarIndicator'].style[vendor + 'Transform'] = trnOpen + (dir == 'h' ? pos + 'px,0' : '0,' + pos + 'px') + trnClose;
                that[dir + 'ScrollbarIndicator'].style.top = pos + 'px';
            },

            _start: function (e) {
                var that = this,
                    point = hasTouch ? e.touches[0] : e,
                    matrix, x, y,
                    c1, c2;

                if (!that.enabled) return;

                if (that.options.onBeforeScrollStart) that.options.onBeforeScrollStart.call(that, e);

                if (that.options.useTransition || that.options.zoom) that._transitionTime(0);

                that.moved = false;
                that.animating = false;
                that.zoomed = false;
                that.distX = 0;
                that.distY = 0;
                that.absDistX = 0;
                that.absDistY = 0;
                that.dirX = 0;
                that.dirY = 0;

                // Gesture start
                if (that.options.zoom && hasTouch && e.touches.length > 1) {
                    c1 = m.abs(e.touches[0].pageX-e.touches[1].pageX);
                    c2 = m.abs(e.touches[0].pageY-e.touches[1].pageY);
                    that.touchesDistStart = m.sqrt(c1 * c1 + c2 * c2);

                    that.originX = m.abs(e.touches[0].pageX + e.touches[1].pageX - that.wrapperOffsetLeft * 2) / 2 - that.x;
                    that.originY = m.abs(e.touches[0].pageY + e.touches[1].pageY - that.wrapperOffsetTop * 2) / 2 - that.y;

                    if (that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                }

                if (that.options.momentum) {
                    if (that.options.useTransform) {
                        // Very lame general purpose alternative to CSSMatrix
                        matrix = getComputedStyle(that.scroller, null)[vendor + 'Transform'].replace(/[^0-9-.,]/g, '').split(',');
                        x = matrix[4] * 1;
                        y = matrix[5] * 1;
                    } else {
                        x = getComputedStyle(that.scroller, null).getPropertyValue("left").replace(/[^0-9-]/g, '') * 1;
                        y = getComputedStyle(that.scroller, null).getPropertyValue("top").replace(/[^0-9-]/g, '') * 1;
                    }

                    if (x != that.x || y != that.y) {
                        if (that.options.useTransition) that._unbind('webkitTransitionEnd');
                        else cancelFrame(that.aniTime);
                        that.steps = [];
                        that._pos(x, y);
                    }
                }

                that.absStartX = that.x;        // Needed by snap threshold
                that.absStartY = that.y;

                that.startX = that.x;
                that.startY = that.y;
                that.pointX = point.clientX;
                that.pointY = point.clientY;

                that.startTime = e.timeStamp || (new Date()).getTime();

                if (that.options.onScrollStart) that.options.onScrollStart.call(that, e);

                that._bind(MOVE_EV);
                that._bind(END_EV);
                that._bind(CANCEL_EV);
            },

            _move: function (e) {
                var that = this,
                    point = hasTouch ? e.touches[0] : e,
                    deltaX = point.clientX - that.pointX,
                    deltaY = point.clientY - that.pointY,
                    newX = that.x + deltaX,
                    newY = that.y + deltaY,
                    c1, c2, scale,
                    timestamp = e.timeStamp || (new Date()).getTime();

                if (that.options.onBeforeScrollMove) that.options.onBeforeScrollMove.call(that, e);

                // Zoom
                if (that.options.zoom && hasTouch && e.touches.length > 1) {
                    c1 = m.abs(e.touches[0].pageX - e.touches[1].pageX);
                    c2 = m.abs(e.touches[0].pageY - e.touches[1].pageY);
                    that.touchesDist = m.sqrt(c1*c1+c2*c2);

                    that.zoomed = true;

                    scale = 1 / that.touchesDistStart * that.touchesDist * this.scale;

                    if (scale < that.options.zoomMin) scale = 0.5 * that.options.zoomMin * Math.pow(2.0, scale / that.options.zoomMin);
                    else if (scale > that.options.zoomMax) scale = 2.0 * that.options.zoomMax * Math.pow(0.5, that.options.zoomMax / scale);

                    that.lastScale = scale / this.scale;

                    newX = this.originX - this.originX * that.lastScale + this.x,
                        newY = this.originY - this.originY * that.lastScale + this.y;

                    this.scroller.style[vendor + 'Transform'] = trnOpen + newX + 'px,' + newY + 'px' + trnClose + ' scale(' + scale + ')';

                    if (that.options.onZoom) that.options.onZoom.call(that, e);
                    return;
                }

                that.pointX = point.clientX;
                that.pointY = point.clientY;

                // Slow down if outside of the boundaries
                if (newX > 0 || newX < that.maxScrollX) {
                    newX = that.options.bounce ? that.x + (deltaX / 2) : newX >= 0 || that.maxScrollX >= 0 ? 0 : that.maxScrollX;
                }
                if (newY > that.minScrollY || newY < that.maxScrollY) {
                    newY = that.options.bounce ? that.y + (deltaY / 2) : newY >= that.minScrollY || that.maxScrollY >= 0 ? that.minScrollY : that.maxScrollY;
                }

                if (that.absDistX < 6 && that.absDistY < 6) {
                    that.distX += deltaX;
                    that.distY += deltaY;
                    that.absDistX = m.abs(that.distX);
                    that.absDistY = m.abs(that.distY);

                    return;
                }

                // Lock direction
                if (that.options.lockDirection) {
                    if (that.absDistX > that.absDistY + 5) {
                        newY = that.y;
                        deltaY = 0;
                    } else if (that.absDistY > that.absDistX + 5) {
                        newX = that.x;
                        deltaX = 0;
                    }
                }

                that.moved = true;
                that._pos(newX, newY);
                that.dirX = deltaX > 0 ? -1 : deltaX < 0 ? 1 : 0;
                that.dirY = deltaY > 0 ? -1 : deltaY < 0 ? 1 : 0;

                if (timestamp - that.startTime > 300) {
                    that.startTime = timestamp;
                    that.startX = that.x;
                    that.startY = that.y;
                }

                if (that.options.onScrollMove) that.options.onScrollMove.call(that, e);
            },

            _end: function (e) {
                if (hasTouch && e.touches.length != 0) return;

                var that = this,
                    point = hasTouch ? e.changedTouches[0] : e,
                    target, ev,
                    momentumX = { dist:0, time:0 },
                    momentumY = { dist:0, time:0 },
                    duration = (e.timeStamp || (new Date()).getTime()) - that.startTime,
                    newPosX = that.x,
                    newPosY = that.y,
                    distX, distY,
                    newDuration,
                    snap,
                    scale;

                that._unbind(MOVE_EV);
                that._unbind(END_EV);
                that._unbind(CANCEL_EV);

                if (that.options.onBeforeScrollEnd) that.options.onBeforeScrollEnd.call(that, e);

                if (that.zoomed) {
                    scale = that.scale * that.lastScale;
                    scale = Math.max(that.options.zoomMin, scale);
                    scale = Math.min(that.options.zoomMax, scale);
                    that.lastScale = scale / that.scale;
                    that.scale = scale;

                    that.x = that.originX - that.originX * that.lastScale + that.x;
                    that.y = that.originY - that.originY * that.lastScale + that.y;

                    that.scroller.style[vendor + 'TransitionDuration'] = '200ms';
                    that.scroller.style[vendor + 'Transform'] = trnOpen + that.x + 'px,' + that.y + 'px' + trnClose + ' scale(' + that.scale + ')';

                    that.zoomed = false;
                    that.refresh();

                    if (that.options.onZoomEnd) that.options.onZoomEnd.call(that, e);
                    return;
                }

                if (!that.moved) {
                    if (hasTouch) {
                        if (that.doubleTapTimer && that.options.zoom) {
                            // Double tapped
                            clearTimeout(that.doubleTapTimer);
                            that.doubleTapTimer = null;
                            if (that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                            that.zoom(that.pointX, that.pointY, that.scale == 1 ? that.options.doubleTapZoom : 1);
                            if (that.options.onZoomEnd) {
                                setTimeout(function() {
                                    that.options.onZoomEnd.call(that, e);
                                }, 200); // 200 is default zoom duration
                            }
                        } else {
                            that.doubleTapTimer = setTimeout(function () {
                                that.doubleTapTimer = null;

                                // Find the last touched element
                                target = point.target;
                                while (target.nodeType != 1) target = target.parentNode;

                                if (target.tagName != 'SELECT' && target.tagName != 'INPUT' && target.tagName != 'TEXTAREA') {
                                    ev = document.createEvent('MouseEvents');
                                    ev.initMouseEvent('click', true, true, e.view, 1,
                                        point.screenX, point.screenY, point.clientX, point.clientY,
                                        e.ctrlKey, e.altKey, e.shiftKey, e.metaKey,
                                        0, null);
                                    ev._fake = true;
                                    target.dispatchEvent(ev);
                                }
                            }, that.options.zoom ? 250 : 0);
                        }
                    }

                    that._resetPos(200);

                    if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                    return;
                }

                if (duration < 300 && that.options.momentum) {
                    momentumX = newPosX ? that._momentum(newPosX - that.startX, duration, -that.x, that.scrollerW - that.wrapperW + that.x, that.options.bounce ? that.wrapperW : 0) : momentumX;
                    momentumY = newPosY ? that._momentum(newPosY - that.startY, duration, -that.y, (that.maxScrollY < 0 ? that.scrollerH - that.wrapperH + that.y - that.minScrollY : 0), that.options.bounce ? that.wrapperH : 0) : momentumY;

                    newPosX = that.x + momentumX.dist;
                    newPosY = that.y + momentumY.dist;

                    if ((that.x > 0 && newPosX > 0) || (that.x < that.maxScrollX && newPosX < that.maxScrollX)) momentumX = { dist:0, time:0 };
                    if ((that.y > that.minScrollY && newPosY > that.minScrollY) || (that.y < that.maxScrollY && newPosY < that.maxScrollY)) momentumY = { dist:0, time:0 };
                }

                if (momentumX.dist || momentumY.dist) {
                    newDuration = m.max(m.max(momentumX.time, momentumY.time), 10);

                    // Do we need to snap?
                    if (that.options.snap) {
                        distX = newPosX - that.absStartX;
                        distY = newPosY - that.absStartY;
                        if (m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold) { that.scrollTo(that.absStartX, that.absStartY, 200); }
                        else {
                            snap = that._snap(newPosX, newPosY);
                            newPosX = snap.x;
                            newPosY = snap.y;
                            newDuration = m.max(snap.time, newDuration);
                        }
                    }

                    that.scrollTo(m.round(newPosX), m.round(newPosY), newDuration);

                    if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                    return;
                }

                // Do we need to snap?
                if (that.options.snap) {
                    distX = newPosX - that.absStartX;
                    distY = newPosY - that.absStartY;
                    if (m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold) that.scrollTo(that.absStartX, that.absStartY, 200);
                    else {
                        snap = that._snap(that.x, that.y);
                        if (snap.x != that.x || snap.y != that.y) that.scrollTo(snap.x, snap.y, snap.time);
                    }

                    if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                    return;
                }

                that._resetPos(200);
                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
            },

            _resetPos: function (time) {
                var that = this,
                    resetX = that.x >= 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x,
                    resetY = that.y >= that.minScrollY || that.maxScrollY > 0 ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;

                if (resetX == that.x && resetY == that.y) {
                    if (that.moved) {
                        that.moved = false;
                        if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);              // Execute custom code on scroll end
                    }

                    if (that.hScrollbar && that.options.hideScrollbar) {
                        if (vendor == 'webkit') that.hScrollbarWrapper.style[vendor + 'TransitionDelay'] = '300ms';
                        that.hScrollbarWrapper.style.opacity = '0';
                    }
                    if (that.vScrollbar && that.options.hideScrollbar) {
                        if (vendor == 'webkit') that.vScrollbarWrapper.style[vendor + 'TransitionDelay'] = '300ms';
                        that.vScrollbarWrapper.style.opacity = '0';
                    }

                    return;
                }

                that.scrollTo(resetX, resetY, time || 0);
            },

            _wheel: function (e) {
                var that = this,
                    wheelDeltaX, wheelDeltaY,
                    deltaX, deltaY,
                    deltaScale;

                e.returnValue = false;

                that.refresh();

                if ('wheelDeltaX' in e) {
                    wheelDeltaX = e.wheelDeltaX / 12;
                    wheelDeltaY = e.wheelDeltaY / 12;
                } else if ('detail' in e) {
                    wheelDeltaX = wheelDeltaY = -e.detail * 3;
                } else {
                    wheelDeltaX = wheelDeltaY = e.wheelDelta / 12;
                }

                if (that.options.wheelAction == 'zoom') {
                    deltaScale = that.scale * Math.pow(2, 1/3 * (wheelDeltaY ? wheelDeltaY / Math.abs(wheelDeltaY) : 0));
                    if (deltaScale < that.options.zoomMin) deltaScale = that.options.zoomMin;
                    if (deltaScale > that.options.zoomMax) deltaScale = that.options.zoomMax;

                    if (deltaScale != that.scale) {
                        if (!that.wheelZoomCount && that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                        that.wheelZoomCount++;

                        that.zoom(e.clientX, e.clientY, deltaScale, 400);

                        setTimeout(function() {
                            that.wheelZoomCount--;
                            if (!that.wheelZoomCount && that.options.onZoomEnd) that.options.onZoomEnd.call(that, e);
                        }, 400);
                    }

                    return;
                }

                deltaX = that.x + wheelDeltaX;
                deltaY = that.y + wheelDeltaY;

                if (deltaX > 0) deltaX = 0;
                else if (deltaX < that.maxScrollX) deltaX = that.maxScrollX;

                if (deltaY > that.minScrollY) deltaY = that.minScrollY;
                else if (deltaY < that.maxScrollY) deltaY = that.maxScrollY;

                that.scrollTo(deltaX, deltaY, 0);
            },

            _mouseout: function (e) {
                var t = e.relatedTarget;

                if (!t) {
                    this._end(e);
                    return;
                }

                while (t = t.parentNode) if (t == this.wrapper) return;

                this._end(e);
            },

            _transitionEnd: function (e) {
                var that = this;

                if (e.target != that.scroller) return;

                that._unbind('webkitTransitionEnd');

                that._startAni();
            },


            /**
             *
             * Utilities
             *
             */
            _startAni: function () {
                var that = this,
                    startX = that.x, startY = that.y,
                    startTime = (new Date).getTime(),
                    step, easeOut;

                if (that.animating) return;

                if (!that.steps.length) {
                    that._resetPos(400);
                    return;
                }

                step = that.steps.shift();

                if (step.x == startX && step.y == startY) step.time = 0;

                that.animating = true;
                that.moved = true;

                if (that.options.useTransition) {
                    that._transitionTime(step.time);
                    that._pos(step.x, step.y);
                    that.animating = false;
                    if (step.time) that._bind('webkitTransitionEnd');
                    else that._resetPos(0);
                    return;
                }

                (function animate () {
                    var now = (new Date).getTime(),
                        newX, newY;

                    if (now >= startTime + step.time) {
                        that._pos(step.x, step.y);
                        that.animating = false;
                        if (that.options.onAnimationEnd) that.options.onAnimationEnd.call(that);                        // Execute custom code on animation end
                        that._startAni();
                        return;
                    }

                    now = (now - startTime) / step.time - 1;
                    easeOut = m.sqrt(1 - now * now);
                    newX = (step.x - startX) * easeOut + startX;
                    newY = (step.y - startY) * easeOut + startY;
                    that._pos(newX, newY);
                    if (that.animating) that.aniTime = nextFrame(animate);
                })();
            },

            _transitionTime: function (time) {
                time += 'ms';
                this.scroller.style[vendor + 'TransitionDuration'] = time;
                if (this.hScrollbar) this.hScrollbarIndicator.style[vendor + 'TransitionDuration'] = time;
                if (this.vScrollbar) this.vScrollbarIndicator.style[vendor + 'TransitionDuration'] = time;
            },

            _momentum: function (dist, time, maxDistUpper, maxDistLower, size) {
                var deceleration = 0.0006,
                    speed = m.abs(dist) / time,
                    newDist = (speed * speed) / (2 * deceleration),
                    newTime = 0, outsideDist = 0;

                // Proportinally reduce speed if we are outside of the boundaries
                if (dist > 0 && newDist > maxDistUpper) {
                    outsideDist = size / (6 / (newDist / speed * deceleration));
                    maxDistUpper = maxDistUpper + outsideDist;
                    speed = speed * maxDistUpper / newDist;
                    newDist = maxDistUpper;
                } else if (dist < 0 && newDist > maxDistLower) {
                    outsideDist = size / (6 / (newDist / speed * deceleration));
                    maxDistLower = maxDistLower + outsideDist;
                    speed = speed * maxDistLower / newDist;
                    newDist = maxDistLower;
                }

                newDist = newDist * (dist < 0 ? -1 : 1);
                newTime = speed / deceleration;

                return { dist: newDist, time: m.round(newTime) };
            },

            _offset: function (el) {
                var left = -el.offsetLeft,
                    top = -el.offsetTop;

                while (el = el.offsetParent) {
                    left -= el.offsetLeft;
                    top -= el.offsetTop;
                }

                if (el != this.wrapper) {
                    left *= this.scale;
                    top *= this.scale;
                }

                return { left: left, top: top };
            },

            _snap: function (x, y) {
                var that = this,
                    i, l,
                    page, time,
                    sizeX, sizeY;

                // Check page X
                page = that.pagesX.length - 1;
                for (i=0, l=that.pagesX.length; i<l; i++) {
                    if (x >= that.pagesX[i]) {
                        page = i;
                        break;
                    }
                }
                if (page == that.currPageX && page > 0 && that.dirX < 0) page--;
                x = that.pagesX[page];
                sizeX = m.abs(x - that.pagesX[that.currPageX]);
                sizeX = sizeX ? m.abs(that.x - x) / sizeX * 500 : 0;
                that.currPageX = page;

                // Check page Y
                page = that.pagesY.length-1;
                for (i=0; i<page; i++) {
                    if (y >= that.pagesY[i]) {
                        page = i;
                        break;
                    }
                }
                if (page == that.currPageY && page > 0 && that.dirY < 0) page--;
                y = that.pagesY[page];
                sizeY = m.abs(y - that.pagesY[that.currPageY]);
                sizeY = sizeY ? m.abs(that.y - y) / sizeY * 500 : 0;
                that.currPageY = page;

                // Snap with constant speed (proportional duration)
                time = m.round(m.max(sizeX, sizeY)) || 200;

                return { x: x, y: y, time: time };
            },

            _bind: function (type, el, bubble) {
                var that = this;
                if (window.attachEvent) {
                    (el || this.scroller).attachEvent("on"+type, function(e) {
                        that.handleEvent(e);
                    });
                } else {
                    (el || this.scroller).addEventListener(type, this, !!bubble);
                }
            },

            _unbind: function (type, el, bubble) {
                var that = this;
                if (window.detachEvent) {
                    (el || this.scroller).detachEvent("on"+type,function(e) {
                        that.handleEvent(e);
                    });
                } else {
                    (el || this.scroller).removeEventListener(type, this, !!bubble);
                }
            },


            /**
             *
             * Public methods
             *
             */
            destroy: function () {
                var that = this;

                that.scroller.style[vendor + 'Transform'] = '';

                // Remove the scrollbars
                that.hScrollbar = false;
                that.vScrollbar = false;
                that._scrollbar('h');
                that._scrollbar('v');

                // Remove the event listeners
                that._unbind(RESIZE_EV, window);
                that._unbind(START_EV);
                that._unbind(MOVE_EV);
                that._unbind(END_EV);
                that._unbind(CANCEL_EV);

                if (that.options.hasTouch) {
                    that._unbind('mouseout', that.wrapper);
                    that._unbind(WHEEL_EV);
                }

                if (that.options.useTransition) that._unbind('webkitTransitionEnd');

                if (that.options.checkDOMChanges) clearInterval(that.checkDOMTime);

                if (that.options.onDestroy) that.options.onDestroy.call(that);
            },

            refresh: function () {
                var that = this,
                    offset,
                    i, l,
                    els,
                    pos = 0,
                    page = 0;

                if (that.scale < that.options.zoomMin) that.scale = that.options.zoomMin;
                that.wrapperW = that.wrapper.clientWidth || 1;
                that.wrapperH = that.wrapper.clientHeight || 1;

                that.minScrollY = -that.options.topOffset || 0;
                that.scrollerW = m.round(that.scroller.offsetWidth * that.scale);
                that.scrollerH = m.round((that.scroller.offsetHeight + that.minScrollY) * that.scale);
                that.maxScrollX = that.wrapperW - that.scrollerW;
                that.maxScrollY = that.wrapperH - that.scrollerH + that.minScrollY;
                that.dirX = 0;
                that.dirY = 0;

                if (that.options.onRefresh) that.options.onRefresh.call(that);

                that.hScroll = that.options.hScroll && that.maxScrollX < 0;
                that.vScroll = that.options.vScroll && (!that.options.bounceLock && !that.hScroll || that.scrollerH > that.wrapperH);

                that.hScrollbar = that.hScroll && that.options.hScrollbar;
                that.vScrollbar = that.vScroll && that.options.vScrollbar && that.scrollerH > that.wrapperH;

                offset = that._offset(that.wrapper);
                that.wrapperOffsetLeft = -offset.left;
                that.wrapperOffsetTop = -offset.top;

                // Prepare snap
                if (typeof that.options.snap == 'string') {
                    that.pagesX = [];
                    that.pagesY = [];
                    els = that.scroller.querySelectorAll(that.options.snap);
                    for (i=0, l=els.length; i<l; i++) {
                        pos = that._offset(els[i]);
                        pos.left += that.wrapperOffsetLeft;
                        pos.top += that.wrapperOffsetTop;
                        that.pagesX[i] = pos.left < that.maxScrollX ? that.maxScrollX : pos.left * that.scale;
                        that.pagesY[i] = pos.top < that.maxScrollY ? that.maxScrollY : pos.top * that.scale;
                    }
                } else if (that.options.snap) {
                    that.pagesX = [];
                    while (pos >= that.maxScrollX) {
                        that.pagesX[page] = pos;
                        pos = pos - that.wrapperW;
                        page++;
                    }
                    if (that.maxScrollX%that.wrapperW) that.pagesX[that.pagesX.length] = that.maxScrollX - that.pagesX[that.pagesX.length-1] + that.pagesX[that.pagesX.length-1];

                    pos = 0;
                    page = 0;
                    that.pagesY = [];
                    while (pos >= that.maxScrollY) {
                        that.pagesY[page] = pos;
                        pos = pos - that.wrapperH;
                        page++;
                    }
                    if (that.maxScrollY%that.wrapperH) that.pagesY[that.pagesY.length] = that.maxScrollY - that.pagesY[that.pagesY.length-1] + that.pagesY[that.pagesY.length-1];
                }

                // Prepare the scrollbars
                that._scrollbar('h');
                that._scrollbar('v');

                if (!that.zoomed) {
                    that.scroller.style[vendor + 'TransitionDuration'] = '0';
                    that._resetPos(200);
                }
            },

            scrollTo: function (x, y, time, relative) {
                var that = this,
                    step = x,
                    i, l;

                that.stop();

                if (!step.length) step = [{ x: x, y: y, time: time, relative: relative }];

                for (i=0, l=step.length; i<l; i++) {
                    if (step[i].relative) { step[i].x = that.x - step[i].x; step[i].y = that.y - step[i].y; }
                    that.steps.push({ x: step[i].x, y: step[i].y, time: step[i].time || 0 });
                }

                that._startAni();
            },

            scrollToElement: function (el, time) {
                var that = this, pos;
                el = el.nodeType ? el : that.scroller.querySelector(el);
                if (!el) return;

                pos = that._offset(el);
                pos.left += that.wrapperOffsetLeft;
                pos.top += that.wrapperOffsetTop;

                pos.left = pos.left > 0 ? 0 : pos.left < that.maxScrollX ? that.maxScrollX : pos.left;
                pos.top = pos.top > that.minScrollY ? that.minScrollY : pos.top < that.maxScrollY ? that.maxScrollY : pos.top;
                time = time === undefined ? m.max(m.abs(pos.left)*2, m.abs(pos.top)*2) : time;

                that.scrollTo(pos.left, pos.top, time);
            },

            scrollToPage: function (pageX, pageY, time) {
                var that = this, x, y;

                if (that.options.snap) {
                    pageX = pageX == 'next' ? that.currPageX+1 : pageX == 'prev' ? that.currPageX-1 : pageX;
                    pageY = pageY == 'next' ? that.currPageY+1 : pageY == 'prev' ? that.currPageY-1 : pageY;

                    pageX = pageX < 0 ? 0 : pageX > that.pagesX.length-1 ? that.pagesX.length-1 : pageX;
                    pageY = pageY < 0 ? 0 : pageY > that.pagesY.length-1 ? that.pagesY.length-1 : pageY;

                    that.currPageX = pageX;
                    that.currPageY = pageY;
                    x = that.pagesX[pageX];
                    y = that.pagesY[pageY];
                } else {
                    x = -that.wrapperW * pageX;
                    y = -that.wrapperH * pageY;
                    if (x < that.maxScrollX) x = that.maxScrollX;
                    if (y < that.maxScrollY) y = that.maxScrollY;
                }

                that.scrollTo(x, y, time || 400);
            },

            disable: function () {
                this.stop();
                this._resetPos(0);
                this.enabled = false;

                // If disabled after touchstart we make sure that there are no left over events
                this._unbind(MOVE_EV);
                this._unbind(END_EV);
                this._unbind(CANCEL_EV);
            },

            enable: function () {
                this.enabled = true;
            },

            stop: function () {
                if (this.options.useTransition) this._unbind('webkitTransitionEnd');
                else cancelFrame(this.aniTime);
                this.steps = [];
                this.moved = false;
                this.animating = false;
            },

            zoom: function (x, y, scale, time) {
                var that = this,
                    relScale = scale / that.scale;

                if (!that.options.useTransform) return;

                that.zoomed = true;
                time = time === undefined ? 200 : time;
                x = x - that.wrapperOffsetLeft - that.x;
                y = y - that.wrapperOffsetTop - that.y;
                that.x = x - x * relScale + that.x;
                that.y = y - y * relScale + that.y;

                that.scale = scale;
                that.refresh();

                that.x = that.x > 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x;
                that.y = that.y > that.minScrollY ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;

                that.scroller.style[vendor + 'TransitionDuration'] = time + 'ms';
                that.scroller.style[vendor + 'Transform'] = trnOpen + that.x + 'px,' + that.y + 'px' + trnClose + ' scale(' + scale + ')';
                that.zoomed = false;
            },

            isReady: function () {
                return !this.moved && !this.zoomed && !this.animating;
            }
        };

        if (typeof exports !== 'undefined') exports.IScroll_IE8 = IScroll_IE8;
        else window.IScroll_IE8 = IScroll_IE8;

    })();
}