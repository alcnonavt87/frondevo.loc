/**
 * Created by Кицюня on 29.01.14.
 */

/*global FRONDEVO_ADMIN, document, IScroll, $, TweenMax, alert, history, window, setTimeout */

FRONDEVO_ADMIN.core.namespace('modules.Calendar');

/**
 * Class for work with calendar
 *
 * @class Calendar
 * @returns {*}
 * @constructor
 */
FRONDEVO_ADMIN.modules.Calendar = function (object, destination) {
    "use strict";

    var self = this;
    this.controls = {};

    /**
     * add event listener
     *
     * @method addEventList
     */
    function addEventList() {
        var controls = self.controls,
            object = controls.object,
            handlers = self.handlers,
            jObject = $(object);

        jObject.on('click', '.calendar__change-period-right', function () {
            handlers.calendarRightClick.call(self, this);
        });

        jObject.on('click', '.calendar__change-period-left', function () {
            handlers.calendarLeftClick.call(self, this);
        });

        jObject.on('click', '.calendar-table-td', function () {
            handlers.calendarCellClick.call(self, this);
        });

        $(document.body).on('click', function (event) {
            handlers.bodyClick.call(self, event.target);
        });
    }

    /**
     * init calendar
     *
     * @method init
     */
    function init() {
        var controls = self.controls;
        controls.object = object;
        controls.destination = destination;
        controls.currentDate = new Date();
        addEventList();
    }

    return init();
};

