/* Scrollify */
!function(a,b){"use strict";"function"==typeof define&&define.amd?define(["jquery"],function(c){return b(c,a,a.document)}):"object"==typeof module&&module.exports?module.exports=b(require("jquery"),a,a.document):b(jQuery,a,a.document)}("undefined"!=typeof window?window:this,function(a,b,c,d){"use strict";function e(c,d,e,f){if(r===c&&(e=!1),z===!0)return!0;if(n[c]){if(w=!1,e&&G.before(c,o),s=1,E=m[c],C===!1&&r>c&&f===!1&&p[c]&&(s=parseInt(o[c].outerHeight()/u.height()),E=parseInt(m[c])+(o[c].outerHeight()-u.height())),G.updateHash&&G.sectionName&&(C!==!0||0!==c))if(history.pushState)try{history.replaceState(null,null,n[c])}catch(a){b.console&&console.warn("Scrollify warning: Page must be hosted to manipulate the hash value.")}else b.location.hash=n[c];if(C&&(G.afterRender(),C=!1),r=c,d)a(G.target).stop().scrollTop(E),e&&G.after(c,o);else{if(x=!0,a().velocity?a(G.target).stop().velocity("scroll",{duration:G.scrollSpeed,easing:G.easing,offset:E,mobileHA:!1}):a(G.target).stop().animate({scrollTop:E},G.scrollSpeed,G.easing),b.location.hash.length&&G.sectionName&&b.console)try{a(b.location.hash).length&&console.warn("Scrollify warning: ID matches hash value - this will cause the page to anchor.")}catch(a){}a(G.target).promise().done(function(){x=!1,C=!1,e&&G.after(c,o)})}}}function f(a){function b(b){for(var c=0,d=a.slice(Math.max(a.length-b,1)),e=0;e<d.length;e++)c+=d[e];return Math.ceil(c/b)}var c=b(10),d=b(70);return c>=d}function g(a,b){for(var c=n.length;c>=0;c--)"string"==typeof a?n[c]===a&&(q=c,e(c,b,!0,!0)):c===a&&(q=c,e(c,b,!0,!0))}var h,i,j,k,l,m=[],n=[],o=[],p=[],q=0,r=0,s=1,t=!1,u=a(b),v=u.scrollTop(),w=!1,x=!1,y=!1,z=!1,A=[],B=(new Date).getTime(),C=!0,D=!1,E=0,F="onwheel"in c?"wheel":c.onmousewheel!==d?"mousewheel":"DOMMouseScroll",G={section:".section",sectionName:"section-name",interstitialSection:"",easing:"easeOutExpo",scrollSpeed:1100,offset:0,scrollbars:!0,target:"html,body",standardScrollElements:!1,setHeights:!0,overflowScroll:!0,updateHash:!0,touchScroll:!0,before:function(){},after:function(){},afterResize:function(){},afterRender:function(){}},H=function(d){function g(b){a().velocity?a(G.target).stop().velocity("scroll",{duration:G.scrollSpeed,easing:G.easing,offset:b,mobileHA:!1}):a(G.target).stop().animate({scrollTop:b},G.scrollSpeed,G.easing)}function r(b){b&&(v=u.scrollTop());var c=G.section;p=[],G.interstitialSection.length&&(c+=","+G.interstitialSection),G.scrollbars===!1&&(G.overflowScroll=!1),a(c).each(function(b){var c=a(this);G.setHeights?c.is(G.interstitialSection)?p[b]=!1:c.css("height","auto").outerHeight()<u.height()||"hidden"===c.css("overflow")?(c.css({height:u.height()}),p[b]=!1):(c.css({height:c.height()}),G.overflowScroll?p[b]=!0:p[b]=!1):c.outerHeight()<u.height()||G.overflowScroll===!1?p[b]=!1:p[b]=!0}),b&&u.scrollTop(v)}function C(c,d){var f=G.section;G.interstitialSection.length&&(f+=","+G.interstitialSection),m=[],n=[],o=[],a(f).each(function(c){var d=a(this);c>0?m[c]=parseInt(d.offset().top)+G.offset:m[c]=parseInt(d.offset().top),G.sectionName&&d.data(G.sectionName)?n[c]="#"+d.data(G.sectionName).toString().replace(/ /g,"-"):d.is(G.interstitialSection)===!1?n[c]="#"+(c+1):(n[c]="#",c===a(f).length-1&&c>1&&(m[c]=m[c-1]+(parseInt(a(a(f)[c-1]).outerHeight())-parseInt(a(b).height()))+parseInt(d.outerHeight()))),o[c]=d;try{a(n[c]).length&&b.console&&console.warn("Scrollify warning: Section names can't match IDs - this will cause the browser to anchor.")}catch(a){}b.location.hash===n[c]&&(q=c,t=!0)}),!0===c&&e(q,!1,!1,!1)}function E(){return!p[q]||(v=u.scrollTop(),!(v>parseInt(m[q])))}function H(){return!p[q]||(v=u.scrollTop(),!(v<parseInt(m[q])+(o[q].outerHeight()-u.height())-28))}D=!0,a.easing.easeOutExpo=function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},j={handleMousedown:function(){return z===!0||(w=!1,void(y=!1))},handleMouseup:function(){return z===!0||(w=!0,void(y&&j.calculateNearest(!1,!0)))},handleScroll:function(){return z===!0||(h&&clearTimeout(h),void(h=setTimeout(function(){return y=!0,w!==!1&&(w=!1,void j.calculateNearest(!1,!0))},200)))},calculateNearest:function(a,b){v=u.scrollTop();for(var c,d=1,f=m.length,g=0,h=Math.abs(m[0]-v);d<f;d++)c=Math.abs(m[d]-v),c<h&&(h=c,g=d);(H()&&g>q||E())&&(q=g,e(g,a,b,!1))},wheelHandler:function(c){if(z===!0)return!0;if(G.standardScrollElements&&(a(c.target).is(G.standardScrollElements)||a(c.target).closest(G.standardScrollElements).length))return!0;p[q]||c.preventDefault();var d=(new Date).getTime();c=c||b.event;var g=c.originalEvent.wheelDelta||-c.originalEvent.deltaY||-c.originalEvent.detail,h=Math.max(-1,Math.min(1,g));if(A.length>149&&A.shift(),A.push(Math.abs(g)),d-B>200&&(A=[]),B=d,x)return!1;if(h<0){if(q<m.length-1&&H()){if(!f(A))return!1;c.preventDefault(),q++,x=!0,e(q,!1,!0,!1)}}else if(h>0&&q>0&&E()){if(!f(A))return!1;c.preventDefault(),q--,x=!0,e(q,!1,!0,!1)}},keyHandler:function(a){return z===!0||x!==!0&&void(38==a.keyCode||33==a.keyCode?q>0&&E()&&(a.preventDefault(),q--,e(q,!1,!0,!1)):40!=a.keyCode&&34!=a.keyCode||q<m.length-1&&H()&&(a.preventDefault(),q++,e(q,!1,!0,!1)))},init:function(){G.scrollbars?(u.on("mousedown",j.handleMousedown),u.on("mouseup",j.handleMouseup),u.on("scroll",j.handleScroll)):a("body").css({overflow:"hidden"}),u.on(F,j.wheelHandler),u.on("keydown",j.keyHandler)}},k={touches:{touchstart:{y:-1,x:-1},touchmove:{y:-1,x:-1},touchend:!1,direction:"undetermined"},options:{distance:30,timeGap:800,timeStamp:(new Date).getTime()},touchHandler:function(b){if(z===!0)return!0;if(G.standardScrollElements&&(a(b.target).is(G.standardScrollElements)||a(b.target).closest(G.standardScrollElements).length))return!0;var c;if("undefined"!=typeof b&&"undefined"!=typeof b.touches)switch(c=b.touches[0],b.type){case"touchstart":k.touches.touchstart.y=c.pageY,k.touches.touchmove.y=-1,k.touches.touchstart.x=c.pageX,k.touches.touchmove.x=-1,k.options.timeStamp=(new Date).getTime(),k.touches.touchend=!1;case"touchmove":k.touches.touchmove.y=c.pageY,k.touches.touchmove.x=c.pageX,k.touches.touchstart.y!==k.touches.touchmove.y&&Math.abs(k.touches.touchstart.y-k.touches.touchmove.y)>Math.abs(k.touches.touchstart.x-k.touches.touchmove.x)&&(b.preventDefault(),k.touches.direction="y",k.options.timeStamp+k.options.timeGap<(new Date).getTime()&&0==k.touches.touchend&&(k.touches.touchend=!0,k.touches.touchstart.y>-1&&Math.abs(k.touches.touchmove.y-k.touches.touchstart.y)>k.options.distance&&(k.touches.touchstart.y<k.touches.touchmove.y?k.up():k.down())));break;case"touchend":k.touches[b.type]===!1&&(k.touches[b.type]=!0,k.touches.touchstart.y>-1&&k.touches.touchmove.y>-1&&"y"===k.touches.direction&&(Math.abs(k.touches.touchmove.y-k.touches.touchstart.y)>k.options.distance&&(k.touches.touchstart.y<k.touches.touchmove.y?k.up():k.down()),k.touches.touchstart.y=-1,k.touches.touchstart.x=-1,k.touches.direction="undetermined"))}},down:function(){q<m.length-1&&(H()&&q<m.length-1?(q++,e(q,!1,!0,!1)):Math.floor(o[q].height()/u.height())>s?(g(parseInt(m[q])+u.height()*s),s+=1):g(parseInt(m[q])+(o[q].outerHeight()-u.height())))},up:function(){q>=0&&(E()&&q>0?(q--,e(q,!1,!0,!1)):s>2?(s-=1,g(parseInt(m[q])+u.height()*s)):(s=1,g(parseInt(m[q]))))},init:function(){c.addEventListener&&G.touchScroll&&(c.addEventListener("touchstart",k.touchHandler,!1),c.addEventListener("touchmove",k.touchHandler,!1),c.addEventListener("touchend",k.touchHandler,!1))}},l={refresh:function(a,b){clearTimeout(i),i=setTimeout(function(){r(!0),C(b,!1),a&&G.afterResize()},400)},handleUpdate:function(){l.refresh(!1,!1)},handleResize:function(){l.refresh(!0,!1)},handleOrientation:function(){l.refresh(!0,!0)}},G=a.extend(G,d),r(!1),C(!1,!0),!0===t?e(q,!1,!0,!0):setTimeout(function(){j.calculateNearest(!0,!1)},200),m.length&&(j.init(),k.init(),u.on("resize",l.handleResize),c.addEventListener&&b.addEventListener("orientationchange",l.handleOrientation,!1))};return H.move=function(b){return b!==d&&(b.originalEvent&&(b=a(this).attr("href")),void g(b,!1))},H.instantMove=function(a){return a!==d&&void g(a,!0)},H.next=function(){q<n.length&&(q+=1,e(q,!1,!0,!0))},H.previous=function(){q>0&&(q-=1,e(q,!1,!0,!0))},H.instantNext=function(){q<n.length&&(q+=1,e(q,!0,!0,!0))},H.instantPrevious=function(){q>0&&(q-=1,e(q,!0,!0,!0))},H.destroy=function(){return!!D&&(G.setHeights&&a(G.section).each(function(){a(this).css("height","auto")}),u.off("resize",l.handleResize),G.scrollbars&&(u.off("mousedown",j.handleMousedown),u.off("mouseup",j.handleMouseup),u.off("scroll",j.handleScroll)),u.off(F,j.wheelHandler),u.off("keydown",j.keyHandler),c.addEventListener&&G.touchScroll&&(c.removeEventListener("touchstart",k.touchHandler,!1),c.removeEventListener("touchmove",k.touchHandler,!1),c.removeEventListener("touchend",k.touchHandler,!1)),m=[],n=[],o=[],void(p=[]))},H.update=function(){return!!D&&void l.handleUpdate()},H.current=function(){return o[q]},H.disable=function(){z=!0},H.enable=function(){z=!1,D&&j.calculateNearest(!1,!1)},H.isDisabled=function(){return z},H.setOptions=function(c){return!!D&&void("object"==typeof c?(G=a.extend(G,c),l.handleUpdate()):b.console&&console.warn("Scrollify warning: setOptions expects an object."))},a.scrollify=H,H});