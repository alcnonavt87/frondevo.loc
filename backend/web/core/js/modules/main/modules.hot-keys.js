/**
 * Created by Valera Siestov on 09.01.14.
 */

/*global FRONDEVO_ADMIN, document, $, alert */

FRONDEVO_ADMIN.core.namespace('modules.HotKeys');

/**
 *
 */
FRONDEVO_ADMIN.modules.HotKeys = (function (app) {
    "use strict";

    var core = app.core,
        handlers = {
            /**
             * key down event handler
             *
             * @method bodyKeyDown
             */
            bodyKeyDown: function (event) {

                if (!app.global.controls.sidebar.visibleRightPanel()) {
                    return;
                }

                switch (event.keyCode) {
                case 83:

                    if (event.ctrlKey) {
                        core.preventDefault(event);
                        core.stopPropagation(event);
                        app.global.controls.sidebar.rightSideBarClick('save');
                    }

                    break;

                case 46:

                    if (event.ctrlKey) {
                        core.preventDefault(event);
                        core.stopPropagation(event);
                        alert('delete');
                    }

                    break;

                case 80:

                    if (event.ctrlKey) {
                        core.preventDefault(event);
                        core.stopPropagation(event);
                        alert('preview');
                    }

                    break;
                }
            }

        };

    function init() {
        var body = document.body,
            jBody = $(body);

        jBody.on('keydown', handlers.bodyKeyDown);
    }

    return init();
}(FRONDEVO_ADMIN));