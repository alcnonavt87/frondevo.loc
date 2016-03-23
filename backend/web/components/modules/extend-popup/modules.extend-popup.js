/**
 * Created by Valera Siestov on 24.12.13.
 */

/*global FRONDEVO_ADMIN, document, IScroll, $, TweenMax, alert */

FRONDEVO_ADMIN.core.namespace('modules.ExtendPopup');

/**
 * Extend popup class
 *
 * @class ExtendPopup
 * @param param
 * @returns {*}
 * @constructor
 */
FRONDEVO_ADMIN.modules.ExtendPopup = function (param) {
    "use strict";

    var self = this;

    function init() {
        self.create = self.create(null);
        self.create.template(param);
        self.initParameters(param);
        self.addEventList();
    }

    return init();
};

/**
 * inherit Popup
 */
FRONDEVO_ADMIN.core.inherit(FRONDEVO_ADMIN.modules.ExtendPopup, FRONDEVO_ADMIN.modules.Popup.self());

/**
 * create popup
 *
 * @method create
 * @returns {{template: Function}}
 */
FRONDEVO_ADMIN.modules.ExtendPopup.prototype.create = function () {
    "use strict";
    var self = this;
    return {
        template: function (param) {

            var controls = self.controls,
                background = controls.background,
                popupContent = controls.popupContent;

            background.setAttribute('id', 'extend-popup');
            background.setAttribute('class', 'popup popup_extend');

            popupContent.innerHTML = param.data;

            document.body.appendChild(background);
            controls.inDom = true;
        }
    };

};

/**
 * show popup
 *
 * @method show
 */
FRONDEVO_ADMIN.modules.ExtendPopup.prototype.show = function (data) {
    "use strict";
    var self = this,
        controls = self.controls,
        popupContentStyle = controls.popupContent.style,
        popupContentChild = controls.popupContent.childNodes[0],
        handlers = self.handlers;

    if (controls.isVisible) {
        return;
    }

    if (data) {
        popupContentChild.innerHTML = data;
    }

    if (!controls.inDom) {
        document.body.appendChild(controls.background);
        controls.inDom = true;
    }

    controls.background.style.cssText = 'display: block; opacity: 0';

    popupContentStyle.width = popupContentChild.clientWidth + 'px';
    popupContentStyle.height = popupContentChild.clientHeight + 'px';

    handlers.beforeShowWindowCallback();
    handlers.showPopup(controls.background, controls.popup, controls.popupContent, function () {
        handlers.showWindowCallback();
    });
};

/**
 * Hide popup
 *
 * @method hide
 */
FRONDEVO_ADMIN.modules.ExtendPopup.prototype.handlers.hide = function () {
    "use strict";
    var controls = this.controls,
        handlers = this.handlers;

    handlers.beforeCloseWindowCallback();
    handlers.hidePopup(controls.background, controls.popup, controls, function () {
        handlers.closeWindowCallback();
    });
};

/**
 * Hide popup
 *
 * @method hide
 * @type {Function}
 */
FRONDEVO_ADMIN.modules.ExtendPopup.prototype.hide = FRONDEVO_ADMIN.modules.ExtendPopup.prototype.handlers.hide;

/**
 * init input parameters
 *
 * @method initParameters
 * @param param
 */
FRONDEVO_ADMIN.modules.ExtendPopup.prototype.initParameters = function (param) {
    "use strict";

    var inputHandlers,
        i,
        length,
        handlers = this.handlers,
        callback;

    callback = param.callback;

    if (callback.afterClose) {
        handlers.closeWindowCallback = callback.afterClose;
    } else {
        handlers.closeWindowCallback = function () {};
    }

    if (callback.beforeClose) {
        handlers.beforeCloseWindowCallback = callback.beforeClose;
    } else {
        handlers.beforeCloseWindowCallback  = function () {};
    }

    if (callback.afterShow) {
        handlers.showWindowCallback = callback.afterShow;
    } else {
        handlers.showWindowCallback = function () {};
    }

    if (callback.beforeShow) {
        handlers.beforeShowWindowCallback = callback.beforeShow;
    } else {
        handlers.beforeShowWindowCallback = function () {};
    }

    if (param.handlers) {
        inputHandlers = param.handlers;
        for (i = 0, length = inputHandlers.length; i < length; i++) {
            $(this.controls.popup).on(inputHandlers[i].type, inputHandlers[i].element, inputHandlers[i].f);
        }
    }
};
