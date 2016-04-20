/**
 * Created by Valera Siestov on 23.12.13.
 */

/*global FRONDEVO_ADMIN, document, IScroll, $, TweenMax, alert, window */

FRONDEVO_ADMIN.core.namespace('modules.Table');

/**
 * Class for work with table
 *
 * @param param
 * @returns {*}
 * @constructor
 */
FRONDEVO_ADMIN.modules.Table = function (param) {
    "use strict";

    var self = this;

    self.controls = {};

    function init() {
        self.initParameters(param);
        self.addEventList(param);
        self.initSort(param);
    }

    return init();
};

FRONDEVO_ADMIN.modules.Table.prototype = {

    /**
     * Table event handlers
     *
     * @property handlers
     */
    handlers: {

        inputCheckBoxChange: function () {
            var input = this,
                element = $(this).parents('th'),
                index = element.index(),
                parent = element.parents('table').find('tbody');

            parent.find('tr td:nth-child(' + parseInt(index + 1, 10) + ')').each(function () {
                $(this).find('input')[0].checked = input.checked;
            });

        },

        inputCheckBoxChangeInTheBody: function () {
            var element = $(this),
                table = element.parents('table'),
                allCheckBox = table.find('#select-all'),
                theOtherCheckBox = table.find('tbody input[type="checkbox"]'),
                allSelected = true;

            theOtherCheckBox.each(function () {
                if (!this.checked) {
                    allSelected = false;
                }
            });

            allCheckBox[0].checked = allSelected;
        },

        inputUrlChange: function (event) {
            var element = this,
                url = element.getAttribute('data-url'),
                id = element.getAttribute('data-id'),
                currentRow = $(element).parents('tr');

            FRONDEVO_ADMIN.core.ajaxSend({
                url: url,
                data: 'id=' + id + '&name=' + this.name + '&value=' + this.value ,
                type: element.getAttribute('data-method') || 'get',
                dataType: 'json',
                callback: function (data) {
                    currentRow.html(data.content);
                },
                completeCallback: function (data) {
                    //console.log(data);
                }

            });

        },

        /**
         * Remove current row
         *
         * @method deleteButtonClick
         */
        deleteButtonClick: function (event) {
            "use strict";

            var self = this,
                controls = self.controls,
                row = $(event.target).parents('tr');

            alert({
                type: 'confirm',
                message: 'Хотите удалить запись?',
                controls: [
                    {
                        id: 'yes',
                        text: 'Да'
                    },
                    {
                        id: 'no',
                        text: 'Нет'
                    }
                ]
            }, function (button) {

                if (!$(button).hasClass('button')) {
                    return;
                }

                if (button && button.getAttribute('data-id') === 'yes') {

                    FRONDEVO_ADMIN.core.ajaxSend({
                        url: controls.baseUrl + 'formdel' + controls.action + '/' + row.attr('data-id'),
                        type: controls.method,
                        callback: function (data) {
                            TweenMax.to(row, 0.3, {css: {x: 150, opacity: 0}, onComplete: function () {
                                row.remove();
                                $(controls.table).trigger('update');
                                self.controls.removeCallback();
                            }});
                        }
                    });

                }

            });
        },

        /**
         * Click by row
         *
         * @method rowClick
         * @param element
         * @param event
         */
        rowClick: function (element, event) {
            "use strict";

            var self = this,
                controls = self.controls,
                action = controls.action,
                dataHref = controls.dataHref,
                dataId = element.getAttribute('data-id'),
                targetElement = event.target,
                jTargetElement = $(targetElement);

            if (targetElement.nodeName !== 'TD') {
                jTargetElement = jTargetElement.parents('td');
            }

            if (!dataId || !action || !dataHref || targetElement.hasAttribute('data-href') ||
                jTargetElement.hasClass('table__action-disabled')) {
                return;
            }

            if (element.mouseDown) {
                return;
            }

            controls.rowClick(dataHref + action + '/' + dataId, 'table-row-click');
        },

        cellClick: function (element, event) {
            "use strict";

            var self = this,
                jElement = $(element),
                sortDirection,
                dataName = element.getAttribute('data-name') || jElement.index(),
                controls = self.controls,
                table = controls.table,
                body = table.querySelector('tbody'),
                rowsCount = body.querySelectorAll('tr'),
                activePage = table.parentNode.querySelector('.pagination__active'),
                activePageIndex = '';

            if (jElement.hasClass('tablesorter-headerDesc')) {
                sortDirection = 'asc';
            } else if (jElement.hasClass('tablesorter-headerAsc')) {
                sortDirection = 'desc';
            } else {
                sortDirection = 'asc';
            }

            if (activePage) {
                activePageIndex = $(activePage).index();
            }

            FRONDEVO_ADMIN.core.ajaxSend({
                url: controls.baseUrl + controls.dataHref + controls.action + '/sort/' +
                    encodeURIComponent(sortDirection) + '/' + encodeURIComponent(dataName) + '/' +
                    encodeURIComponent(rowsCount.length) + '/' + encodeURIComponent(activePageIndex),
                callback: function (data) {

                    var fragment = document.createDocumentFragment(),
                        tempDiv = document.createElement('tbody');

                    tempDiv.innerHTML = data.content;

                    if (body) {
                        table.removeChild(body);
                    }

                    body = document.createElement('tbody');

                    while (tempDiv.firstChild) {
                        fragment.appendChild(tempDiv.firstChild);
                    }

                    body.appendChild(fragment);
                    table.appendChild(body);
                }
            });
        }
    },

    /**
     * add events to table
     *
     * @method addEventList
     *
     * @param param
     */
    addEventList: function (param) {
        "use strict";

        var self = this,
            jTable = $(param.table),
            handlers = this.handlers;

        jTable.on('change', 'th input[type="checkbox"]', handlers.inputCheckBoxChange);
        jTable.on('change', 'td input[type="checkbox"]', handlers.inputCheckBoxChangeInTheBody);
        jTable.on('change', 'td input[type="text"]', handlers.inputUrlChange);

        jTable.on('click', '.btn__delete', function (event) {
            FRONDEVO_ADMIN.core.stopPropagation(event);
            handlers.deleteButtonClick.call(self, event);
        });

        jTable.on('click', 'tr', function (event) {
            handlers.rowClick.call(self, this, event);
        });
    },

    addSortEvent: function (table) {
        "use strict";

        var self = this,
            handlers = this.handlers,
            jTable = $(table);

        jTable.on('click', 'thead th', function (event) {
            FRONDEVO_ADMIN.core.stopPropagation(event);
            handlers.cellClick.call(self, this, event);
        });
    },

    /**
     * Remove event listener
     *
     * @method removeEventList
     */
    removeEventList: function () {
        "use strict";

        var table = this.controls.table,
            jTable = $(table);

        jTable.off('click');
    },

    /**
     * init input parameters
     *
     * @method initParameters
     * @param param
     */
    initParameters: function (param) {
        "use strict";

        var controls = this.controls,
            table = param.table;

        controls.table = table;

        controls.baseUrl = param.baseUrl;
        controls.action = table.getAttribute('data-action');
        controls.method = table.getAttribute('data-method');
        controls.dataHref = table.getAttribute('data-href');

        if (param.removeCallback) {
            controls.removeCallback = param.removeCallback;
        } else {
            controls.removeCallback = function () {};
        }

        if (param.rowClick) {
            controls.rowClick = param.rowClick;
        } else {
            controls.rowClick = function () {};
        }
    },

    /**
     * init table sort
     *
     * @method initSort
     * @param param
     */
    initSort: function (param) {
        "use strict";

        var self = this,

            initTable = function (table) {
                var sortProperty,
                    sortType;

                sortProperty = param.table.getAttribute('data-sort');

                if (sortProperty) {
                    sortType = sortProperty;
                } else {
                    sortType = 'client-side';
                }

                switch (sortType) {
                case 'client-side':
                    var dateColumn = JSON.parse($(table).attr('data-table-date-column')),
                        params = {};

                    if (typeof dateColumn === 'object') {
                        $.tablesorter.addParser({
                            id: "dd.mm.yyyy",
                            is: function(s) {
                                return false;
                            },
                            format: function(s) {
                                s = "" + s;
                                var hit = s.match(/(\d{1,2})\.(\d{1,2})\.(\d{4})/);
                                if (hit && hit.length == 4) {
                                    return hit[3] + hit[2] + hit[1];
                                } else {
                                    return s;
                                }
                            },
                            type: "text"
                        });

                        params.headers = {};
                        $.each(dateColumn, function (key) {
                            params.headers[key] = {sorter:"dd.mm.yyyy"};
                        });
                    }

                    $(table).tablesorter(
                        params
                        /*{
                        sortList: [[0, 0]]
                    }*/);

                    break;

                case 'server-side':
                    self.addSortEvent(table);
                    break;
                }

            };

        if (!$.tablesorter) {
            FRONDEVO_ADMIN.core.include([
                    FRONDEVO_ADMIN.global.jsLibraryPath.name + 'jquery/jquery.tablesorter.min.js'
            ], function () {
                initTable(param.table);
            });
        } else {
            initTable(param.table);
        }
    },

    destroy: function () {
        "use strict";

        this.removeEventList();
    }
};

FRONDEVO_ADMIN.config.table_init = function (object) {
    var global = FRONDEVO_ADMIN.global,
        globalControls = global.controls,
        modules = FRONDEVO_ADMIN.modules,
        table = globalControls.table,
        objectsCount,
        i,
        initTable = function (object) {

            object.removeAttribute('data-module');

            table[table.length - 1] = new modules.Table({
                table: object,
                baseUrl: globalControls.baseUrl,
                rowClick: modules.listener.add
            });
        };

    if (!globalControls.table) {
        globalControls.table = [];
        table = globalControls.table;
    }

    if (object == undefined) {
        object = document.querySelectorAll('[data-module="table"]');
    }

    if (object instanceof Array || object instanceof NodeList) {
        objectsCount = object.length;

        for (i = 0; i < objectsCount; i++) {
            initTable(object[i]);
        }
    } else {
        initTable(object);
    }


};