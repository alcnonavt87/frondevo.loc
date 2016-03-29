/*
    Popup Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function Popup(params) {
    'use strict';
    var self = this;

    self.isMobDevice = self.isMobDevice = FRONDEVO ? FRONDEVO.controls.isMobDevice : false;
    self.elems = {
        $menu: $('.header-menu').eq(0),
        $menuItems: $('.header-menu .m-item'),
        $popup: $('.fd__popup'),
        $popupHtml: $('.pop-content').html().replace(/style=\"display: none;\"/g, ''),
        $hbMenu: $('.fd__hb-menu')
    };

    self.elems.$popup.remove();

    self.settings = {
    };

    $.extend(self.settings, params);

    self.popupCode = function (title, content, close){
        title = title ? title : '';
        content = content ? content : '';
        close = close ? close : '';
        return '<div class="fd__popup tEndElement">' +
            '    <div class="pop-wrap">' +
            '        <div class="queue-wrap queueFromTop">' +
            '            <h2 class="pop-title tEndElement queue queue1">' + title + '</h2>' +
            '        </div>' +
            '        <div class="pop-content queue-wrap queueFromBottom">' + content + '</div>' +
            '        <div title="' + close + '" class="pop-btn-close"></div>' +
            '    </div>' +
            '</div>';
    };
    self.popupMenuCode = function (content, close){
        content = content ? content : '';
        close = close ? close : '';

        return '<div class="fd__popup fd__popup_v2 tEndElement">' +
            '    <div class="pop-wrap">' + self.elems.$popupHtml + '</div>' +
            '    <div title="' + close + '" class="pop-btn-close">' +
            '    <span></span>' +
            '    </div>' +
            '</div>';
    };
    self.popups = {
    };


    self.init(params);

    return this;
}

Popup.prototype = {
    init: function () {
        'use strict';
        var self = this;

        self.controls();

        return this;
    },

    getMenuPopup: function (callback) {
        'use strict';
        var self = this,
            elems = self.elems,
            code = '<ul class="popup-menu">',
            dataCode = '';

        elems.$menuItems.each(function (key, value) {
            var obj = {
                popup: $(value).find('a, span').attr('data-popup'),
                popupTitle: $(value).find('a, span').attr('data-popup-title'),
                popupClose: $(value).find('a, span').attr('data-popup-close')
            };

            if (obj.popup) {
                dataCode = ' data-popup="' + obj.popup + '" data-popup-title="' + obj.popupTitle + '" data-popup-close="' + obj.popupClose + '"';
            }

            if ($(value).hasClass('active')) {
                code += '<li class="pm-item active queue queue' + (key + 1) + '"' + dataCode + '><span>' + $(value).text() + '</span></li>';
            } else {
                var $lnk = $(value).find('a').eq(0);
                code += '<li class="pm-item queue queue' + (key + 1) + '"' + dataCode + '><a href="' + $lnk.attr('href') + '">' + $lnk.text() + '</a></li>';
            }
        });
        code += '</ul>';
        self.popups.menu.code = code;

        if (typeof callback === 'function') {
            callback();
        }

        return this;
    },

    getPopupContent: function (obj, callback) {
        'use strict';
        var self = this;

        if (obj.popup === 'menu') {
            self.popups[obj.popup] = {
                title: obj.title,
                close: obj.close,
                popup: obj.popup
            };
            self.getMenuPopup(function () {
                if (typeof callback === 'function') {
                    callback(obj.popup);
                }
            });
        } else {
            var url = obj.url ? obj.url : 'popup/';

            /*$.ajax({
                url: url + obj.popup + '.html',
                dataType : 'html',
                complete: function (xhr, response) {
                    console.log(xhr, response);
                    self.popups[obj.popup] = {
                        title: obj.title,
                        close: obj.close,
                        popup: obj.popup,
                        code: xhr.responseText
                    };

                    if (typeof callback === 'function') {
                        callback(obj.popup);
                    }
                },
                error: function () {
                    alert('error!');
                }
            });*/
            self.popups[obj.popup] = {
                title: obj.title,
                close: obj.close,
                popup: obj.popup,
                code: self.elems.$popupHtml
            };

            if (typeof callback === 'function') {
                callback(obj.popup);
            }
        }

        return this;
    },

    openPopup: function (contentId) {
        'use strict';

        var self = this,
            $popup = {};

        switch (contentId) {
            case 'gmenu':
                $popup = $(self.popupMenuCode(self.popups[contentId].code, self.popups[contentId].close))
                break;
            default:
                $popup = $(self.popupCode(self.popups[contentId].title, self.popups[contentId].code, self.popups[contentId].close))
        }

        self.elems.$popup = $popup;
        self.elems.$popupTitleWrap = $popup.find('.pop-title').eq(0).parent();
        self.elems.$popupContent = $popup.find('.pop-wrap').eq(0);

        self.elems.$popupContent.removeClass('animate in');
        self.elems.$popupTitleWrap.removeClass('animate in');


        $('html').addClass('no-scroll');
        //$('.main-wrap').append($popup);
        $('body').append($popup);

        setTimeout(function () {
            $popup.addClass('visible');
            self.elems.$hbMenu.addClass('hidden');
            setTimeout(function () {
                /*self.elems.$popupContent.addClass('animate in');
                self.elems.$popupTitleWrap.addClass('animate in');*/
                self.elems.$popup.find('.queue-wrap').addClass('animate in');
                //self.elems.$popupTitleWrap.addClass('animate in');
            });
        }, 100);

        return this;
    },

    closePopup: function () {
        'use strict';

        var self = this,
            $title = self.elems.$popup.find('.pop-title').length ? self.elems.$popup.find('.pop-title') : self.elems.$popupContent.find('.fd__stripe').eq(0);

        self.elems.$popup.find('.queue-wrap').removeClass('in');
        /*self.elems.$popupContent.removeClass('in');
        self.elems.$popupTitleWrap.removeClass('in');*/

        $title.data('tcallback', {
            prop: 'opacity',
            callback: function () {
                self.elems.$popup.removeClass('visible');
                self.elems.$hbMenu.removeClass('hidden');
                $('html').removeClass('no-scroll');

                /*self.elems.$popupContent.removeClass('in');
                 self.elems.$popupTitleWrap.removeClass('in');*/

                // set callback after popup animation
                self.elems.$popup.data('tcallback', {
                    prop: 'opacity',
                    callback: function () {
                        self.elems.$popup.remove();
                        self.elems.$popup = null;
                    }
                });
                $title.data('tcallback', null);
            }
        });




        return this;
    },

    updateContent: function (obj) {
        'use strict';
        var self = this,
            $title = self.elems.$popup.find('.pop-title'),
            $qWrap = self.elems.$popup.find('.queue-wrap');

        $qWrap.eq(0).removeClass('in');
        $qWrap.eq(1).removeClass('in');

        // set callback after popup animation
        $title.data('tcallback', {
            prop: 'opacity',
            callback: function () {
                self.getPopupContent(obj, function () {
                    self.elems.$popupContent
                        .empty()
                        .append(self.popups[obj.popup].code);
                    $title.html(obj.title);
                    $qWrap = self.elems.$popup.find('.queue-wrap');

                    self.elems.$popupTitleWrap = self.elems.$popup.find('.pop-title').eq(0).parent();
                    self.elems.$popupContent = self.elems.$popup.find('.pop-content').eq(0);

                    $qWrap.eq(0).addClass('queueFromTop');
                    $qWrap.eq(1).addClass('queueFromBottom');

                    setTimeout(function () {
                        $qWrap.eq(0).addClass('in');
                        $qWrap.eq(1).addClass('in');
                        self.elems.$popup.find('.pop-title').data('tcallback', null);
                    }, 100);
                });
            }
        });

        return false;
    },

    createPopupObject: function (obj) {
        'use strict';
        var self = this;

        // если попап открыт
        if (!!self.elems.$popup) {
            obj.title = $obj.attr('data-popup-title');
            self.updateContent(obj);
            // если попап закрыт
        } else {
            if (self.popups[obj.popup]) {
                self.openPopup(obj.popup);
            } else {
                self.getPopupContent(obj, function (popup) {
                    self.openPopup(popup);
                });
            }
        }

        return this;
    },

    controls: function () {
        'use strict';
        var self = this,
            clickEvent = self.isMobDevice ? 'touchend MSPointerDown click' : 'click';

        $(document).on(clickEvent, '[data-popup]', function (event) {
            if (self.elems.$popup) {
                self.elems.$popup.remove();
                self.elems.$popup = null;
            }
            var $obj = $(this),
                obj = {
                    popup: $obj.attr('data-popup'),
                    title: $obj.attr('data-popup-title'),
                    close: $obj.attr('data-popup-close'),
                    url: $obj.attr('data-popup-url')
                };

            self.createPopupObject(obj);

            event.preventDefault();

        });

        $(document).on(clickEvent, '.pop-btn-close', function (event) {
            self.closePopup();
        });



        // temporary
        /*self.createPopupObject({
            popup: 'menu',
            title: 'Menu',
            close: 'Close',
            url: 'popup/'
        });*/

        return this;
    }
};
/**
 * Created by valerasiestov on 28.01.16.
 */


