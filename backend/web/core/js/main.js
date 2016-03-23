
/*global document, window, $, alert, TweenMax, console, setInterval, tinymce, undefined */

/*jslint todo: true */

/**
 *
 * @type {{}}
 */
var FRONDEVO_ADMIN = {

    /**
     * Global variables
     *
     * @property global
     */
    global: {
        controls: {},
        loaded: []
    },

    /**
     * application core
     *
     * @property core
     */
    core: {

        /**
         * Property for work with DOM
         *
         * @property dom
         */
        dom: {
            /**
             * document content ready
             *
             * @method ready
             * @param callback
             */
            ready: function (callback) {
                "use strict";

                if (window.addEventListener) {
                    document.addEventListener("DOMContentLoaded", callback);
                } else {
                    window.onload = callback;
                }
            }
        },

        /**
         * Detect browser and OS
         *
         * @property browser
         */
        browser: (function () {
            "use strict";
            var os,
                version,
                ua = window.navigator.userAgent,
                platform = window.navigator.platform,
                result = {
                    os: {
                        win: false,
                        mac: false,
                        linux: false,
                        android: false,
                        ios: false
                    },
                    browser: {
                        opera: false,
                        ie: false,
                        firefox: false,
                        chrome: false,
                        safari: false,
                        android: false
                    },
                    version: 0
                };

            if (/MSIE/.test(ua)) {
                version = /MSIE \d+[.]\d+/.exec(ua)[0].split(' ')[1];
                result.browser.ie = true;
                result.version = parseInt(version, 10);
            } else if (/Chrome/.test(ua)) {
                version = /Chrome\/[\d\.]+/.exec(ua)[0].split('/')[1];
                result.browser.chrome = true;
                result.version = parseInt(version, 10);
            } else if (/Opera/.test(ua)) {
                result.browser.opera = true;
            } else if (/Android/.test(ua)) {
                result.os.android = true;
                result.browser.android = true;
            } else if (/Firefox/.test(ua)) {
                version = /Firefox\/[\.\d]+/.exec(ua)[0].split('/')[1];
                result.browser.firefox = true;
                result.version = parseInt(version, 10);
            } else if (/Safari/.test(ua)) {

                if ((/iPhone/.test(ua)) || (/iPad/.test(ua)) || (/iPod/.test(ua))) {
                    result.os.ios = true;
                }

                result.browser.safari = true;
            }

            if (!version) {

                version = /Version\/[\.\d]+/.exec(ua);

                if (version) {

                    if (version) {
                        version = version[0].split('/')[1];
                    } else {
                        version = /Opera\/[\.\d]+/.exec(ua)[0].split('/')[1];
                    }

                    result.version = parseInt(version, 10);
                } else {

                    if (document.all.length) {
                        result.version = 11;
                        result.browser.ie = true;
                    }

                }
            }

            if (platform === 'MacIntel' || platform === 'MacPPC') {
                result.os.mac = true;
            } else if (platform === 'Win32' || platform === 'Win64') {
                result.os.win = true;
            } else if (!os && /Linux/.test(platform)) {
                result.os.linux = true;
            } else if (!os && /Windows/.test(ua)) {
                result.os.win = true;
            } else if (!os && /android/.test(ua)) {
                result.os.android = true;
            }

            return result;
        }()),

        /**
         * ajaxSend
         *
         * @method ajaxSend
         * @param param
         */
        ajaxSend: function (param) {
            "use strict";
            $.ajax({
                url: param.url,
                data: param.data,
                type: param.type || 'get',
                dataType: param.dataType || 'json',
                success: function (serverResponse, status, xhr) {

                    if (xhr.status === 200) {

                        if (param.callback) {
                            param.callback(serverResponse);
                        }

                    } else {
                        alert(serverResponse.responseText);
                    }

                },
                error: function (xhr) {

                    var notification = FRONDEVO_ADMIN.modules.Notification;

                    switch (xhr.status) {

                    case 200:
                        //window.location.href = window.location.href;
                        break;

                    case 400:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (400)</h3>Неверный запрос'
                        });
                        break;

                    case 401:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (401)</h3>Пользователь не авторизирован'
                        });
                        break;

                    case 404:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (404)</h3>Страница ответа не найдена'
                        });
                        break;

                    case 405:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (405)</h3>Метод не поддерживается'
                        });
                        break;

                    case 406:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (406)</h3>' +
                                'Запрошенный URI не может удовлетворить переданным в заголовке характеристикам'
                        });
                        break;

                    case 407:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (407)<h3>Необходима аутентификация прокси'
                        });
                        break;

                    case 408:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (408)<h3>Истекло время ожидания'
                        });
                        break;

                    case 409:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (409)<h3>' +
                                'Запрос не может быть выполнен из-за конфликтного обращения к ресурсу'
                        });
                        break;

                    case 410:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (410)<h3>' +
                                'Ресур запроса был удален или недоступен'
                        });
                        break;

                    case 413:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (413)<h3>' +
                                'Сервер отказывается обработать запрос по причине слишком ' +
                                'большого размера тела запроса'
                        });
                        break;

                    case 414:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (414)<h3>' +
                                'Сервер не может обработать запрос из-за слишком длинного ' +
                                'указанного URL'
                        });
                        break;

                    case 415:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (415)<h3>' +
                                'Сервер отказывается работать с указанным типом данных при ' +
                                'данном методе'
                        });

                        break;

                    case 429:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (429)<h3>' +
                                'Клиент попытался отправить слишком много запросов за короткое время, что может ' +
                                'указывать, например, на попытку DoS-атаки'
                        });

                        break;

                    case 431:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (431)<h3>' +
                                'Превышена допустимая длина заголовков'
                        });
                        break;

                    case 434:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (434)<h3>' +
                                'Запрашиваемый адрес недоступен'
                        });
                        break;

                    case 451:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка клиента (451)<h3>' +
                                'доступ к ресурсу закрыт по юридическим причинам, например, по требованию органов ' +
                                'государственной власти или по требованию правообладателя в случае нарушения ' +
                                'авторских прав.'
                        });

                        break;

                    case 500:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (500)</h3>'
                        });

                        break;

                    case 501:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (501)</h3>' +
                                'Сервер не поддерживает возможностей, необходимых для обработки запроса'
                        });

                        break;

                    case 502:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (502)</h3>' +
                                'Сервер получил недействительное ответное сообщение от вышестоящего сервера'
                        });

                        break;

                    case 503:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (503)</h3>' +
                                'Сервер временно не имеет возможности обрабатывать запросы по техническим причинам'
                        });

                        break;

                    case 504:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (504)</h3>' +
                                'Сервер в роли шлюза или прокси-сервера не дождался ответа от ' +
                                'вышестоящего сервера для завершения текущего запроса'
                        });

                        break;

                    case 505:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (505)</h3>' +
                                'Сервер не поддерживает или отказывается поддерживать указанную ' +
                                'в запросе версию протокола HTTP'
                        });
                        break;

                    case 506:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (506)</h3>' +
                                'В результате ошибочной конфигурации выбранный вариант указывает ' +
                                'сам на себя, из-за чего процесс связывания прерывается'
                        });
                        break;

                    case 507:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (507)</h3>' +
                                'Не хватает места для выполнения текущего запроса'
                        });

                        break;

                    case 509:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (509)</h3>' +
                                'Владельцу площадки следует обратиться к своему хостинг-провайдеру'
                        });

                        break;

                    case 510:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (510)</h3>' +
                                'На сервере отсутствует расширение, которое желает использовать ' +
                                'клиент'
                        });
                        break;

                    case 511:
                        notification.show({
                            type: 'error',
                            message: '<h3>Ошибка сервера (510)</h3>' +
                                'Этот ответ посылается не сервером, которому был предназначен ' +
                                'запрос, а сервером-посредником — например, сервером провайдера — в случае, если ' +
                                'клиент должен сначала авторизоваться в сети, например, ввести пароль для платной ' +
                                'точки доступа к Интернету'
                        });
                        break;

                    default:
                        alert(xhr.responseText);
                    }
                },
                complete: param.completeCallback || function () {}
            });
        },

        /**
         * stop event propagation
         *
         * @param event
         */
        stopPropagation: function (event) {
            "use strict";

            if (event.stopPropagation) {
                event.stopPropagation();
            } else {
                event.cancelBubble = true;
            }
        },

        /**
         * return event default
         *
         * @param event
         */
        preventDefault: function (event) {
            "use strict";

            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
        },

        /**
         * get root path of the script
         *
         * @param scriptName
         * @returns {*}
         */
        getLibraryPath: function (scriptName) {

            "use strict";

            var scripts = document.querySelectorAll('script'),
                lengthScripts = scripts.length,
                i;

            for (i = 0; i < lengthScripts; i++) {

                if (scripts[i].src.indexOf(scriptName) > -1) {
                    return {
                        name: scripts[i].src.replace(scriptName, ''),
                        obj: scripts[i]
                    };
                }

            }

            return null;
        },

        /**
         * Include
         *
         * @method include
         * @param {String, Array} href Event object
         * @param {Function} callback Event type
         * @param {String} type
         */
        include: function (href, callback, type) {

            "use strict";

            var head = document.getElementsByTagName('head')[0],
                script,
                link,
                hrefLength,
                loaded = 0,
                i,

                /**
                 * triggered after load
                 *
                 * @method afterLoad
                 */
                afterLoad = function () {
                    loaded++;
                    if (loaded >= hrefLength) {

                        if (callback) {
                            callback();
                        }

                    }
                },

                addScriptToLoad = function (href) {

                    script = document.createElement('script');
                    script.src = href;

                    if (document.all !== undefined) {
                        script.type = "text/javascript";
                        script.onload = script.onreadystatechange = readyStateChange;
                    } else {
                        script.onload = afterLoad;
                        script.onerror = afterLoad;
                    }

                    head.appendChild(script);
                },

                addCssLinkToLoad = function (href) {
                    link = document.createElement('link');
                    link.rel = 'stylesheet';
                    link.href =  href;

                    if (document.all !== undefined) {
                        link.onload = link.onreadystatechange = readyStateChange;
                    } else {
                        link.onload = afterLoad;
                        link.onerror = afterLoad;
                    }

                    head.appendChild(link);
                };

            function readyStateChange() {

                var script = this;

                if (!script.readyState || script.readyState === "loaded" || script.readyState === "complete") {
                    afterLoad();
                }
            }

            if (!type) {
                type = 'script';
            }

            if (type === 'script') {

                if (href instanceof Array) {

                    hrefLength = href.length;

                    for (i = 0; i < hrefLength; i++) {

                        if (href[i] instanceof Object) {

                            if (href[i].type === 'js') {
                                addScriptToLoad(href[i].path);
                            } else {
                                addCssLinkToLoad(href[i].path);
                            }

                        } else if (href[i].length) {
                            addScriptToLoad(href[i]);
                        }

                    }

                } else {
                    addScriptToLoad(href);
                }

            } else {

                if (href instanceof Array) {
                    hrefLength = href.length;

                    for (i = 0; i < hrefLength; i++) {
                        addCssLinkToLoad(href[i]);
                    }

                } else {
                    addCssLinkToLoad(href);
                }
            }
        },

        /**
         * create application namespace
         *
         * @method namespace
         * @param ns_string
         * @returns {{}}
         */
        namespace: function (ns_string) {
            "use strict";

            var parts = ns_string.split('.'),
                parent = FRONDEVO_ADMIN,
                i;
            if (parts[0] === "FRONDEVO_ADMIN") {
                parts = parts.slice(1);
            }

            for (i = 0; i < parts.length; i += 1) {
                if (parent[parts[i]] === undefined) {
                    parent[parts[i]] = {};
                }
                parent = parent[parts[i]];
            }
            return parent;
        },

        /**
         * @param C
         * @param P
         */
        inherit: function (C, P) {
            "use strict";
            C.prototype = new P();
        },

        /**
         * function of mutation observer
         *
         * @method mutationObserver
         * @param wrap
         * @returns {{append: Function}}
         */
        mutationObserver: function (wrap) {
            "use strict";

            var controls = [],
                MutationObserver =
                    window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver,
                observer,
                j,
                length;

            if (!MutationObserver) {

                setInterval(function () {
                    var nodes = wrap.querySelectorAll('[data-module]'),
                        nodesCount = nodes.length,
                        dataModule,
                        i;

                    for (i = 0; i < nodesCount; i++) {

                        dataModule = nodes[i].getAttribute('data-module');

                        for (j = 0, length = controls.length; j < length; j++) {
                            if (dataModule === controls[j].name) {
                                //nodes[i].removeAttribute('data-module');

                                if (controls[j].init !== undefined) {
                                    controls[j].init(dataModule, nodes[i]);
                                }

                            }
                        }

                    }

                }, 500);

            } else {
                observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {

                        function addNode(node) {
                            var dataModule = node.getAttribute('data-module');

                            for (j = 0, length = controls.length; j < length; j++) {

                                if (dataModule === controls[j].name) {
                                    //node.removeAttribute('data-module');

                                    if (controls[j].init !== undefined) {
                                        controls[j].init(dataModule, node);
                                    }

                                }

                            }
                        }

                        var nodes = mutation.addedNodes,
                            nodesCount = nodes.length,
                            i,
                            hasAttribute,
                            innerNodes,
                            innerNodesCount,
                            k;

                        for (i = 0; i < nodesCount; i++) {

                            hasAttribute = (nodes[i].hasAttribute) ? nodes[i].hasAttribute('data-module') : null;

                            if (hasAttribute) {

                                addNode(nodes[i]);

                            } else {
                                if (nodes[i].querySelectorAll) {
                                    innerNodes = nodes[i].querySelectorAll('[data-module]');
                                    innerNodesCount = innerNodes.length;

                                    for (k = 0; k < innerNodesCount; k++) {
                                        addNode(innerNodes[k]);
                                    }
                                }
                            }

                        }

                    });
                });

                observer.observe(wrap, {
                    subtree: true,
                    childList: true
                });
            }

            function append(obj) {
                controls.push(obj);
            }

            return {
                append: function (obj) {
                    append(obj);
                }
            };

        },

        visibilityApi: function () {
            "use strict";

            var hidden,
                visibilityChange;

            if (typeof document.hidden !== "undefined") {
                hidden = "hidden";
                visibilityChange = "visibilitychange";
            } else if (typeof document.mozHidden !== "undefined") {
                hidden = "mozHidden";
                visibilityChange = "mozvisibilitychange";
            } else if (typeof document.msHidden !== "undefined") {
                hidden = "msHidden";
                visibilityChange = "msvisibilitychange";
            } else if (typeof document.webkitHidden !== "undefined") {
                hidden = "webkitHidden";
                visibilityChange = "webkitvisibilitychange";
            }

            function handleVisibilityChange() {
                if (!document[hidden]) {
                    $.ajax({
                        url: FRONDEVO_ADMIN.config.checkConnection,
                        dataType: 'json',
                        success: function (response) {
                            if (response && response.result !== undefined && parseInt(response.result, 10) === 0) {
                                window.location.reload();
                            }
                        }
                    });
                }
            }

            if (window.addEventListener) {
                document.addEventListener(visibilityChange, handleVisibilityChange, false);
            }
        },

        /**
         * init application
         *
         * @method init
         */
        init: function () {
            "use strict";

            FRONDEVO_ADMIN.core.dom.ready(function () {

                var doc = document,
                    core = FRONDEVO_ADMIN.core,
                    modules = FRONDEVO_ADMIN.modules,
                    pageAuth = doc.getElementById('auth'),
                    mainWrap = doc.getElementById('main-wrap'),
                    jsLibraryPath = core.getLibraryPath('main.js'),
                    libraryName = jsLibraryPath.name,
                    include = core.include,
                    activeWrap,
                    global = FRONDEVO_ADMIN.global;

                global.jsLibraryPath = jsLibraryPath;

                window.alert = modules.Popup.show;

                if (pageAuth) {
                    include([
                            libraryName + 'modules/main/modules.auth.js'
                    ], function () {
                        FRONDEVO_ADMIN.modules.Auth(pageAuth);
                    }, null);

                    include([
                            libraryName + 'modules/main/modules.notifications.js'
                    ], null, null);

                } else if (mainWrap) {

                    include([
                            libraryName + 'modules/main/modules.main.js',
                            libraryName + 'modules/main/modules.history.js',
                            libraryName + 'history.min.js',
                            libraryName + 'modules/main/modules.sidebar.js',
                            libraryName + 'modules/main/modules.notifications.js'
                    ], function () {
                        FRONDEVO_ADMIN.modules.Main(mainWrap);

                        FRONDEVO_ADMIN.config.checkConnection = (function () {
                            var url = '';

                            if (mainWrap) {
                                url = mainWrap.getAttribute('data-checkconnection-url');
                            }

                            return url;
                        }());

                    }, null);

                }

                activeWrap = pageAuth || mainWrap;
                global.wrap = activeWrap;
                global.controls.baseUrl = activeWrap.getAttribute('data-action');

                core.mutationObserver = core.mutationObserver(activeWrap);
                core.visibilityApi();
                modules.Forms(activeWrap);

            });

        }
    },

    /**
     * application modules
     *
     * @property modules
     */
    modules: {

        /**
         * Check form validate
         *
         * @class Validate
         *
         * @constructor
         */
        Validate: function () {

            "use strict";

            var errorMessages;

            /**
             * get error message
             *
             * @param input
             * @returns {{error: *, result: boolean}}
             */
            function getErrorMessage(input) {

                function defaultCheck(value) {
                    var result = true;

                    if (!value.length) {
                        result = false;
                    }

                    return result;
                }

                function selectCheck(input) {

                    var value,
                        result = true,
                        currentSelected,
                        select;


                    if ($(input).hasClass('ui-selectmenu')) {
                        currentSelected = $(input).attr('id');
                        select = document.getElementById(currentSelected.replace('-button', ''));

                        value = select.options[select.selectedIndex].value;
                    } else {
                        value = input.querySelector('input').value;
                    }

                    if (!value.length) {
                        result = false;
                    }

                    return result;
                }

                function emailCheck(value) {
                    var validMail = /^[\-._a-z0-9]+@(?:[a-z0-9][\-a-z0-9]+\.)+[a-z]{2,6}$/i.test(value),
                        result = true;

                    if (!validMail) {
                        result = false;
                    }

                    return result;
                }

                function numberCheck(value) {
                    var defaultResult = defaultCheck(value);

                    if (defaultResult) {
                        return !isNaN(value);
                    }

                    return defaultResult;
                }

                function currencyCheck(value) {
                    var defaultResult = defaultCheck(value);

                    if (defaultResult) {
                        return !isNaN(value);
                    }

                    return defaultResult;
                }

                var error,
                    value = input.value,
                    nodeName = input.nodeName,
                    inputType = input.type,
                    subType = input.getAttribute('data-type'),
                    inputTypeMessage,
                    result = true;

                if (nodeName === 'DIV' && input.className.indexOf('select') > -1) {
                    nodeName = 'SELECT';
                    inputType = 'select';
                }

                if ($(input).hasClass('ui-selectmenu')) {
                    nodeName = 'SELECT';
                    inputType = 'select';
                }

                switch (nodeName) {
                case 'INPUT':
                    inputTypeMessage = errorMessages.input;
                    break;

                case 'TEXTAREA':
                    inputTypeMessage = errorMessages.textArea;
                    break;

                case 'SELECT':
                    inputTypeMessage = errorMessages.select;
                    break;
                }

                switch (inputType) {

                case 'email':
                    error = inputTypeMessage.email;
                    result = emailCheck(value);
                    break;

                case 'number':
                    error = inputTypeMessage.number;
                    result = numberCheck(value);
                    break;

                case 'text':

                    if (subType) {
                        switch (subType) {

                        case 'number':
                            error = inputTypeMessage.number;
                            result = numberCheck(value);
                            break;

                        case 'currency':
                            error = inputTypeMessage.currency;
                            result = currencyCheck(value);
                            break;

                        default:
                            error = inputTypeMessage.defaultMessage;
                            result = defaultCheck(value);
                            break;
                        }

                    } else {
                        error = inputTypeMessage.defaultMessage;
                        result = defaultCheck(value);
                    }

                    break;

                case 'select':
                    error = inputTypeMessage.defaultMessage;
                    result = selectCheck(input);
                    break;

                default:
                    error = inputTypeMessage.defaultMessage;
                    result = defaultCheck(value);
                    break;
                }

                return {
                    error: error,
                    result: result
                };
            }

            /**
             * check input
             *
             * @param input
             * @returns {boolean}
             */
            function checkInput(input) {

                var type = input.getAttribute('type'),
                    jInput = $(input),
                    error,
                    errorResult,
                    errorDiv,
                    parent = input.parentNode,
                    result,
                    inputWidth = input.offsetWidth + 25,
                    subWidthValue = 15,
                    errorWidth,
                    parentWidth = parent.offsetWidth,
                    inputWithErrorWidth,
                    inputPosition = jInput.position(),
                    topPosition = inputPosition.top + 8,
                    counter = parent.querySelector('.input-counter'),
                    counterWidth = 0,
                    copyButton = parent.querySelector('.button__copy'),
                    copyButtonWidth = 0,
                    generateButton = parent.querySelector('.button__generate'),
                    generateButtonWidth = 0,
                    calendarButton = parent.querySelector('.button__calendar'),
                    calendarButtonWidth = 0,
                    currentSelected,
                    select,
                    hasUiSelect = jInput.hasClass('ui-selectmenu');

                if (counter) {
                    counterWidth = counter.offsetWidth;
                }

                if (copyButton) {
                    copyButtonWidth = copyButton.offsetWidth;
                }

                if (generateButton) {
                    generateButtonWidth = generateButton.offsetWidth;
                }

                if (calendarButton) {
                    calendarButtonWidth = calendarButton.offsetWidth;
                }

                if (input.hasAttribute('disabled') || !input.hasAttribute('required')) {

                    if (hasUiSelect) {
                        parentWidth = parent.parentNode.offsetWidth;

                        currentSelected = jInput.attr('id');
                        select = document.getElementById(currentSelected.replace('-button', ''));

                        if (!select.hasAttribute('required')) {
                            return true;
                        }

                    } else {
                        return true;
                    }

                }

                errorResult = getErrorMessage(input);

                error = errorResult.error;
                result = errorResult.result;

                errorDiv = parent.querySelector('.input-error-message');

                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    TweenMax.to(errorDiv, 0, {css: {y: 50, opacity: 0}});
                }

                errorDiv.setAttribute('class', 'input-error-message');
                errorDiv.innerHTML = error;

                if (type === 'hidden') {
                    type = jInput.attr('data-type');
                    inputWidth = parent.clientWidth + 40;
                    topPosition = $(parent).position().top + 8;
                    parent = jInput.parents('.select-wrap')[0];
                }

                if (!type) {

                    if (jInput.hasClass('select')) {
                        type = 'select';
                    } else {
                        type = 'text';
                    }
                }

                if (type === 'select') {
                    topPosition += 2;
                    subWidthValue = 50;
                }

                if (!result) {
                    parent.appendChild(errorDiv);
                    errorWidth = errorDiv.offsetWidth;
                    inputWithErrorWidth = inputWidth + errorWidth +
                        counterWidth + copyButtonWidth + generateButtonWidth + calendarButtonWidth;

                    if (parentWidth - inputWithErrorWidth > 0) {

                        errorDiv.style.cssText =
                            'right: auto; ' +
                            'left: ' + parseInt(inputWidth + counterWidth + copyButtonWidth +
                            calendarButtonWidth + generateButtonWidth, 10) + 'px;' +
                            'top: ' + topPosition + 'px';

                    } else {
                        errorDiv.style.cssText =
                            'right: ' + parseInt(parentWidth - inputWidth + subWidthValue, 10) + 'px;' +
                            'top: ' + topPosition + 'px';
                    }

                    if (!hasUiSelect) {
                        $(parent).addClass('input_error');
                    } else {
                        $(parent.parentNode).addClass('input_error');
                    }

                    TweenMax.to(errorDiv, 0.3, {css: {y: 0, opacity: 1}});

                }

                return result;
            }

            /**
             * check textarea
             *
             * @param textArea
             * @returns {boolean}
             */
            function checkTextArea(textArea) {
                return checkInput(textArea);
            }

            function checkSelect(element) {
                element.setAttribute('data-type', 'select');

                return checkInput(element);
            }

            /**
             * check form
             *
             * @param form
             * @param goTo {boolean}
             * @returns {boolean}
             */
            function check(form, goTo) {

                var inputs = form.querySelectorAll('.input'),
                    inputsLength = inputs.length,
                    textArea = form.querySelectorAll('.text-area'),
                    textAreaLength = textArea.length,
                    inputHidden = form.querySelectorAll('.select [type="hidden"]'),
                    inputHiddenCount = inputHidden.length,
                    i,
                    firstErrorElement,
                    result = true;


                for (i = 0; i < inputsLength; i++) {
                    if (!checkInput(inputs[i])) {
                        result = false;

                        if (!firstErrorElement) {
                            firstErrorElement = inputs[i];
                        }
                    }
                }

                for (i = 0; i < textAreaLength.length; i++) {
                    if (!checkTextArea(textArea[i])) {
                        result = false;

                        if (!firstErrorElement) {
                            firstErrorElement = inputs[i];
                        }
                    }
                }

                for (i = 0; i < inputHiddenCount; i++) {
                    if (!checkSelect(inputHidden[i])) {
                        result = false;

                        if (!firstErrorElement) {
                            firstErrorElement = $(inputs[i]).parents('.select').find('.select__current')[0];
                        }
                    }
                }

                if (goTo) {
                    if (firstErrorElement) {
                        $('html, body').animate({
                            scrollTop: $(firstErrorElement).parents('.input_error').position().top
                        });
                    }
                }

                return result;
            }

            /**
             * check form
             *
             * @public
             * @method check
             * @param form
             * @param goTo {boolean}
             * @returns {boolean}
             */
            this.check = function (form, goTo) {
                return check(form, goTo);
            };

            /**
             * Check input
             *
             * @public
             * @method checkInput
             * @param inputObject
             * @returns {boolean}
             */
            this.checkInput = function (inputObject) {
                return checkInput(inputObject);
            };

            /**
             * Init validate class
             *
             * @method init
             */
            function init() {
                FRONDEVO_ADMIN.core.include([
                        FRONDEVO_ADMIN.global.jsLibraryPath.name + 'modules/main/modules.error-messages.js'
                ], function () {
                    errorMessages = FRONDEVO_ADMIN.modules.ErrorMessages;
                }, null);
            }

            return init();
        },

        /**
         * @class Forms
         *
         * @param wrap
         * @returns {*}
         */
        Forms: function (wrap) {
            "use strict";

            var core = FRONDEVO_ADMIN.core,
                modules = FRONDEVO_ADMIN.modules,
                validate = new modules.Validate(),

                /**
                 * form event handlers
                 *
                 * @property handlers
                 * @type {{formFocusIn: Function, formFocusOut: Function, formErrorMessageClick: Function}}
                 */
                handlers = {

                    /**
                     * triggered when element get focus
                     *
                     * @method formFocusIn
                     */
                    formFocusIn: function () {
                        var element = $(this),
                            parent = element.parents('.input-row, .select-wrap');

                        parent.addClass('focus');
                        parent.removeClass('input_error');
                        parent.find('.input-error-message').remove();

                        if (element[0].hasOwnProperty('calendar')) {
                            element[0].calendar.show(element.val());
                        }

                    },

                    /**
                     * triggered when element lost focus
                     *
                     * @method formFocusOut
                     */
                    formFocusOut: function () {
                        var element = $(this);

                        element.parents('.input-row, .select-wrap').removeClass('focus');
                        validate.checkInput(this);
                    },

                    /**
                     * triggered when user click by error message
                     *
                     * @method formErrorMessageClick
                     */
                    formErrorMessageClick: function () {
                        if (this.parentNode) {
                            var input = this.parentNode.querySelector('.input');

                            if (input) {
                                input.focus();
                            }
                        }
                    },

                    /**
                     * Triggered when change field content
                     *
                     * @method formFieldChange
                     */
                    formFieldChange: function () {
                        var element = this,
                            hasCounter = element.hasAttribute('data-count'),
                            dataCount = parseInt(element.getAttribute('data-count'), 10),
                            counterContainer,
                            counterResult = dataCount - element.value.length,
                            form = $(element).parents('#form-edit-content');

                        if (form.length) {
                            modules.listener.add(null, 'form-data-change');
                        }

                        if (!hasCounter) {
                            return;
                        }

                        counterContainer = element.parentNode.querySelector('.input-counter');

                        if (!counterContainer) {
                            counterContainer = document.createElement('div');
                            counterContainer.setAttribute('class', 'input-counter');
                            element.parentNode.appendChild(counterContainer);
                        }

                        if (counterResult < 0) {
                            $(counterContainer).addClass('input-counter_red');
                        } else {
                            $(counterContainer).removeClass('input-counter_red');
                        }

                        counterContainer.innerHTML = counterResult;
                    },

                    /**
                     * Triggered when click by copy button
                     *
                     * @method formButtonCopyClick
                     */
                    formButtonCopyClick: function () {
                        var element = this,
                            copyId = element.getAttribute('data-copy'),
                            thiInput = element.parentNode.querySelector('.input, .text-area'),
                            copyContent;

                        if (!copyId) {
                            return;
                        }

                        copyContent = wrap.querySelector('#' + copyId);

                        if (thiInput) {
                            thiInput.value = copyContent.value;
                            thiInput.focus();
                        }
                    },

                    /**
                     * Generate button
                     *
                     * @method formButtonGenerate
                     */
                    formButtonGenerate: function () {

                        function transliteration(str) {

                            str = str.toLowerCase();
                            str = str.replace(/[^а-яa-z0-9 _\-]/g, '');

                            var arr_ru = ["А", "а", "Б", "б", "В", "в", "Г", "г", "Д", "д", "Е", "е", "Ё", "ё",
                                    "Ж", "ж", "З", "з", "И", "и", "Й", "й", "К", "к", "Л", "л", "М", "м", "Н", "н",
                                    "О", "о", "П", "п", "Р", "р", "С", "с", "Т", "т", "У", "у", "Ф", "ф", "Х", "х",
                                    "Ц", "ц", "Ч", "ч", "Ш", "ш", "Щ", "щ", "Ъ", "ъ", "Ы", "ы", "Ь", "ь", "Э", "э",
                                    "Ю", "ю", "Я", "я", " "],
                                arr_ruLength = arr_ru.length,
                                arr_en = ["A", "a", "B", "b", "V", "v", "G", "g", "D", "d", "E", "e", "E", "e",
                                    "Zh", "zh", "Z", "z", "I", "i", "Y", "y", "K", "k", "L", "l", "M", "m", "N", "n",
                                    "O", "o", "P", "p", "R", "r", "S", "s", "T", "t", "U", "u", "Ph", "f", "H", "h",
                                    "C", "c", "Ch", "ch", "Sh", "sh", "Sh", "sh", "", "", "I", "i", "", "", "E", "e",
                                    "Yu", "yu", "Ya", "ya", "-"],
                                i,
                                lit_now;

                            for (i = 0; i < arr_ruLength; i++) {
                                lit_now = new RegExp(arr_ru[i], "g");
                                str = str.replace(lit_now, arr_en[i]);
                            }

                            return str;
                        }

                        var element = this,
                            copyId = element.getAttribute('data-copy'),
                            thiInput = element.parentNode.querySelector('.input, .text-area'),
                            copyContent;

                        if (!copyId) {
                            return;
                        }

                        copyContent = wrap.querySelector('#' + copyId);

                        if (thiInput) {
                            thiInput.value = transliteration(copyContent.value);
                            thiInput.focus();
                        }
                    },

                    /**
                     * Calendar button
                     *
                     * @method formButtonCalendar
                     */
                    formButtonCalendar: function (event) {

                        var element = this,
                            parent = element.parentNode,
                            input = parent.querySelector('input');

                        core.stopPropagation(event);

                        if (input.calendar.isVisible) {
                            input.calendar.hide();
                        } else {
                            input.calendar.show(input.value);
                        }
                    }
                };

            /**
             * add event listeners
             *
             * @method addEventList
             */
            function addEventList() {
                $(wrap).on('focusin', '.input, .text-area, form .select, form .ui-selectmenu', handlers.formFocusIn);
                $(wrap).on('focusout', '.input, .text-area, form .select, form .ui-selectmenu', handlers.formFocusOut);
                $(wrap).on('keyup', '.input, .text-area', handlers.formFieldChange);
                $(wrap).on('click', '.input-error-message', handlers.formErrorMessageClick);
                $(wrap).on('click', '.button__copy', handlers.formButtonCopyClick);
                $(wrap).on('click', '.button__generate', handlers.formButtonGenerate);
                $(wrap).on('click', '.button__calendar', handlers.formButtonCalendar);
            }

            /**
             * init comboBox
             *
             * @method initComboBox
             */
            function initModules() {

                var configModules = FRONDEVO_ADMIN.config.modules,
                    currentModule,
                    moduleObjects,
                    loaded = FRONDEVO_ADMIN.global.loaded,

                    loadLibrary = function (moduleName) {

                        if (loaded.indexOf(moduleName) > -1) {
                            return;
                        }

                        loaded.push(moduleName);

                        core.include(FRONDEVO_ADMIN.config.modules[moduleName], function () {
                            var initFunction = FRONDEVO_ADMIN.config[moduleName + '_init'];

                            if (initFunction !== undefined) {
                                initFunction();
                            }

                        }, null);

                    };

                for (currentModule in configModules) {

                    if (configModules.hasOwnProperty(currentModule)) {
                        moduleObjects = document.querySelectorAll('[data-module="' + currentModule + '"]');

                        if (FRONDEVO_ADMIN.config[currentModule + '_init'] === undefined) {

                            if (moduleObjects.length) {
                                loadLibrary(currentModule);
                            }

                        }

                        core.mutationObserver.append({
                            name: currentModule,
                            init: function (moduleName, object) {

                                if (FRONDEVO_ADMIN.config[moduleName + '_init'] === undefined) {
                                    loadLibrary(moduleName);
                                } else {
                                    FRONDEVO_ADMIN.config[moduleName + '_init'](object);
                                }

                            }
                        });

                    }

                }

            }

            /**
             * init input counters
             *
             * @method initCounters
             */
            function initCounters() {
                var inputs = wrap.querySelectorAll('.input, .text-area'),
                    length = inputs.length,
                    i,
                    currentInput,
                    dataCount,
                    counterContainer,
                    countResult;

                for (i = 0; i < length; i++) {
                    currentInput = inputs[i];

                    if (!currentInput.hasAttribute('data-count')) {
                        continue;
                    }

                    dataCount = parseInt(currentInput.getAttribute('data-count'), 10);
                    countResult = dataCount - currentInput.value.length;

                    if (countResult < 0) {
                        $(countResult).addClass('input-counter_red');
                    } else {
                        $(countResult).removeClass('input-counter_red');
                    }

                    counterContainer = document.createElement('div');
                    counterContainer.setAttribute('class', 'input-counter');
                    counterContainer.innerHTML = countResult;
                    currentInput.parentNode.appendChild(counterContainer);
                }
            }

            /**
             * init file uploader
             *
             * @method initUploader
             */
            function initUploader() {

                /**
                 * load Uploader library
                 *
                 * @method loadLibrary
                 * @param path
                 * @param objects
                 */
                function loadLibrary(path, objects) {

                    core.include([
                            path + 'modules/uploader/css/colorbox.css',
                            path + 'modules/uploader/css/jquery.fileupload.css',
                            path + 'modules/uploader/css/drag-sort.css'
                    ], null, 'css');

                    core.include([
                            path + 'modules/uploader/js/plugin.all.js',
                            path + 'modules/uploader/js/jquery.fauploader.class.js',
                            path + 'modules/uploader/js/jquery.colorbox-min.js',
                            path + 'modules/main/modules.extend-popup.js'
                    ], function () {

                        $(objects).each(function (key, value) {
                            value.removeAttribute('data-module');
                            var uploader = new modules.FAUploader($(value), {});
                        });

                    }, null);
                }

                var global = FRONDEVO_ADMIN.global,
                    path = global.jsLibraryPath.name,
                    globalControls = global.controls,
                    uploadControls = $('[data-module="FAUploader"]'),
                    stack = [];

                globalControls.uploads = [];

                if (uploadControls.length) {
                    loadLibrary(path, uploadControls);
                }

                core.mutationObserver.append({
                    name: 'FAUploader',
                    init: function (object) {

                        if (modules.FAUploader) {
                            object.removeAttribute('data-module');
                            var upload = new modules.FAUploader($(object), {});
                        } else {

                            if (!stack.length) {
                                stack.push(object);
                                loadLibrary(path, stack);
                            } else {
                                stack.push(object);
                            }
                        }

                    }
                });
            }

            function initPlaceholders() {

                var global = FRONDEVO_ADMIN.global,
                    path = global.jsLibraryPath.name;

                if (!window.addEventListener || !window.atob) {
                    core.include([
                            path + 'jquery/jquery.placeholder.min.js'
                    ], function () {
                        $(wrap.querySelectorAll('.input, .text-area')).placeholder();
                    }, null);
                }
            }

            /**
             * init forms
             *
             * @method init
             */
            function init() {
                FRONDEVO_ADMIN.global.validate = validate;
                initModules();
                addEventList();
                initCounters();
                initPlaceholders();
//                initUploader();
            }

            return init();
        },

        /**
         * Application popup
         *
         * @property Popup
         */
        Popup: (function () {
            "use strict";

            /**
             * application popup window
             *
             * @class Popup
             * @returns {*}
             * @constructor
             */
            function Popup() {

                var self = this,
                    addEventListButton;

                this.controls = {
                    isVisible: false,
                    inDom: false
                };

                /**
                 * popup event handlers
                 *
                 * @property
                 * @type {{show: Function, hide: Function, backgroundPopupKeyDown: Function}}
                 */
                this.handlers = {

                    /**
                     * show popup
                     *
                     * @method showPopup
                     * @param popupBackground
                     * @param popup
                     * @param popupContent
                     * @param callback
                     */
                    showPopup: function (popupBackground, popup, popupContent, callback) {
                        popupBackground.style.cssText = 'display: block; opacity: 0';
                        popup.style.cssText =
                            'height: ' + popupContent.clientHeight + 'px;';

                        self.controls.isVisible = true;

                        TweenMax.to(popupBackground, 0.2, {css: {opacity: 1}, onComplete: function () {
                            TweenMax.to(popup, 0.0, {css: {scaleX: 0.6, y: -80, opacity: 0, visibility: 'visible'},
                                onComplete: function () {
                                    TweenMax.to(popup, 0.2, {css: {scaleX: 1, y: 0, opacity: 1},
                                        onComplete: function () {

                                            if (callback) {
                                                callback();
                                            }

                                        }});
                                }});
                        }});
                    },

                    /**
                     * hide popup
                     *
                     * @method hidePopup
                     * @param popupBackground
                     * @param popup
                     * @param controls
                     * @param callback
                     */
                    hidePopup: function (popupBackground, popup, controls, callback) {
                        controls.isVisible = false;

                        TweenMax.to(popup, 0.2, {css: {scaleX: 0.6, y: -80, opacity: 0, visibility: 'visible'},
                            onComplete: function () {
                                TweenMax.to(popupBackground, 0.2, {css: {opacity: 0}, onComplete: function () {
                                    popupBackground.style.cssText = 'display: none';
                                    if (callback) {
                                        callback();
                                    }
                                }});
                            }});
                    },

                    /**
                     * Show popup
                     *
                     * @method show
                     * @param {Object, String} data
                     */
                    show: function (data) {

                        var controls = self.controls,
                            popupBackground = controls.background,
                            popup = controls.popup,
                            popupContent = controls.popupContent,
                            popupData = [];

                        if (controls.isVisible) {
                            return;
                        }

                        if (data.type === undefined && data instanceof Object) {
                            data.type = '';
                        }

                        if (!controls.inDom) {
                            document.body.appendChild(controls.background);
                            controls.inDom = true;
                            self.addEventList();
                        }

                        popupContent.setAttribute('class', 'popup__content');

                        if (!(data instanceof Object)) {
                            popupData = self.create.empty(data);
                        } else {
                            switch (data.type) {
                            case 'confirm':
                                popupData = self.create.confirm(data);
                                break;
                            }
                        }

                        popupContent.innerHTML = popupData.join('');
                        addEventListButton();

                        self.handlers.showPopup(popupBackground, popup, popupContent, function () {
                            var firstButton = popupContent.querySelector('.button'),
                                cancelButton = popupContent.querySelector('.button[data-id="no"]');

                            if (cancelButton) {
                                cancelButton.focus();
                            } else if (firstButton) {
                                firstButton.focus();
                            }
                        });
                    },

                    /**
                     * Hide popup
                     *
                     * @method hide
                     */
                    hide: function (element) {

                        var controls = self.controls,
                            popupBackground = controls.background,
                            popup = controls.popup;

                        controls.isVisible = false;

                        self.handlers.hidePopup(popupBackground, popup, controls, function () {
                            controls.callback(element);
                        });
                    },

                    /**
                     * Click by popup button
                     *
                     * @method buttonClick
                     * @param event
                     */
                    buttonClick: function (event) {
                        self.handlers.hide(event.target);
                    },

                    /**
                     * Button key down
                     *
                     * @method buttonKeyDown
                     */
                    buttonKeyUp: function (event) {

                        FRONDEVO_ADMIN.core.preventDefault(event);

                        var keyCode = event.keyCode;

                        switch (keyCode) {
                        case 32:
                            this.click();
                            break;

                        case 13:
                            this.click();
                            break;
                        }
                    }
                };

                /**
                 * Create popup functions
                 *
                 * @property
                 * @type {{template: Function}}
                 */
                this.create = {

                    /**
                     * Public template of popup
                     *
                     * @method template
                     */
                    template: function () {
                        var background = document.createElement('div'),
                            popup = document.createElement('div'),
                            popupContent = document.createElement('div'),
                            controls = self.controls;

                        background.setAttribute('class', 'popup');
                        background.setAttribute('id', 'popup');

                        popup.setAttribute('class', 'popup__window');
                        popup.setAttribute('id', 'popup__window');
                        popup.innerHTML = '<div class="popup__close-button">&times;</div>';

                        popupContent.setAttribute('class', 'popup__content');

                        popup.appendChild(popupContent);

                        background.appendChild(popup);

                        controls.popupCloseButton = popup.querySelector('.popup__close-button');
                        controls.popupContent = popupContent;
                        controls.popup = popup;
                        controls.background = background;
                    },

                    /**
                     * empty popup content
                     *
                     * @method
                     */
                    empty: function (data) {
                        var popupData = [];

                        popupData.push(data);

                        // ----- popup controls
                        popupData.push('<div class="popup__controls">');
                        popupData.push('<div tabindex="0" class="button popup__controls_button">ОК</div>');
                        popupData.push('</div>');
                        // -----/popup controls

                        return popupData;
                    },

                    /**
                     * confirm popup content
                     *
                     * @method confirm
                     * @param data
                     * @returns {Array}
                     */
                    confirm: function (data) {
                        var popupData = [],
                            message = data.message,
                            popupControls = data.controls,
                            i,
                            length;

                        if (!message) {
                            message = '';
                        }

                        popupData.push('<div class="popup__message">' + message + '</div>');

                        // ----- popup controls
                        popupData.push('<div class="popup__controls">');

                        for (i = 0, length = popupControls.length; i < length; i++) {
                            popupData.push(
                                    '<div tabindex="0" data-id="' + popupControls[i].id +
                                    '" class="button popup__controls_button">' +
                                    popupControls[i].text + '</div>'
                            );
                        }

                        popupData.push('</div>');
                        // -----/popup controls

                        popupData.push('</div>');

                        return popupData;
                    }
                };

                /**
                 * Destroy popup (remove from DOM)
                 *
                 * @public
                 * @method destroy
                 */
                this.destroy = function () {

                    var controls = self.controls;

                    document.body.removeChild(controls.background);
                    controls.inDom = false;
                };

                /**
                 * Show popup
                 *
                 * @public
                 * @method show
                 * @param data
                 * @param callback
                 */
                this.show = function (data, callback) {

                    if (callback) {
                        self.controls.callback = callback;
                    } else {
                        self.controls.callback = function () {};
                    }

                    self.handlers.show(data);
                };

                /**
                 * Hide popup
                 *
                 * @public
                 * @method hide
                 */
                this.hide = function () {
                    self.handlers.hide(null);
                };

                /**
                 * add popup event listener
                 *
                 * @method addEventList
                 */
                this.addEventList = function () {
                    var handlers = self.handlers,
                        controls = self.controls;

                    $(controls.background).on('click', function (event) {
                        handlers.hide.call(self, event);
                    });
                    $(controls.popupCloseButton).on('click', function (event) {
                        handlers.hide.call(self, event);
                    });
                    $(controls.popup).on('click', FRONDEVO_ADMIN.core.stopPropagation);
                };

                /**
                 * add event listeners
                 *
                 * @method addEventListButton
                 */
                addEventListButton = function () {
                    var handlers = self.handlers,
                        controls = self.controls;

                    $(controls.popup).off('click', '.button').on('click', '.button', handlers.buttonClick);
                    $(controls.popup).off('keyup', '.button').on('keyup', '.button', handlers.buttonKeyUp);
                };

                /**
                 * init popup class
                 *
                 * @method init
                 */
                this.init = function () {
                    self.create.template();
                };

                return self.init();
            }

            var popup = new Popup();

            return {
                show: function (data, callback) {
                    popup.show(data, callback);
                },

                hide: function () {
                    popup.hide();
                },

                self: function () {
                    return Popup;
                }
            };
        }()),

        listener: (function () {
            "use strict";

            var list = [];

            function addTrigger(handler, type) {
                list.push({
                    handler: handler,
                    type: type
                });
            }

            function executeTrigger(data, type) {
                var count = list.length,
                    i;

                for (i = 0; i < count; i++) {
                    if (list[i].type === type) {
                        list[i].handler(data);
                    }
                }
            }

            return {
                add: function (data, type) {
                    executeTrigger(data, type);
                },
                triggerHandler: function (handler, type) {
                    addTrigger(handler, type);
                }
            };
        }())
    }
};

FRONDEVO_ADMIN.core.init();