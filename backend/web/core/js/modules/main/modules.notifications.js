/**
 * Created by Valera Siestov on 08.01.14.
 */

/*global FRONDEVO_ADMIN, document, IScroll, $, TweenMax, alert, history, window, setTimeout */

FRONDEVO_ADMIN.core.namespace('modules.Notification');

/**
 * Class for show notification message
 *
 * @class Notification
 * @returns {*}
 * @constructor
 */
FRONDEVO_ADMIN.modules.Notification = (function () {
    "use strict";

    var controls = {
            timeOut: 5000,
            messagesObjects: [],
            lastId: 1
        },

        /**
         * create object
         *
         * @property create
         * @type {{messageWindow: Function}}
         */
        create = {
            /**
             * Messages window
             *
             * @method messageWindow
             */
            messageWindow: function () {
                var html = [],
                    doc = document,
                    div = doc.createElement('div');

                //---- notifications
                div.setAttribute('class', 'notifications');

                html.push('<div class="notifications__icons"></div>');
                html.push('<div class="notifications__messages"></div>');

                //---/ notifications

                div.innerHTML = html.join('');

                doc.body.appendChild(div);

                controls.notifications = div;
                div.style.display = 'none';
            },

            /**
             * Create message item
             *
             * @method messageItem
             * @param data
             */
            messageItem: function (data) {
                var icon = document.createElement('div'),
                    message = document.createElement('div'),
                    messageId = 'notification-message__' + new Date().getTime(),
                    result,
                    messageText;

                if (controls.lastId === 1) {
                    controls.notifications.style.display = 'block';
                } else {
                    controls.icons.style.visibility = 'visible';
                }

                icon.setAttribute('id', messageId);
                icon.setAttribute('class', 'notifications__icon');
                icon.innerHTML = controls.lastId;

                message.setAttribute('data-id', messageId);
                message.setAttribute('class', 'notifications__message');

                if (data.message) {
                    messageText = data.message;

                    switch (data.type) {
                    case 'error':
                        icon.setAttribute('class', 'notifications__icon notifications_error');
                        message.setAttribute('class', 'notifications__message notifications_error');
                        break;
                    }

                } else {
                    messageText = data;
                }

                message.innerHTML =
                    '<div class="notifications__close"></div>' +
                    '<div class="notifications__data"><div>' + messageText + '</div></div>' +
                    '<div class="notifications__message-number">' + controls.lastId + '</div>';

                controls.lastId++;

                result = {
                    id: messageId,
                    icon: icon,
                    message: message
                };

                controls.messagesObjects.push(result);

                return result;
            }
        },

        /**
         * notifications events handlers
         *
         * @property handlers
         * @type {{show: Function, hide: Function}}
         */
        handlers = {

            iconsClick: function () {
                var element = this,
                    elementId = element.getAttribute('id'),
                    messages = controls.messagesObjects,
                    length = messages.length,
                    i;

                for (i = 0; i < length; i++) {

                    if (messages[i].id === elementId) {
                        $(messages[i].icon).addClass('active');
                        $(messages[i].message).addClass('active');
                    } else {
                        $(messages[i].icon).removeClass('active');
                        $(messages[i].message).removeClass('active');
                    }

                }
            },

            hideMessage: function () {
                handlers.hide(this.parentNode.getAttribute('data-id'));
            },

            /**
             * show new notification
             *
             * @method show
             * @param data
             */
            show: function (data) {
                var element = create.messageItem(data);

                TweenMax.to(element.icon, 0, {css: {width: 0, padding: 0}});
                controls.icons.appendChild(element.icon);

                TweenMax.to(element.message, 0, {css: {x: -20}});
                controls.messages.appendChild(element.message);

                TweenMax.to(element.message, 0.3, {css: {x: 0}, onComplete: function () {
                    $(element.icon.parentNode.parentNode.querySelector('.active')).removeClass('active');
                    $(element.icon).addClass('active');
                    TweenMax.to(element.icon, 0.2, {css: {width: 31, padding: '0 3px 0 0'}});
                }});

                setTimeout(function () {
                    handlers.hide(element.id);
                }, controls.timeOut);
            },

            /**
             * hide current notification
             *
             * @method show
             * @param currentNotificationId
             */
            hide: function (currentNotificationId) {

                function removeElement() {
                    var target = this.target;

                    target.parentNode.removeChild(target);
                }

                var messages = controls.messagesObjects,
                    length = messages.length,
                    i,
                    currentElement,
                    currentIco,
                    currentMessage;

                for (i = 0; i < length; i++) {
                    if (messages[i].id === currentNotificationId) {
                        currentElement = messages[i];

                        if (currentElement.icon.parentNode) {
                            currentIco = currentElement.icon;
                            currentMessage = currentElement.message;

                            TweenMax.to(currentIco, 0.3, {css: {opacity: 0}, onComplete: removeElement});
                            TweenMax.to(currentMessage, 0.3, {css: {opacity: 0}, onComplete: removeElement});

                            messages.splice(i, 1);
                        }

                        break;
                    }
                }

                if (!messages.length) {

                    TweenMax.to(controls.notifications, 0.3, {css: {opacity: 0}, onComplete: function () {
                        controls.lastId = 1;
                        controls.notifications.style.cssText = 'display: none;';
                        controls.icons.style.cssText = '';
                    }});

                }

            }
        };

    /**
     * get controls
     *
     * @method getControls
     */
    function getControls() {
        var notifications = controls.notifications;

        controls.icons = notifications.querySelector('.notifications__icons');
        controls.messages = notifications.querySelector('.notifications__messages');
    }

    /**
     * add event listeners
     *
     * @method addEventList
     */
    function addEventList() {
        $(controls.icons).on('click', '.notifications__icon', handlers.iconsClick);
        $(controls.messages).on('click', '.notifications__close', handlers.hideMessage);
    }

    /**
     * init
     *
     * @method init
     */
    function init() {
        create.messageWindow();
        getControls();
        addEventList();
    }

    init();

    return {
        show: handlers.show,
        hide: handlers.hide
    };

}());
