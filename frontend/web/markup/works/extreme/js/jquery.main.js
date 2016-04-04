$(document).ready(function () {
    'use strict';

    // init page scrolls ================================
    $('.scroll-wrap').each(function (key, value) {
        // set scroller width in horizontal slider
        if ($(value).hasClass('horizontal')) {
            var $scroller = $(value).find('.scroller').eq(0),
                $list = $scroller.children().eq(0);
            $scroller.css({
                width: $list.width()
            })
        }

        // init scroll
        new IScroll(value, {
            mouseWheel: $(value).hasClass('horizontal') ? false : true,
            scrollbars: 'custom',
            interactiveScrollbars: true,
            scrollX: $(value).hasClass('horizontal') ? true : false,
            scrollY: $(value).hasClass('vertical') ? true : false,
            useTransform: true,
            mouseWheelSpeed: 150
        });
    });


    // footer slide ====================================
    if ($('.tour-select').length) {
        var $openBtn = $('.ts-cantchoose-btn').eq(0),
            $closeBtn = $('.ts-footer-close').eq(0),
            $footer = $('.ts-footer').eq(0),
            footerHeight = $footer.outerHeight();

        TweenMax.to($footer, 0.1, {
            css: {
                y: footerHeight
            },
            onComplete: function () {
                $footer.css('visibility', 'visible');
            }
        });

        $openBtn.on('click touchend', function (event) {
            if ($footer.length) {
                event.preventDefault();
                TweenMax.to($footer, 0.3, {
                    css: {
                        y: 0
                    }
                });
            }

        });
        $closeBtn.on('click touchend', function (event) {
            event.preventDefault();
            TweenMax.to($footer, 0.3, {
                css: {
                    y: footerHeight
                }
            });

        });
    }


    // max-height for catalo-1 items =================
    var $items = $('.ts-item');

        function setMaxHeight() {
            $items.css('max-height', $(window).height() * 0.4);
            $.each($items, function (key, value) {
                var $img = $(value).find('.ts-img img'),
                    height = Math.abs($(value).height() - $img.height()) * 0.5;
                $img.css({
                    marginTop: -height
                });
            });
        };
    setMaxHeight();
    $(window).resize(function () {
        if ($items.length) {
            setMaxHeight();
        }
    });


    // lightbox hover =================================
    $(document).on({
        mouseenter: function () {
            TweenMax.to($(this).find('img'), 0.2, {
                scale: 1.1
            });
        },
        mouseleave: function () {
            TweenMax.to($(this).find('img'), 0.2, {
                scale: 1
            });
        }
    }, '.lightbox-lnk');

    if (typeof ExFilter === 'function') {
        var filter = new ExFilter();
        setTimeout(function () {
            filter.getFiltered($('.icmsr-tab').eq(0));
        }, 1000);
    }


    // index slider init ===========================
    if ($('.fdo-slider').length) {
        new FDOSlider();
    }

    // hyphens =====================================
    if (typeof Hyphenator === 'object') {
        Hyphenator.config({
            useCSS3hyphenation: true,
            minwordlength : 4
        });
        Hyphenator.run();
    }


    // ya map ========================================
    function initMap(){
        var map = new ymaps.Map("ymap", {
            center: [61.789671, 34.360933],
            zoom: 16,
            controls: []
        });

        // add zoomControl
        map.controls.add('zoomControl', {
            float: "none",
            position: {
                top: 5,
                left: 5
            }
        });

        var placemark = new ymaps.Placemark([61.789671, 34.360933], {
             hintContent: 'Экстрим рейс',
             balloonContent: 'Мы здесь!'
         });

         map.geoObjects.add(placemark);
    }
    if (typeof ymaps === 'object') {
        ymaps.ready(initMap);
    }


    // feedback form =====================================
    var duration = 0.3;
    function toggleForm(action, $form){
        var $wrap = $form.parents('.form-wrap').eq(0),
            $btn = $wrap.find('[data-action=open]'),
            $overlay = $wrap.find('.icds-overlay').eq(0),
            $message = $wrap.find('.icds-message').eq(0),
            formType = $form.attr('data-status'),
            height = 'auto',
            btnHeight = $btn.height(),
            hideBtn = true,
            scaleX = 1,
            scaleY = 1,
            transformOfigin = 'center top';

        switch (formType) {
            case 'static':
                $form.css('height', 'auto');
                height = $form.outerHeight() + 20;
                $form.css('height', 0);
                scaleX = 0;
                scaleY = 0;
                break;
            case 'hint':
                btnHeight = 0;
                hideBtn = false;
                scaleX = 0;
                scaleY = 0;
                transformOfigin = 'center top';

                // form position
                if ($form.offset().left <= $('.site-header').eq(0).width()) {
                    $form.css({
                        left: '0px',
                        right: 'auto',
                        marginLeft: 0
                    });
                } else if ($form.offset().left + $form.width() >= $(window).width() - 22) {
                    $form.css({
                        left: 'auto',
                        right: 'right',
                        marginLeft: 0
                    });
                } else {
                    $form.css({
                        left: '50%',
                        right: 'auto',
                        marginLeft: -$form.width() * 0.5
                    });
                }

                break;
            default:
                $form
                    .css('height', 'auto');
                height = $form.outerHeight() + 20;
        }

        if (action === 'open') {
            $wrap.addClass('active');

            $message.css('visibility', 'hidden');

            if ($overlay.length) {
                TweenMax.to($overlay, duration, {
                    autoAlpha: 1
                });
            }

            TweenMax.fromTo($form, duration, {
                css: {
                    y: 10,
                    scaleX: scaleX,
                    scaleY: scaleY,
                    transformOrigin: transformOfigin
                },
                ease: Power1.easeOut
            }, {
                css: {
                    autoAlpha: 1,
                    y: -btnHeight,
                    height: height,
                    marginBottom: -btnHeight,
                    scaleX: 1,
                    scaleY: 1,
                    transformOrigin: transformOfigin
                },
                ease: Power1.easeOut,
                onComplete: function () {
                    $form.find('input, textarea').eq(0).focus();
                }
            });

            if (hideBtn) {
                TweenMax.fromTo($btn, duration, {
                    css: {
                        y: 0,
                        scaleX: 1,
                        scaleY: 1
                    },
                    ease: Power1.easeOut
                }, {
                    css: {
                        autoAlpha: 0,
                        y: -10,
                        scaleX: scaleX,
                        scaleY: scaleY
                    },
                    ease: Power1.easeOut
                });
            }
        } else {
            $wrap.removeClass('active');

            if ($overlay.length) {
                TweenMax.to($overlay, duration, {
                    autoAlpha: 0
                });
            }

            TweenMax.fromTo($form, duration, {
                css: {
                    y: -btnHeight,
                    height: height,
                    marginBottom: -btnHeight
                },
                ease: Power1.easeOut
            }, {
                css: {
                    autoAlpha: 0,
                    y: 10,
                    height: 0,
                    marginBottom: 0,
                    scaleX: scaleX,
                    scaleY: scaleY
                },
                ease: Power1.easeOut
            });
            if (hideBtn) {
                TweenMax.fromTo($btn, duration, {
                    css: {
                        y: -10,
                        scaleX: scaleX,
                        scaleY: scaleY
                    },
                    ease: Power1.easeOut
                }, {
                    css: {
                        autoAlpha: 1,
                        y: 0,
                        scaleX: 1,
                        scaleY: 1
                    },
                    ease: Power1.easeOut
                });
            }
        }

    };
    $('.form-wrap').each(function (key, value) {
        var $form = $(value).find('form').eq(0),
            $message = $form.find('.icds-message').eq(0),
            $messageText = $message.find('.icds-message-text').eq(0),
            $preloader = $(value).find('.icds-preloader').eq(0);

        $form.on({
            submit: function (event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function () {
                        TweenMax.to($preloader, duration, {
                            autoAlpha: 1
                        });
                    },
                    complete: function (xhr, status) {
                        var msg;

                        TweenMax.to($preloader, duration, {
                            autoAlpha: 0
                        });
                        TweenMax.to($message, duration, {
                            autoAlpha: 1
                        });
                        if (xhr.responseJSON) {
                            msg = xhr.responseJSON;

                            $messageText.html(msg.message);
                            if (msg.captcha === true) {
                                $form.find('input:not([type=button], [type=submit]), textarea').val('');
                            } else {
                                $form.find('.captcha-wrap img').attr('src', msg.src);
                                $message.addClass('error');

                                $message.find('.icds-message-btn').data('callback', function () {
                                    $form.find('.captcha-fld').focus();
                                    $message.removeClass('error');
                                });
                            }
                        } else {
                            $messageText.html('<p>Непредвиденная ошибка!</p><p>Повторите попытку позже.</p>');
                            TweenMax.to($preloader, duration, {
                                autoAlpha: 0
                            });
                        }

                    },
                    error: function () {
                        $messageText.html('<p>Непредвиденная ошибка!</p><p>Повторите попытку позже.</p>');
                        TweenMax.to($preloader, duration, {
                            autoAlpha: 0
                        });
                    }
                });

            }
        });
    });
    $('[data-form]').on({
        click: function (event) {
            event.preventDefault();
            var action = $(this).attr('data-action'),
                id = '#' + $(this).attr('data-form'),
                $message = $(this).parents('.icds-message').eq(0),
                isError = $message.hasClass('error'),
                callback = $(this).data('callback');

            if (!isError) {
                toggleForm(action, $(id));
            } else {
                TweenMax.to($message, 0.3, {
                    autoAlpha: 0
                });
                if (typeof callback === 'function') {
                    callback();
                };
            }

        }
    });

});