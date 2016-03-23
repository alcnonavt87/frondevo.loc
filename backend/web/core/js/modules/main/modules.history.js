/**
 * Created by Valera Siestov on 23.12.13.
 */

/*global FRONDEVO_ADMIN, document, IScroll, $, TweenMax, alert, history, window */

FRONDEVO_ADMIN.core.namespace('modules.history');

/**
 * Class for manipulations of history
 *
 * @class History
 * @param param
 * @returns {*}
 * @constructor
 */
FRONDEVO_ADMIN.modules.History = function (param) {

    "use strict";

    var self = this,
        core = FRONDEVO_ADMIN.core,
        callback = param.callback || function () {},
        lastState,
        projectName = document.querySelector('.header__logo a'),
        logoText,
        handlers = {
            referenceClick: function (event) {
                core.preventDefault(event);

                var element = this,
                    title = element.getAttribute('title') || element.textContent || element.innerText,
                    location = window.location,
                    dataHref = element.getAttribute('data-href');

                if (element.className.indexOf('ui-selectmenu') > -1) {
                    return;
                }

                title = (logoText.textContent || logoText.innerText) +
                    ' [' + projectName.childNodes[0].nodeValue + '] -> ' + title;
                document.title = title;
                self.add(
                    title,
                    location.protocol + '//' + location.host + location.pathname + '#' + dataHref +
                        element.getAttribute('href')
                );
            }
        };

    /**
     * add state
     *
     * @method add
     * @param title {String} Page title
     * @param link (String) link
     */
    this.add = function (title, link) {

        if (lastState === link) {
            return;
        }

        lastState = link;

        history.pushState({title: title}, title, link);
    };

    this.back = function () {
        history.back();
    };

    /**
     * change url
     *
     * @method changeUrl
     */
    function changeUrl() {
        var url = window.location.hash;

        if (!url.length) {
            url = '';
        } else {
            url = url.replace('#', '');
        }

        lastState = '#' + url;

        if (url !== '') {
            callback(url);
        }
    }

    /**
     * add event listeners
     *
     * @method addEventList
     */
    function addEventList() {
        var wrap = param.wrap,
            jWrap = $(wrap);

        if (projectName) {
            logoText = projectName.querySelector('.logo__txt');
        } else {
            logoText = '';
        }

        jWrap.on('click', 'a[data-href]', handlers.referenceClick);

        $(window).on('popstate', function (event) {
            var state = event.originalEvent.state;

            document.title = state ? state.title : '';
            changeUrl();
        });
    }

    /**
     * init history module
     *
     * @method init
     */
    function init() {
        addEventList();
        changeUrl();
    }

    return init();
};