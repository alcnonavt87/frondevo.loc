/**
 * Created by Валерий on 24.12.13.
 */

/*global FRONDEVO_ADMIN, document, IScroll, $, TweenMax, alert, history, window */

FRONDEVO_ADMIN.core.namespace('modules.SideBar');

FRONDEVO_ADMIN.modules.SideBar = function (param) {

    "use strict";

    var self = this,
        controls = {
            rightPanelInDom: false
        },
        wrap = param.wrap,
        parentWrap = wrap.parentNode,
        callback = param.callback,
        rightSidebarCallback = {},
        handlers = {
            itemClick: function () {
                var element = this,
                    dataHref = element.getAttribute('data-href'),
                    link,
                    linkValue,
                    jElement = $(element);

                if (jElement.hasClass('sidebar-menu__item-active')) {
                    return;
                }

                jElement.parent(null).find('.sidebar-menu__item-active').removeClass('sidebar-menu__item-active');
                jElement.addClass('sidebar-menu__item-active');

                if (!dataHref) {
                    link = element.querySelector('a');
                    if (link) {
                        linkValue = link.getAttribute('href');
                    }
                } else {
                    linkValue = dataHref;
                }

                callback.click(link.getAttribute('data-href') + linkValue.replace('#', ''));
            },

            /**
             * right sidebar item click
             *
             * @method rightSidebarItemClick
             */
            rightSidebarItemClick: function () {
                var element = this,
                    jElement = $(element);

                if (jElement.hasClass('sidebar-menu__item-save')) {
                    rightSidebarCallback.click('save');
                } else if (jElement.hasClass('sidebar-menu__item-copy')) {
                    rightSidebarCallback.click('copy', jElement.attr('data-id'));
                } else if (jElement.hasClass('sidebar-menu__item-preview')) {
                    rightSidebarCallback.click('preview');
                } else if (jElement.hasClass('sidebar-menu__item-remove')) {
                    rightSidebarCallback.click('remove', jElement.attr('data-id'));
                }
            }
        };

    /**
     * add events listeners
     *
     * @method addEventList
     */
    function addEventList() {
        var jWrap = $(wrap);

        jWrap.on('click', '.sidebar-menu__item', handlers.itemClick);
        jWrap.parent().parent().on('click', '.sidebar_right .sidebar-menu__item', handlers.rightSidebarItemClick);
    }

    /**
     * init input parameters
     *
     * @method initInputParameters
     */
    function initInputParameters() {

        if (!callback.click) {
            callback.click = function () {};
        }
    }

    /**
     * create right panel
     *
     * @method createRightPanel
     * @returns {*|HTMLElement}
     */
    function createRightPanel() {
        var aside = document.createElement('aside');

        aside.setAttribute('class', 'sidebar sidebar_right');
        return aside;
    }

    /**
     * init module
     *
     * @method init
     */
    function init() {
        addEventList();
        initInputParameters();
    }

    /**
     * Click by right sidebar buttons
     *
     * @method rightSideBarClick
     * @param name
     */
    this.rightSideBarClick = function (name) {
        rightSidebarCallback.click(name);
    };

    /**
     * Set active menu
     *
     * @method setActiveMenu
     * @param link
     */
    this.setActiveMenu = function (link) {

        var items = wrap.querySelectorAll('a'),
            count = items.length,
            i,
            tempStr;

        for (i = 0; i < count; i++) {

            tempStr = items[i].href;
            tempStr = tempStr.substr(tempStr.indexOf('#') + 1);

            if (link.indexOf(tempStr) > -1) {
                $(items[i].parentNode).addClass('sidebar-menu__item-active');
            } else {
                $(items[i].parentNode).removeClass('sidebar-menu__item-active');
            }
        }
    };

    /**
     * remove active link (className)
     *
     * @method removeActiveLink
     */
    this.removeActiveLink = function () {
        $(wrap.querySelectorAll('.sidebar-menu__item')).removeClass('sidebar-menu__item-active');
    };

    /**
     * Show right panel
     *
     * @method showRightPanel
     * @param data
     * @param rightCallback
     */
    this.showRightPanel = function (data, rightCallback) {
        var rightPanel = controls.rightPanel;

        if (!rightPanel) {
            rightPanel = createRightPanel();
            controls.rightPanel = rightPanel;
        }

        if (rightCallback) {

            if (rightCallback.click) {
                rightSidebarCallback.click = rightCallback.click;
            } else {
                rightSidebarCallback.click = function () {};
            }

        } else {
            rightSidebarCallback.click = function () {};
        }

        rightPanel.innerHTML = data;
        $(parentWrap).after(rightPanel);
        controls.rightPanelInDom = true;
    };

    /**
     * get right panel status
     *
     * @method visibleRightPanel
     * @returns {boolean}
     */
    this.visibleRightPanel = function () {
        return controls.rightPanelInDom;
    };

    /**
     * hide right panel
     *
     * @method hideRightPanel
     */
    this.hideRightPanel = function () {

        var rightPanel = controls.rightPanel;

        if (!rightPanel || !controls.rightPanelInDom) {
            return;
        }

        rightPanel.parentNode.removeChild(rightPanel);
        controls.rightPanelInDom = false;
    };

    this.returnRightSidebar = function () {
        var rightPanel = controls.rightPanel;

        if (!controls.rightPanel) {
            rightPanel = document.querySelector('.sidebar_right .sidebar__menu');
        }

        return rightPanel;
    };

    this.getRemoveButtonId = function () {
        var rightPanel = controls.rightPanel,
            removeButton;

        if (!rightPanel) {
            rightPanel = self.returnRightSidebar()
        }

        removeButton = rightPanel.querySelector('.sidebar-menu__item-remove');

        if (removeButton) {
            return removeButton.getAttribute('data-id');
        }

        return null;
    };

    return init();
};