if (!window.module) {
    window.module = {};
}

module.scrollSlide = (function () {
    "use strict";

    var scrollTween,
        controls = {
            scrollTime: 0.3,
            scrollDistance: 150,
            scrollActivity: 1,
            maxScrollActivity: 4,
            desktop: matchMedia('(min-width: 1024px)')
        },
        handlers = {
            scroll: function () {
                var position = window.scrollTop || document.documentElement.scrollTop || document.body.scrollTop,
                    opacity = 1 - position / controls.height;

                if (opacity === 0) {
                    return;
                }

                if (controls.layout && controls.layout.style) {
                    controls.layout.style.cssText = 'opacity: ' + opacity + ';' + 'transform: translate3d(0, ' + (position - (1 - opacity) * controls.height / 2) + 'px, 0);';
                }
                if (controls.image && controls.image.style) {
                    controls.image.style.cssText = 'transform: scale(' + (1 + 0.3 * (1 - opacity)) + ') translate3d(0, 0, 0);';
                }
            },

            resize: function () {
                handlers.getSizes();

                if (controls.desktop.matches) {
                    if (controls.layout && controls.layout.style) {
                        controls.layout.style.cssText = '';
                    }
                    if (controls.layout && controls.image.style) {
                        controls.image.style.cssText = '';
                    }
                }
            },
            
            getSizes: function () {
                controls.height = window.innerHeight;
            },

            mouseWheel: function(event) {

                // set new scroll distance if scrolling is fast
                var newDistance = controls.scrollDistance,
                    newActivity;
                if (scrollTween) {
                    if (scrollTween.isActive()) {
                        newActivity = Math.abs(event.originalEvent.wheelDelta) * 0.001;
                        controls.scrollActivity *= (1 + newActivity);
                        controls.scrollActivity = controls.scrollActivity > controls.maxScrollActivity ? controls.maxScrollActivity : controls.scrollActivity;
                        newDistance = controls.scrollDistance * controls.scrollActivity;
                    } else {
                        controls.scrollActivity = 1;
                        newDistance = controls.scrollDistance;
                    }

                }

                if (!controls.desktop.matches) {
                    return;
                }

                event.preventDefault();

                var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
                var scrollTop = controls.$window.scrollTop();
                var finalScroll = scrollTop - parseInt(delta * newDistance);

                scrollTween = TweenMax.to(controls.$window, controls.scrollTime, {
                    scrollTo : { y: finalScroll, autoKill:true },
                    ease: Power1.easeOut,
                    autoKill: true,
                    overwrite: 5
                });

            }
        };

    function setEventList() {
        window.addEventListener('scroll', handlers.scroll, false);
        window.addEventListener('resize', handlers.resize, false);

        if (!FRONDEVO.browser.browser.firefox) {
            //$(controls.wrap).on("mousewheel DOMMouseScroll", handlers.mouseWheel);
            $(window).on("mousewheel DOMMouseScroll", handlers.mouseWheel);
        }
    }

    function getControls() {
        var wrap;

        controls.$window = $(window);
        controls.wrap = wrap = document.querySelector('.full-height.inner');
        //controls.image = wrap.querySelector('picture');
        controls.image = $(wrap).find('picture');
        //controls.layout = wrap.querySelector('.full-height__layout');
        controls.layout = $(wrap).find('.full-height__layout');

        handlers.getSizes();
    }

    function init(params) {
        getControls();
        setEventList();
    }

    return {
        init: init
    };

}());

