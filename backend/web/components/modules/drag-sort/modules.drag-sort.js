
/**
 * Description: Sort Drag-and-drop
 * Author Valera Siestov
 * Date: 28.04.2014
 * Time: 16:05
 */

/*global FRONDEVO_ADMIN, window, document, $ */

/*jslint plusplus: true, continue: true */

FRONDEVO_ADMIN.core.namespace('modules.sortDragEndDrop');

FRONDEVO_ADMIN.modules.sortDragEndDrop = (function () {
    "use strict";

    var controls = {
            mouseOffset: null,
            oldY: 0
        },
        handlers = {

            /**
             * Drop
             *
             * @method drop
             * @param event
             * @returns {boolean}
             */
            drop: function (event) {

                if (event.stopPropagation) {
                    event.stopPropagation();
                }

                controls.dragSrcElement.style.opacity = '';

                if (controls.dragSrcElement !== this) {
                    controls.dragSrcElement.innerHTML = this.innerHTML;
                    this.innerHTML = event.dataTransfer.getData('text/html');
                }

                return false;
            },

            getPosition: function (e) {
                var left = 0,
                    top  = 0;

                if (e.offsetHeight === 0) {
                    e = e.firstChild;
                }

                while (e.offsetParent) {
                    left += e.offsetLeft;
                    top  += e.offsetTop;
                    e = e.offsetParent;
                }

                left += e.offsetLeft;
                top  += e.offsetTop;

                return {
                    x: left,
                    y: top
                };
            },

            mouseCoords: function (event) {

                if (event.pageX || event.pageY) {
                    return {
                        x: event.pageX,
                        y: event.pageY
                    };
                }
                return {
                    x: event.clientX + document.body.scrollLeft - document.body.clientLeft,
                    y: event.clientY + document.body.scrollTop  - document.body.clientTop
                };
            },

            getMouseOffset: function (target, event) {

                var docPos = handlers.getPosition(target),
                    mousePos = handlers.mouseCoords(event);

                return {
                    x: mousePos.x - docPos.x,
                    y: mousePos.y - docPos.y
                };
            },

            findDropTargetRow: function (y) {

                var rows = controls.table.querySelectorAll('[data-index]'),
                    currentRow,
                    rowsCount = rows.length,
                    i,
                    rowY,
                    rowHeight;

                for (i = 0; i < rowsCount; i++) {
                    currentRow = rows[i];
                    rowY = handlers.getPosition(currentRow).y;
                    rowHeight = parseInt(currentRow.offsetHeight, 10) / 2;

                    if (currentRow.offsetHeight === 0) {
                        rowY = handlers.getPosition(currentRow.firstChild).y;
                        rowHeight = parseInt(currentRow.firstChild.offsetHeight, 10) / 2;
                    }
                    if ((y > rowY - rowHeight) && (y < (rowY + rowHeight))) {
                        return currentRow;
                    }
                }

                return null;
            },

            makeDraggable: function (item) {

                if (!item) {
                    return;
                }

                var self = this; // Keep the context of the TableDnd inside the function

                console.log(self);

                item.onmousedown = function (event) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                        event.preventDefault();
                        event.stopImmediatePropagation();
                    } else {
                        event.returnValue = false;
                        event.cancelBubble = true;
                    }

                    this.mouseDown = true;
                    controls.startPosition = $(this).index();

                    controls.dragSrcElement = self;
                    controls.dragObject = this;
                    controls.mouseOffset = handlers.getMouseOffset(this, event);

                    console.log(controls.dragSrcElement);

                    return false;
                };
            },

            mouseTableMove: function (event) {

                var mousePos,
                    y,
                    movingDown,
                    currentRow;

                event.stopPropagation();

                if (controls.dragSrcElement && controls.dragObject) {

                    mousePos = handlers.mouseCoords(event);

                    y = mousePos.y - controls.mouseOffset.y;

                    if (y !== controls.oldY) {
                        movingDown = y > controls.oldY;
                        controls.oldY = y;
                        $(controls.dragObject).addClass('over');

                        currentRow = handlers.findDropTargetRow(y);

                        if (currentRow) {

                            if (movingDown && controls.dragObject !== currentRow) {
                                controls.dragObject.parentNode
                                    .insertBefore(controls.dragObject, currentRow.nextSibling);
                            } else if (!movingDown && controls.dragObject !== currentRow) {
                                controls.dragObject.parentNode.insertBefore(controls.dragObject, currentRow);
                            }
                        }
                    }

                    return false;
                }
            },

            mouseTableUp: function (event) {

                var droppedRow,
                    endPosition = null,
                    startPosition = controls.startPosition,
                    dataToSend = [],
                    i,
                    list = controls.table.querySelectorAll('[data-index]'),
                    listCount = controls.listCount;

                event.stopPropagation();

                if (controls.dragSrcElement && controls.dragObject) {
                    droppedRow = controls.dragObject;
                    endPosition = $(droppedRow).index();
                    $(droppedRow).removeClass('over');
                    controls.dragObject = null;
                    controls.dragSrcElement = null;
                }

                for (i = 0; i < listCount; i++) {

                    if (startPosition > endPosition) {
                        if (!(i >= endPosition && i <= startPosition)) {
                            continue;
                        }
                    } else {
                        if (!(i >= startPosition && i <= endPosition)) {
                            continue;
                        }
                    }

                    dataToSend.push({
                        index: list[i].getAttribute('data-index'),
                        position: $(list[i]).index()
                    });
                }

                if (dataToSend.length > 1) {
                    FRONDEVO_ADMIN.core.ajaxSend({
                        url: FRONDEVO_ADMIN.global.controls.baseUrl +
                        (controls.table.getAttribute('data-dragsort-url') || 'update') +
                            controls.table.getAttribute('data-action'),
                        data: 'list=' + JSON.stringify(dataToSend),
                        type: controls.table.getAttribute('data-method')
                    });
                }

            },

            mouseDown: function (event) {
                if (event.stopPropagation) {
                    event.stopPropagation();
                    event.preventDefault();
                    event.stopImmediatePropagation();
                } else {
                    event.returnValue = false;
                    event.cancelBubble = true;
                }

                this.mouseDown = true;
                controls.startPosition = $(this).index();

                controls.dragSrcElement = self;
                controls.dragObject = this;
                controls.mouseOffset = handlers.getMouseOffset(this, event);

                return false;
            }
        },
        self = handlers;

    function addEventList() {
        var table = controls.table,
            jTable = $(table);

        jTable.on('mouseup', handlers.mouseTableUp);

        jTable.on('mousemove', handlers.mouseTableMove);
        jTable.on('mousedown', '[data-index]', handlers.mouseDown);
    }

    function init(param) {
        var list = param.list,
            count = list.length,
            i;

        //controls.list = list;
        controls.listCount = count;
        controls.url = param.url;
        controls.table = param.table;

        addEventList();

        for (i = 0; i < count; i++) {
            list[i].setAttribute('draggable', 'draggable');
            //handlers.makeDraggable(list[i]);

        }
    }

    return {
        init: init
    };

}());

FRONDEVO_ADMIN.config.drag_sort_init = function (object) {

    var i,
        count,
        modules = FRONDEVO_ADMIN.modules,
        initDragSort = function (ds_object) {
            ds_object.removeAttribute('data-module');
            modules.sortDragEndDrop.init({
                list: ds_object.querySelectorAll('[data-index]'),
                url: ds_object.getAttribute('data-php'),
                table: ds_object.parentNode
            });
        };

    if (object === undefined) {
        object = document.querySelectorAll('[data-module="drag_sort"]');
    }

    if (object instanceof Array || object instanceof NodeList) {
        count = object.length;

        for (i = 0; i < count; i++) {
            initDragSort(object[i]);
        }

    } else {
        initDragSort(object);
    }

};