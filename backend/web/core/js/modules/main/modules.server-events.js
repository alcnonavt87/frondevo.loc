/**
 * Created by Valera Siestov on 25.12.13.
 */

/*global FRONDEVO_ADMIN, EventSource */

FRONDEVO_ADMIN.core.namespace('modules.sse');

/**
 *
 */
FRONDEVO_ADMIN.modules.sse = function (applicationHandlers) {
    "use strict";

    var controls = {},
        handlers = {
            open: function (event) {
                applicationHandlers.open(event.data);
            },

            message: function (event) {
                applicationHandlers.message(event.data);
            },

            error: function (event) {
                applicationHandlers.error(event.data);
            }
        };


    function getControls() {

        controls.eventSource = new EventSource("/sessionlife/sessionlife.php");

        if (applicationHandlers.open === undefined) {
            applicationHandlers.open = function () {};
        }

        if (applicationHandlers.message === undefined) {
            applicationHandlers.message = function () {};
        }

        if (applicationHandlers.error === undefined) {
            applicationHandlers.error = function () {};
        }
    }

    function addEventList() {
        var eventSource = controls.eventSource;
        eventSource.addEventListener("open", handlers.open, false);
        eventSource.addEventListener("message", handlers.message, false);
        eventSource.addEventListener("error", handlers.error, false);
    }

    function init() {
        getControls();
        addEventList();
    }

    return init();

};
