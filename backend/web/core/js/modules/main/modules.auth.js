/**
 * Created by Valera Siestov on 17.12.13.
 */

/*global FRONDEVO_ADMIN, $, console, document, TweenMax, alert, window*/

FRONDEVO_ADMIN.core.namespace('modules.Auth');

/**
 * @class Auth
 *
 * @constructor
 */
FRONDEVO_ADMIN.modules.Auth = function (param) {
    "use strict";

    var core = FRONDEVO_ADMIN.core,
        validate = FRONDEVO_ADMIN.global.validate,
        controls = {},
        showForget,
        showLogin,
        handlers = {

            /**
             * triggered when form submit
             *
             * @method formSubmit
             * @param event
             */
            formSubmit: function (event) {
                core.preventDefault(event);

                var form = this,
                    id = form.getAttribute('id');

                if (validate.check(form)) {
                    core.ajaxSend({
                        url: form.getAttribute('action'),
                        type: form.getAttribute('method'),
                        data: $(form).serialize(),
                        callback: function (response) {

                            var location = window.location;

                            if (id === 'auth-login') {

                                if (parseInt(response.code, 10) === 0) {
                                    window.location =
                                        location.protocol + '//' + location.host + location.pathname + response.message;
                                } else {
                                    alert(response.message);
                                }

                            } else if (id === 'auth-forget') {
                                if (!response.error) {
                                    alert(response.message, function () {
                                        showLogin();
                                    });
                                }
                            }
                        }
                    });
                }
            },

            /**
             * triggered when click by forget link
             *
             * @method forgetLinkClick
             */
            forgetLinkClick: function () {
                showForget();
            },

            /**
             * triggered when click by back button
             *
             * @method backButtonClick
             */
            backButtonClick: function () {
                showLogin();
            }
        };

    /**
     * add event listener
     *
     * @method addEventList
     */
    function addEventList() {
        $(param).on('submit', 'form', handlers.formSubmit);
        $(controls.forgetLink).on('click', handlers.forgetLinkClick);
        $(controls.backButton).on('click', handlers.backButtonClick);
    }

    /**
     * get page controls
     *
     * @method getControls
     */
    function getControls() {
        controls.formLogIn = param.querySelector('#auth-login');
        controls.formForget = param.querySelector('#auth-forget');
        controls.forgetLink = document.getElementById('auth-form__forget-link');
        controls.backButton = controls.formForget.querySelector('.auth-form_button-back');
        controls.createdBy = param.querySelector('.auth-form__created-by');
    }

    /**
     * show form
     *
     * @method show
     */
    function show() {

        function showCreateBy() {
            if (!controls.createdBy) {
                return;
            }

            if (window.addEventListener) {
                TweenMax.to(controls.createdBy, 0, {css: {y: 150, opacity: 0, visibility: 'visible'},
                    onComplete: function () {
                        TweenMax.to(controls.createdBy, 0.2, {css: {y: 0, opacity: 1}});
                    }});
            } else {
                controls.createdBy.style.visibility = 'visible';
            }
        }

        function animateActiveForm(activeForm, windowPosition, callback) {
            if (window.addEventListener) {
                TweenMax.to(activeForm, 0.0, {css: {opacity: 0, scaleX: 0.6, y: -120}, delay: 0.1,
                    onComplete: function () {
                        TweenMax.to(activeForm, 0.4, {css: {opacity: 1, scaleX: 1, y: 0},
                            onComplete: function () {
                                var browser = core.browser.browser;

                                if (browser.chrome || browser.safari || browser.firefox) {
                                    activeForm[0].querySelector('.input').focus();
                                }

                                if (callback) {
                                    callback(activeForm, windowPosition);
                                }
                            }});
                    }});
            } else {
                if (callback) {
                    callback(activeForm, windowPosition);
                }
            }
        }

        function animateForgetLink(activeForm, windowPosition) {
            activeForm[0].style.cssText = '';
            if (window.addEventListener) {
                if (windowPosition) {
                    TweenMax.to(controls.forgetLink, 0, {css: {y: 150, opacity: 0, visibility: 'visible'},
                        onComplete: function () {
                            TweenMax.to(controls.forgetLink, 0.2, {css: {y: 0, opacity: 1},
                                onComplete: function () {
                                    showCreateBy();
                                }});
                        }});
                } else {
                    showCreateBy();
                }
            } else {
                if (windowPosition) {
                    controls.forgetLink.style.visibility = 'visible';
                } else {
                    showCreateBy();
                }
            }
        }

        var logIn = $(controls.formLogIn),
            forget = $(controls.formForget),
            activeForm,
            windowPosition,
            windowPositionForCreatedBy;

        if (logIn.hasClass('active')) {
            activeForm = logIn;

            windowPosition = parseInt(activeForm.find('.auth__header').position().top + 8 + activeForm.height(), 10);
            controls.forgetLink.style.cssText = 'top: ' + windowPosition + 'px';
            windowPositionForCreatedBy = $(controls.forgetLink).offset().top + 52;

            if (controls.createdBy) {
                controls.createdBy.style.cssText = 'top: ' + windowPositionForCreatedBy + 'px';
            }
        } else if (forget.hasClass('active')) {
            activeForm = forget;
            windowPositionForCreatedBy = parseInt(activeForm.offset().top + 28 + activeForm.height(), 10);

            if (controls.createdBy) {
                controls.createdBy.style.cssText = 'top: ' + windowPositionForCreatedBy + 'px';
            }
        }

        if (!activeForm) {
            activeForm = logIn;
            activeForm.css({
                opacity: 0,
                display: 'block'
            });
        }

        animateActiveForm(activeForm, windowPosition, animateForgetLink);
    }

    /**
     * show forget form
     *
     * @method showForget
     */
    showForget = function () {

        function showWithoutAnimate(formLogIn, formForget) {
            formLogIn.removeClass('active');
            formLogIn[0].style.cssText = '';

            formForget.css({
                opacity: 0,
                display: 'block'
            });

            formForget.addClass('active');

            show();
        }

        var formForget = $(controls.formForget),
            formLogIn = $(controls.formLogIn);

        if (window.addEventListener) {

            if (controls.createdBy) {
                TweenMax.to(controls.createdBy, 0.2, {css: {opacity: 0, y: 50}});
            }

            TweenMax.to(formLogIn, 0.2, {css: {opacity: 0, scaleX: 0.6, y: -120}, delay: 0.1, onComplete: function () {
                showWithoutAnimate(formLogIn, formForget);
            }});
        } else {
            showWithoutAnimate(formLogIn, formForget);
        }
    };

    /**
     * show login form
     *
     * @method showLogin
     */
    showLogin = function () {

        function showWithoutAnimate(formForget, formLogin) {
            formForget.removeClass('active');
            formForget[0].style.cssText = '';

            formLogin.css({
                opacity: 0,
                display: 'block'
            });

            formLogin.addClass('active');

            show();
        }

        var formLogin = $(controls.formLogIn),
            formForget = $(controls.formForget);

        if (window.addEventListener) {

            if (controls.createdBy) {
                TweenMax.to(controls.createdBy, 0.2, {css: {opacity: 0, y: 50}});
            }

            TweenMax.to(formForget, 0.2, {css: {opacity: 0, scaleX: 0.6, y: -120}, delay: 0.1, onComplete: function () {
                showWithoutAnimate(formForget, formLogin);
            }});
        } else {
            showWithoutAnimate(formForget, formLogin);
        }

    };

    /**
     * init class
     *
     * @method init
     */
    function init() {
        getControls();
        addEventList();
        showLogin();
    }

    return init();
};