window.addEventListener('DOMContentLoaded', function () {

    module.scrollSlide.init({

    });

}, false);

/*global window, setTimeout, document, module, matchMedia */
/**
 * @author Valeriy Siestov
 *
 * @description Main JS object of this site
 * @namespace
 * @property {object} browser - Contains data about browser and operation system
 */
var FRONDEVO = {
    controls: {
        desktop: matchMedia('(min-width: 1024px)')
    },
    browser: (function () {

        var os = '',
            version,
            ua = window.navigator.userAgent,
            platform = window.navigator.platform,
            result = {

                /**
                 * Contain operation system
                 *
                 * @member {Object}
                 */
                os: {
                    win: false,
                    mac: false,
                    linux: false,
                    android: false,
                    ios: false
                },

                /**
                 * Contain current browser
                 *
                 * @member {Object}
                 */
                browser: {
                    opera: false,
                    ie: false,
                    firefox: false,
                    chrome: false,
                    safari: false,
                    android: false
                },
                version: 0
            };

        if (/MSIE/.test(ua)) {
            version = /MSIE \d+[.]\d+/.exec(ua)[0].split(' ')[1];
            result.browser.ie = true;
            result.version = parseInt(version, 10);
        } else if (/Android/.test(ua)) {
            result.os.android = true;
            result.browser.android = true;

            if (/Chrome/.test(ua)) {
                version = /Chrome\/[\d\.]+/.exec(ua)[0].split('/')[1];
                result.version = parseInt(version, 10);
                result.browser.chrome = true;

                result.browser.android = false;
            }

            if (/Firefox/.test(ua)) {
                version = /Firefox\/[\.\d]+/.exec(ua)[0].split('/')[1];
                result.browser.firefox = true;
                result.version = parseInt(version, 10);

                result.browser.android = false;
            }

        } else if (/Chrome/.test(ua)) {
            version = /Chrome\/[\d\.]+/.exec(ua)[0].split('/')[1];
            result.browser.chrome = true;
            result.version = parseInt(version, 10);
        } else if (/Opera/.test(ua)) {
            result.browser.opera = true;
        } else if (/Firefox/.test(ua)) {
            version = /Firefox\/[\.\d]+/.exec(ua)[0].split('/')[1];
            result.browser.firefox = true;
            result.version = parseInt(version, 10);
        } else if (/Safari/.test(ua)) {

            if ((/iPhone/.test(ua)) || (/iPad/.test(ua)) || (/iPod/.test(ua))) {
                result.os.ios = true;
            }

            result.browser.safari = true;
        }

        if (!version) {

            version = /Version\/[\.\d]+/.exec(ua);

            if (version) {

                if (version) {
                    version = version[0].split('/')[1];
                } else {
                    version = /Opera\/[\.\d]+/.exec(ua)[0].split('/')[1];
                }

                result.version = parseInt(version, 10);
            } else {

                if (document.all.length) {
                    result.version = 11;
                    result.browser.ie = true;
                }

            }
        }

        if (platform === 'MacIntel' || platform === 'MacPPC') {
            result.os.mac = true;
        } else if (platform === 'Win32' || platform === 'Win64') {
            result.os.win = true;
        } else if (!os && /Linux/.test(platform)) {
            result.os.linux = true;
        } else if (!os && /Windows/.test(ua)) {
            result.os.win = true;
        } else if (!os && /android/.test(ua)) {
            result.os.android = true;
        }

        return result;

    }()),

    /**
     * Global functions
     *
     * @type {object}
     */
    global: {
        addEvents: function (list, event, handler) {
            var count = list.length,
                i;

            for (i = 0; i < count; i++) {
                list[i].addEventListener(event, handler, false);
            }
        },

        /**
         * Save touch state and position
         *
         * @method
         * @memberOf FRONDEVO
         * @param {Object} event - Touch event object
         */
        touchScrollStart: function (event) {
            "use strict";

            event.stopPropagation();
            this.allowUp = (this.scrollTop > 0);
            this.allowDown = (this.scrollTop < this.scrollHeight - this.clientHeight);
            this.lastY = event.touches[0].clientY;
        },

        /**
         * Check and process touch scrolling position
         *
         * @method
         * @memberOf FRONDEVO
         * @param {Object} event - Touch event object
         */
        touchScrollProcessing: function (event) {
            "use strict";

            if (FRONDEVO.controls.desktop.matches) {
                return;
            }

            var up = (event.touches[0].clientY > this.lastY),
                down = !up;

            this.lastY = event.touches[0].clientY;

            if ((up && this.allowUp) || (down && this.allowDown)) {
                event.stopPropagation();
            } else {
                if (this.scrollHeight !== this.clientHeight || this.scrollHeight + 1 !== this.clientHeight) {
                    event.preventDefault();
                }
            }
        },

        /**
         * Stretch object by rules of cover
         *
         * @memberOf FRONDEVO
         * @param {HTMLElement} object
         * @param {number} viewPortWidth
         * @param {number} viewPortHeight
         */
        cover: function (object, viewPortWidth, viewPortHeight) {
            "use strict";

            var viewPortRatio = viewPortWidth / viewPortHeight,
                imageRatio,
                resultWidth,
                resultHeight,
                hiddenTop = 0,
                hiddenLeft = 0;

            object.style.display = 'none'; // need for correct rendering in firefox (start)

            object.style.width = 'auto';
            object.style.height = 'auto';
            object.style.top = '';
            object.style.left = '';
            object.removeAttribute('width');
            object.removeAttribute('height');

            object.style.display = '';  // need for correct rendering in firefox (end)

            imageRatio = (object.width || object.videoWidth) / (object.height || object.videoHeight);

            if (imageRatio <= viewPortRatio) {
                resultWidth = viewPortWidth;
                resultHeight =  viewPortWidth / imageRatio;

                hiddenTop = (viewPortHeight - resultHeight) / 2;
            } else {
                resultWidth = viewPortHeight * imageRatio;
                resultHeight = viewPortHeight;

                hiddenLeft = (viewPortWidth - resultWidth) / 2;
            }

            object.style.display = 'none'; // need for correct rendering in firefox (start)

            object.width = resultWidth;
            object.height = resultHeight;
            object.style.width = resultWidth + 'px';
            object.style.height = resultHeight + 'px';
            object.style.top = hiddenTop + 'px';
            object.style.left = hiddenLeft + 'px';
            object.style.objectFit = 'unset';
            object.style.display = '';  // need for correct rendering in firefox (end)
        },

        /**
         * Stretch object by rules of contain
         *
         * @memberOf FRONDEVO
         * @param {HTMLElement} object
         * @param {number} viewPortWidth
         * @param {number} viewPortHeight
         */
        contain: function (object, viewPortWidth, viewPortHeight) {
            "use strict";

            var viewPortRatio = viewPortWidth / viewPortHeight,
                imageRatio = object.width / object.height,
                resultWidth,
                resultHeight,
                hiddenTop = 0,
                hiddenLeft = 0;

            if (imageRatio <= viewPortRatio) {
                resultWidth = viewPortHeight * imageRatio;
                resultHeight =  viewPortHeight;

                hiddenLeft = (viewPortWidth - resultWidth) / 2;
            } else {
                resultWidth = viewPortWidth;
                resultHeight = viewPortWidth / imageRatio;

                hiddenTop = (viewPortHeight - resultHeight) / 2;
            }

            object.width = resultWidth;
            object.height = resultHeight;
            object.style.width = resultWidth + 'px';
            object.style.height = resultHeight + 'px';
            object.style.top = hiddenTop + 'px';
            object.style.left = hiddenLeft + 'px';
        },

        fixFit: function (list) {
            var count = list.length,
                i,
                global = FRONDEVO.global,
                cover = global.cover,
                contain = global.contain,
                tempParent;

            if (window.CSS && CSS.supports('object-position', 'left top') && !FRONDEVO.browser.browser.firefox) {
                return;
            }

            for (i = 0; i < count; i++) {
                tempParent = list[i].parentNode;

                if (list[i].getAttribute('data-fit') === 'cover') {
                    cover(list[i], tempParent.clientWidth, tempParent.clientHeight);
                } else {
                    contain(list[i], tempParent.clientWidth, tempParent.clientHeight);
                }

            }

        },

        resizeForObjectFit: function (event) {
            var ctrl = FRONDEVO.controls,
                list = ctrl.objectFitList;

            clearTimeout(ctrl.resizeTimeout);
            ctrl.resizeTimeout = setTimeout(function () {
                FRONDEVO.global.fixFit(list);
            }, 500);
        },

        transitionEnd: function (event) {
            if ($(event.target).hasClass('tEndElement') || $(event.target).hasClass('tEndElement2')) {
                if ($(event.target).data('tcallback')) {
                    var callback = $(event.target).data('tcallback');
                    if (event.originalEvent.propertyName.indexOf(callback.prop) > -1) {
                        if (typeof callback.callback === 'function') {
                            callback.callback();
                        }
                    }

                }
            }

        },

        transitionEnd2: function (event) {
            if ($(event.target).hasClass('tEl')) {
                if ($(event.target).data('tcallback')) {
                    var callback = $(event.target).data('tcallback');

                    console.log('!!!');

                    if (event.originalEvent.propertyName.indexOf(callback.prop) > -1) {
                        if (typeof callback.callback === 'function') {
                            callback.callback();
                        }
                    }

                }
            }

        },

        formSubmit: function (event) {
            var form = event.target,
                formData;

            if (!module.validation.check(form)) {
                event.preventDefault();
                return;
            }

            if (!form.hasAttribute('data-ajax')) {
                return;
            }

            event.preventDefault();

            $(form).addClass('loading');
            formData = new FormData(form);

            fetch(form.getAttribute('action'), {
                method: form.getAttribute('method'),
                body: formData
            }).then(function (response) {
                module.listener.exec(form.getAttribute('id'), response);
                TweenMax.to(window, 0.3, {
                    scrollTo : { y: 0},
                    ease: Power1.easeOut
                });
            }).catch(function (error) {
                console.error('submit form error', error);
            });
        },

        formApplicationReceive: function (response) {
            var middle = document.querySelector('.middle-text'),
                answer = document.querySelector('.form-answer span');

            response.json().then(function (json) {
                answer.innerHTML = json.message;

                middle.classList.add('response');
            });
        }
    },

    /**
     * Get site controls
     *
     * @method
     * @memberOf FRONDEVO
     */
    getControls: function () {
        var ctrl = FRONDEVO.controls;

        ctrl.siteWrap = document.querySelector('.site-wrap');
    },

    /**
     * Set event listeners
     *
     * @method
     * @memberOf FRONDEVO
     */
    setEventList: function () {
        var ctrl = FRONDEVO.controls,
            global = FRONDEVO.global,
            siteWrap = ctrl.siteWrap;

        if (FRONDEVO.browser.os.ios) {
            global.addEvents([siteWrap], 'touchstart', global.touchScrollStart);
            global.addEvents([siteWrap], 'touchmove', global.touchScrollProcessing);
            window.addEventListener('resize', global.resizeForObjectFit, false);
        }

        $(document).on('transitionend', '.tEndElement', global.transitionEnd);
        $(document).on('transitionend', '.tEndElement2', global.transitionEnd2);
        window.addEventListener('submit', function (event) {
            // form validate apply
            $('[data-fld-attr-required]').each(function (key, value) {
                $.each( value.attributes, function( index, attr ) {
                    if (attr.name.search('data-fld-attr-') > -1) {
                        var realAttr = attr.name.match(/data-fld-attr-(.+)/)[1];
                        $(value).attr(realAttr, '');
                    }
                } );
            });

            global.formSubmit(event);
        }, false);

        if (window.module && module.listener) {
            module.listener.add({name: 'form-application', handler: global.formApplicationReceive});
        }

        // form start validate fix
        $('input').on('blur', function () {
            var el = this;
            $.each( el.attributes, function( index, attr ) {
                if (attr.name.search('data-fld-attr-') > -1) {
                    var realAttr = attr.name.match(/data-fld-attr-(.+)/)[1];
                    $(el).attr(realAttr, '');
                }
            } );
        });

        // scroll to by click on start screen's btn
        $('.full-height__layout .arrow').on('click', function () {
            TweenMax.to($(window), 1, {
                scrollTo: {y: $(window).height() * 0.4},
                ease:Power2.easeInOut
            });
        });

    },

    /**
     * Set startup configuration
     *
     * @method setConfig
     * @memberOf FRONDEVO
     */
    setConfig: function () {
        var ctrl = FRONDEVO.controls,
            global = FRONDEVO.global,
            list,
            count,
            i;

        ctrl.objectFitList = list = document.querySelectorAll('[data-fit]');
        count = list.length;

        for (i = 0; i < count; i++) {

            list[i].onload = function () {
                global.fixFit([this]);
            };

            if (list[i].complete) {
                global.fixFit([list[i]]);
            }
        }

        ctrl.isMobDevice = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|touch|opera mini/i
            .test(navigator.userAgent.toLowerCase()));

        ctrl.popup = new Popup();
        if (typeof FDWorks === 'function') {
            ctrl.works = new FDWorks();
        }

        if (window.MainLoader) {
            ctrl.mainLoader = new MainLoader();
        }

        if (window.viewportUnitsBuggyfill) {
            viewportUnitsBuggyfill.init();
        }

        // projects page modules
        if (window.ListScroll) {
            window.scrollDelta = {
                temp: 0,
                now: 1
            };
            ctrl.listScroll = new ListScroll();
        }
        if (window.ListScroll) {
            ctrl.projectsFilter = new ProjectsFilter();
        }

    },

    objectFitPolyfill: function () {
        if (!('object-fit' in document.body.style)) {
            $('[data-fd-object-fit]').each(function (key, value) {
                var src = $(this).attr('src');
                $(value).addClass('invisible');
                $(value).parent().css({'background': 'url(' + src + ')'});
            });
        }
    },

    /**
     * Init functionality of this site
     *
     * @constructs
     * @method init
     * @memberOf FRONDEVO
     */
    init: function () {
        window.addEventListener('DOMContentLoaded', function () {
            FRONDEVO.getControls();
            FRONDEVO.setEventList();
            FRONDEVO.setConfig();
            FRONDEVO.objectFitPolyfill();
        }, false);
    }
};

FRONDEVO.init();