FRONDEVO_ADMIN.modules.Calendar.prototype = {

    handlers: {
        bodyClick: function (element) {
            "use strict";

            var self = this,
                controls = self.controls,
                object = controls.object,
                className = element.className,
                dateInputs,
                dateInputsCount,
                i,
                queryResult;

            if (!className.length) {
                return;
            }

            queryResult = object.querySelector('.' + className.replace(/\s+/g, '.'));

            if (object === element || queryResult) {
                return;
            }

            if (this.isVisible) {
                dateInputs = document.body.querySelectorAll('[data-type="date"]');
                dateInputsCount = dateInputs.length;

                for (i = 0; i < dateInputsCount; i++) {

                    if (dateInputs[i].hasOwnProperty('calendar')) {

                        if (dateInputs[i].calendar.isVisible) {
                            dateInputs[i].calendar.hide();
                        }

                    }
                }

            }

        },

        calendarRightClick: function () {
            "use strict";
            this.getNewMonth('right');
        },

        calendarLeftClick: function () {
            "use strict";
            this.getNewMonth('left');
        },

        calendarCellClick: function (element) {
            "use strict";
            var self = this,
                controls = self.controls,
                calendar = controls.calendar,
                jCalendar = $(calendar),
                jElement = $(element),
                valueElement = element.querySelector('.calendar-table-td-value');

            if (!valueElement || jElement.hasClass('active')) {
                return;
            }

            if ($(valueElement).hasClass('calendar-table-td-disabled')) {
                return;
            }

            self.setDate(parseInt(valueElement.innerHTML, 10));
            jCalendar.find('td.active').removeClass('active');
            $(element).addClass('active');

            self.hide();
        }
    },

    getNewMonth: function (direction) {
        'use strict';

        var self = this,
            controls = self.controls,
            currentDate = controls.currentDate,
            Year = currentDate.getFullYear(),
            Month = currentDate.getMonth(),
            Day = currentDate.getDate();

        if (direction === 'left') {

            if (Month > 0) {
                Month -= 1;
            } else {
                Month = 11;
                Year -= 1;
            }

            if (Day > 28) {
                Day = 28;
            }
        } else {

            if (Month < 11) {
                Month += 1;
            } else {
                Month = 0;
                Year += 1;
            }

            if (Day > 28) {
                Day = 28;
            }
        }

        self.setDate(new Date(Year, Month, Day));
    },

    /**
     * get mont name by index
     *
     * @method getMonthName
     * @param Month
     * @returns {string}
     */
    getMonthName: function (Month) {
        'use strict';

        var monthName = '';
        switch (Month) {
        case 0:
            monthName = 'Январь';
            break;

        case 1:
            monthName = 'Февраль';
            break;

        case 2:
            monthName = 'Март';
            break;

        case 3:
            monthName = 'Апрель';
            break;

        case 4:
            monthName = 'Май';
            break;

        case 5:
            monthName = 'Июнь';
            break;

        case 6:
            monthName = 'Июль';
            break;

        case 7:
            monthName = 'Август';
            break;

        case 8:
            monthName = 'Сентябрь';
            break;

        case 9:
            monthName = 'Октябрь';
            break;

        case 10:
            monthName = 'Ноябрь';
            break;

        case 11:
            monthName = 'Декабрь';
            break;
        }
        return monthName;
    },

    /**
     * create table of dates
     *
     * @method createDateTable
     * @param node
     * @param currentDate
     */
    createDateTable: function (node) {

        'use strict';

        var self = this,
            controls = self.controls,
            currentDate = controls.currentDate,
            html = [],
            daysInMonth = 32 - new Date(currentDate.getFullYear(), currentDate.getMonth(), 32).getDate(),
            weekIndex = 0,
            dayStart = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay(),
            i,
            maxValue,
            subClass,
            oldMonth,
            day,
            newDay,
            index,
            j,
            table = document.createElement('table');

        table.setAttribute('class', 'calendar-table');

        html.push('<thead class="calendar-table-head">\n');
        html.push('<tr>\n');
        html.push('<th class="calendar-table-head-th">Пн</th>');
        html.push('<th class="calendar-table-head-th">Вт</th>');
        html.push('<th class="calendar-table-head-th">Ср</th>');
        html.push('<th class="calendar-table-head-th">Чт</th>');
        html.push('<th class="calendar-table-head-th">Пт</th>');
        html.push('<th class="calendar-table-head-th">Сб</th>');
        html.push('<th class="calendar-table-head-th">Вс</th>');
        html.push('</tr>\n');
        html.push('</thead>\n');

        html.push('<tbody class="calendar-table-body">');

        html.push('<tr class="calendar-table-tr">');

        if (dayStart === 0) {
            dayStart = 7;
        }

        for (i = -dayStart + 1, maxValue = parseInt((daysInMonth / 7), 10) + daysInMonth; i < maxValue; i++) {

            subClass = '';

            if (i < 0) {
                oldMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

                html.push('<td class="calendar-table-td">' +
                    '<span class="calendar-table-td-value calendar-table-td-disabled' + subClass + '">' +
                    parseInt(oldMonth.getDate() + 1, 10) +
                    '</span></td>');

            } else if (i >= 0 && i < daysInMonth) {

                day = currentDate.getDay();
                newDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), i).getDay();

                if (day === 0) {
                    day = 7;
                }

                if (newDay === 6 || newDay === 5) {
                    subClass = ' calendar-table-td-rest';
                }

                if (i + 1 === currentDate.getDate()) {

                    html.push('<td class="calendar-table-td active">' +
                        '<span class="calendar-table-td-value' + subClass + '">' +
                        parseInt(i + 1, 10) +
                        '</span></td>');

                } else {
                    html.push('<td class="calendar-table-td">' +
                        '<span class="calendar-table-td-value' + subClass + '">' +
                        parseInt(i + 1, 10) +
                        '</span></td>');
                }

            } else {

                if (weekIndex !== 0) {
                    index = 1;

                    for (j = weekIndex; j < 7; j++) {
                        html.push('<td class="calendar-table-td">' +
                            '<span class="calendar-table-td-value ' + subClass + ' calendar-table-td-disabled">' +
                            index +
                            '</span></td>');

                        index++;
                    }
                }
                break;

            }

            weekIndex++;

            if (weekIndex >= 7) {
                weekIndex = 0;
                html.push('</tr><tr class="calendar-table-tr">');
            }

        }

        html.push('</tr>');
        html.push('</tbody>');

        table.innerHTML = html.join('');
        node.appendChild(table);
    },

    createDatePeriod: function (node) {
        'use strict';

        var self = this,
            currentDate = self.controls.currentDate,
            text = self.getMonthName(currentDate.getMonth()) + ', ' + currentDate.getFullYear(),
            html = [],
            div = document.createElement('div');

        div.setAttribute('class', 'calendar__change-period');

        html.push('<span class="calendar__change-period-left active"></span>');
        html.push('<span class="calendar__change-period-right active"></span>');
        html.push('<span class="calendar__current-week">' + text + '</span>');

        div.innerHTML = html.join('');
        node.appendChild(div);
    },

    /**
     * Convert Date To String
     *
     * @method dateToString
     * @param inputDate
     * @returns {string}
     */
    dateToString: function (inputDate) {
        'use strict';

        var date = inputDate.getDate(),
            month = inputDate.getMonth() + 1;

        if (date.toString().length === 1) {
            date = '0' + date;
        }

        if (month.toString().length === 1) {
            month = '0' + month;
        }

        return date + '.' + month + '.' + inputDate.getFullYear();
    },

    /**
     * Convert String to Date
     *
     * @method stringToDate
     * @param inputString
     * @returns {Date}
     */
    stringToDate: function (inputString) {
        "use strict";
        var array;

        array = inputString.split('.');

        return new Date(array[2], parseInt(array[1], 10) - 1, array[0]);
    },

    setDate: function (value) {
        "use strict";

        var self = this,
            controls = self.controls,
            currentDate = controls.currentDate,
            calendar,
            destination = controls.destination;

        if (typeof value === 'number') {
            controls.currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), value);
        } else if (typeof value === 'object') {
            controls.currentDate = new Date(value);
            calendar = controls.calendar;
            calendar.innerHTML = '';
            self.createDatePeriod(calendar);
            self.createDateTable(calendar);
        } else if (typeof value === 'string') {
            controls.currentDate = new Date(self.stringToDate(value));
        }

        if ('undefined' !== destination.value) {
            destination.value = self.dateToString(controls.currentDate);
        } else if (destination.hasOwnProperty('innerHTML')) {
            destination.innerHTML = self.dateToString(controls.currentDate);
        }

    },

    /**
     * show calendar
     *
     * @method show
     */
    show: function (currentDate) {
        "use strict";

        var self = this,
            node = document.createElement('div'),
            controls = self.controls,
            object = controls.object,
            dateInputs = document.body.querySelectorAll('[data-type="date"]'),
            dateInputsCount = dateInputs.length,
            i;

        if (self.isVisible) {
            return;
        }

        for (i = 0; i < dateInputsCount; i++) {
            if (dateInputs[i].hasOwnProperty('calendar')) {
                if (dateInputs[i].calendar.isVisible) {
                    dateInputs[i].calendar.hide();
                }
            }
        }

        node.setAttribute('class', 'calendar-wrap');

        if (currentDate) {
            self.setDate(currentDate);
        }

        self.createDatePeriod(node);
        self.createDateTable(node);

        if (controls.hasOwnProperty('calendar')) {
            controls.calendar.innerHTML = '';
        }

        object.appendChild(node);
        controls.calendar = node;
        self.isVisible = true;
    },

    /**
     * hide calendar
     *
     * @method hide
     */
    hide: function () {
        "use strict";
        var self = this,
            controls = self.controls,
            calendar = controls.calendar;

        if (controls.object) {
            controls.object.removeChild(calendar);
            self.isVisible = false;
        }
    }

};

FRONDEVO_ADMIN.config.calendar_init = function (object) {
    var modules = FRONDEVO_ADMIN.modules,
        count,
        i,
        initCalendar = function (object) {
            var div = document.createElement('div');
            div.setAttribute('class', 'button__calendar');
            object.parentNode.appendChild(div);
            object.setAttribute('data-type', 'date');
            object.removeAttribute('data-module');
            object.calendar = new modules.Calendar(object.parentNode, object);
        };

    if (object === undefined) {
        object = document.querySelectorAll('.input[data-module="calendar"]');
    }

    if (object instanceof Array || object instanceof NodeList) {
        count = object.length;

        for (i = 0; i < count; i++) {
            initCalendar(object[i]);
        }

    } else {
        initCalendar(object);
    }

};