/**
 * Created by Valera Siestov on 11.04.14.
 */

/*global FRONDEVO_ADMIN, IScroll, IScroll_IE8, document, window */

FRONDEVO_ADMIN.core.namespace('modules.scrollContainer');

FRONDEVO_ADMIN.modules.scrollContainer = (function (app) {
    "use strict";

    var controls = {
        objects: []
    };

    function initScroll(object) {

        var controlsObjects = controls.objects,
            scrollContainer = document.createElement('div');

        scrollContainer.innerHTML = object.innerHTML;



        if (window.addEventListener) {
            controlsObjects.push(new IScroll(object, {
                mouseWheel: true,
                scrollbars: 'custom',
                scrollY: true,
                interactiveScrollbars: true,
                lockDirection: true
            }));

        } else {

            controlsObjects.push(new IScroll_IE8(object, {
                scrollbarClass: 'iScrollVerticalScrollbar',
                mouseWheel: true,
                scrollY: true
            }));

        }
    }

    function add(objects) {

        var count,
            i;

        count = objects.length;

        if (count) {

            for (i = 0; i < count; i++) {
                objects[i].removeAttribute('data-module');
                initScroll(objects[i]);
            }

        } else {

            if (!objects) {
                return;
            }

            objects.removeAttribute('data-module');
            initScroll(objects);
        }

    }

    return {
        add: add
    };

}(FRONDEVO_ADMIN));


FRONDEVO_ADMIN.config.scroll_container_init = function (object) {
    var modules = FRONDEVO_ADMIN.modules;

    if (object === undefined) {
        object = document.querySelectorAll('[data-module="scroll_container"]');
    }

    modules.scrollContainer.add(object);

};