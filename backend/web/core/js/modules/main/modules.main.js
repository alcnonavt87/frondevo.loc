/**
 * Created by Valera Siestov on 17.12.13.
 */

/*global FRONDEVO_ADMIN, alert, console, document, $, TweenMax, window, tinyMCE, tinymce, location */
/*jslint plusplus: true */

FRONDEVO_ADMIN.core.namespace('modules.Main');

/**
 * Main class of application
 *
 * @class Main
 * @param wrap
 * @returns {*}
 * @constructorпше
 */
FRONDEVO_ADMIN.modules.Main = function (wrap) {
    "use strict";

    var core = FRONDEVO_ADMIN.core,
        modules = FRONDEVO_ADMIN.modules,
        global = FRONDEVO_ADMIN.global,
        validate = global.validate,
        notification = modules.Notification,
        errorMessages,
        ajaxSend = core.ajaxSend,
        action = wrap.getAttribute('data-action'),
        method = wrap.getAttribute('data-method'),
        saveFormEditContent,
        removeFormEditContent,
        copyFormEditContent,
        controls = {},

        /**
         * Function for work with ajax load image
         *
         * @object ajaxLoad
         * @type {{show: Function, hide: Function}}
         */
        AjaxLoad = {
            /**
             * block content
             *
             * @method blockContent
             */
            blockContent: function () {
                document.body.onclick = function (event) {
                    core.stopPropagation(event);
                };
            },

            unblockContent: function () {
                document.body.onclick = null;
            },

            /**
             * Show ajax load image
             *
             * @method show
             */
            show: function () {
                var ajaxLoad = controls.ajaxLoad;

                AjaxLoad.blockContent();

                if (!ajaxLoad) {
                    ajaxLoad = document.createElement('div');
                    controls.ajaxLoad = ajaxLoad;

                    ajaxLoad.setAttribute('class', 'ajax-load');
                    wrap.appendChild(ajaxLoad);
                }

                TweenMax.to(ajaxLoad, 0, {css: {y: 20}, onComplete: function () {
                    ajaxLoad.style.display = 'block';
                    TweenMax.to(ajaxLoad, 0.2, {css: {y: 0}});
                }});
            },

            /**
             * Hide ajax load image
             *
             * @method hide
             */
            hide: function () {

                var ajaxLoad = controls.ajaxLoad;

                AjaxLoad.unblockContent();

                if (!ajaxLoad) {
                    return;
                }

                TweenMax.to(ajaxLoad, 0.2, {css: {y: 20}, onComplete: function () {
                    TweenMax.to(ajaxLoad, 0, {css: {y: 0}, onComplete: function () {
                        ajaxLoad.style.display = 'none';
                    }});
                }});
            }
        },

        /**
         * @property handlers
         * @type {{
         * sidebar: {sideBarMenuClick: Function},
         * main: {createPage: Function, openLink: Function, headerLogoClick: Function
         * }}}
         */
        handlers = {

            /**
             * @property sidebar
             */
            sidebar: {
                /**
                 * callback function of side bar menu click
                 *
                 * @method sideBarMenuClick
                 * @param data
                 */
                sideBarMenuClick: function (data) {
                    handlers.main.openLink(data);
                },

                /**
                 * right sidebar click event handler
                 *
                 * @method rightSideBarClick
                 * @param id
                 * @param data
                 */
                rightSideBarClick: function (id, data) {
                    switch (id) {
                    case 'save':
                        saveFormEditContent();
                        break;
                    case 'copy':
                        copyFormEditContent(data);
                        break;
                    case 'preview':

                        break;
                    case 'remove':
                        removeFormEditContent(data);
                        break;
                    }
                }
            },

            /**
             * @property main
             */
            main: {

                /**
                 * Create page by input html code
                 *
                 * @method createPage
                 * @param html
                 */
                createPage: function (html) {

                    function createByHtml(html, content) {

                        var tempDiv = document.createElement('div');

                        tempDiv.innerHTML = html;

                        content.className = 'content';
                        controls.sidebar.hideRightPanel();
                        content.innerHTML = html;
                    }

                    function createByJson(json, content) {

                        var rightSideBar = json.navMenu;

                        if (rightSideBar) {
                            controls.sidebar.showRightPanel(rightSideBar, {click: handlers.sidebar.rightSideBarClick});
                            content.className = 'content content_modify';
                        } else {
                            controls.sidebar.hideRightPanel();
                            content.className = 'content';
                        }

                        content.innerHTML = json.content;
                    }

                    if (html instanceof String) {
                        createByHtml(html, controls.content);
                    } else {
                        createByJson(html, controls.content);
                    }
                },

                /**
                 * Process form changes
                 *
                 * @method processChanges
                 * @param link
                 */
                processChanges: function (link) {
                    alert({
                        type: 'confirm',
                        message: 'Внесенные изменения не сохранены. Сохранить?',
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
                            saveFormEditContent(function () {
                                handlers.main.openLink(link);
                            });
                        } else {
                            controls.isFormChange = false;
                            controls.newDocument = false;
                            handlers.main.openLink(link);
                        }

                    });
                },

                /**
                 * function for open link and create page
                 *
                 * @method openLink
                 * @param link
                 */
                openLink: function (link) {

                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);

                    if (controls.isFormChange) {
                        handlers.main.processChanges(link);
                        return;
                    }

                    if (controls.newDocument) {
                        controls.newDocument = false;
                        ajaxSend({
                            url: controls.sidebar.getRemoveButtonId(),
                            dataType: 'json'
                        });
                    }

                    if (window.tinymce) {
                        tinymce.remove();
                    }

                    AjaxLoad.show();
                    ajaxSend({
                        url: action + link,
                        dataType: 'json',
                        callback: function (response) {
                            if (parseInt(response.code, 10) === 0) {
                                handlers.main.createPage(response);
                                if (response.newDoc) {
                                    controls.newDocument = true;
                                }
                            } else {
                                notification.show({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        },
                        completeCallback: function () {
                            AjaxLoad.hide();
                        }
                    });
                },

                /**
                 * function for send request without change content
                 *
                 * @method sendRequest
                 * @param link
                 */
                sendRequest: function (link) {
                    ajaxSend({
                        url: action + link,
                        dataType: 'json',
                        callback: function (response) {
                            if (parseInt(response.code, 10) === 0) {
                                notification.show(response.message);
                            } else {
                                notification.show({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        }
                    });
                },

                /**
                 * Click by logo - open index page
                 *
                 * @method headerLogoClick
                 */
                headerLogoClick: function () {
                    var element = this;

                    handlers.main.openLink(element.getAttribute('href').replace('#', ''));
                    controls.sidebar.removeActiveLink();
                },

                /**
                 * Click by reference in content block
                 *
                 * @method contentReferenceClick
                 */
                contentReferenceClick: function () {
                    var link = this.getAttribute('data-href') + this.getAttribute('href'),
                        linkType = this.getAttribute('data-type');

                    if (!linkType) {
                        controls.sidebar.setActiveMenu(link);
                        handlers.main.openLink(link);
                    } else if (linkType === 'not-refresh') {
                        handlers.main.sendRequest(link);
                    }
                },

                /**
                 * Triggered when change value in input element
                 *
                 * @method changeActionElement
                 */
                changeActionElement: function (event) {

                    event.stopPropagation();
                    event.stopImmediatePropagation();

                    function checkContainerId(element) {
                        var jElement = $(element),
                            parent = jElement.parents('tr'),
                            result = '';

                        if (parent.length) {
                            result = '&id=' + parent.attr('data-id');
                        }

                        return result;
                    }

                    var element = this,
                        type = element.getAttribute('http-type'),
                        elementAction = element.getAttribute('action'),
                        request,
                        inputValue = 0,
                        id;

                    if (element.type === 'checkbox') {

                        if (element.checked) {
                            inputValue = 1;
                        }

                    } else {
                        inputValue = element.value;
                    }

                    id = checkContainerId(element);

                    request = 'name=' + element.getAttribute('name') + '&value=' + inputValue + id;

                    core.ajaxSend({
                        url: action + 'ajax/' + elementAction,
                        type: type,
                        data: request,
                        dataType: 'json',
                        callback: function (response) {
                            if (parseInt(response.code, 10) === 0) {
                                notification.show(response.message);
                            } else {
                                notification.show({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        }
                    });
                },

                /**
                 * edit content form submit callback
                 *
                 * @method formEditContentSubmitCallback
                 */
                formEditContentSubmitCallback: function (response) {
                    var form;

                    if (parseInt(response.code, 10) === 0 && response.id) {
                        //form = wrap.querySelector('#form-edit-content');

//                        if (form) {
//                            form.setAttribute('action', response.id)
//                        }
                        location.href = response.id;
                    }

                    notification.show(response.message);
                },

                /**
                 * form submit
                 *
                 * @method formSubmit
                 */
                formSubmit: function (event) {

                    var form = this,
                        jForm = $(form),
                        data = jForm.serialize(),
                        url = form.getAttribute('action'),
                        type = form.getAttribute('method'),
                        dataChange = form.getAttribute('data-change'),
                        containerToChange;

                    core.preventDefault(event);

                    if (controls.thisFormStoped === this) {
                        controls.thisFormStoped = null;
                        return;
                    }

                    ajaxSend({
                        url: url,
                        type: type,
                        data: data,
                        dataType: 'json',
                        callback: function (data) {

                            var div = document.createElement('div'),
                                fragment = document.createDocumentFragment();

                            if (parseInt(data.code, 10) === 0) {

                                div.innerHTML = data.content;

                                if (dataChange) {
                                    containerToChange = document.getElementById(dataChange);

                                    while (div.firstChild) {
                                        fragment.appendChild(div.firstChild);
                                    }

                                    containerToChange.parentNode.replaceChild(fragment, containerToChange);
                                } else {
                                    controls.content.innerHTML = data.content;
                                }
                            } else {
                                notification.show({
                                    type: 'error',
                                    message: data.message
                                });
                            }
                        }
                    });
                },

                /**
                 * click by pagination
                 *
                 * @method paginationClick
                 */
                paginationClick: function () {
                    var element = this,
                        content = controls.content,
                        form = $(content.querySelector('form')),
                        jElement = $(element),
                        page = jElement.text(),
                        currentPage = jElement.parent().find('.pagination__active').text(),
                        url = form.length ? form.attr('action') : '';

                    if (page === '<') {
                        page = parseInt(currentPage, 10) - 1;
                    } else if (page === '>') {
                        page = parseInt(currentPage, 10) + 1;
                    }

                    core.ajaxSend({
                        url: url,
                        dataType: 'json',
                        data: (form.length ? form.serialize() : '') + '&page=' + page,
                        callback: function (data) {
                            if (parseInt(data.code, 10) === 0) {
                                content.innerHTML = data.content;
                            } else {
                                notification.show({
                                    type: 'error',
                                    message: data.message
                                });
                            }
                        }
                    });

                },

                /**
                 * window scroll
                 *
                 * @method windowScroll
                 */
                windowScroll: function () {
                    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop,
                        sidebarMenu = controls.sidebarMenu,
                        rightSideBar = controls.rightSidebarMenu || controls.sidebar.returnRightSidebar(),
                        rightSideBarNavMenu;

                    if (!controls.rightSidebarMenu) {
                        controls.rightSidebarMenu = rightSideBar;
                    }

                    if (scrollTop > 0 && scrollTop < 30) {
                        sidebarMenu.style.cssText = 'margin-top: ' + parseInt(30 - scrollTop, 10) + 'px';

                        if (rightSideBar) {
                            rightSideBarNavMenu = rightSideBar.querySelector('.sidebar__menu');

                            if (rightSideBarNavMenu) {
                                rightSideBarNavMenu.style.cssText = 'margin-top: ' + parseInt(30 - scrollTop, 10) + 'px';
                            }
                        }

                    } else if (scrollTop >= 30) {
                        sidebarMenu.style.cssText = 'margin-top: 0';

                        if (rightSideBar) {
                            rightSideBar.style.cssText = 'margin-top: 0';
                        }
                    } else {
                        sidebarMenu.style.cssText = '';

                        if (rightSideBar) {
                            rightSideBar.style.cssText = '';
                        }

                    }
                },

                /**
                 * Mouse enter to checkBox
                 *
                 * @method checkBoxMouseEnter
                 */
                checkBoxMouseEnter: function () {
                    var element = this,
                        jElement = $(element),
                        prevElement = jElement.prev();

                    if (errorMessages) {
                        if (prevElement[0].hasAttribute('action')) {
                            if (prevElement[0].checked) {
                                element.setAttribute('title', errorMessages.checkbox.active);
                            } else {
                                element.setAttribute('title', errorMessages.checkbox.notActive);
                            }
                        }
                    } else {
                        console.log('Object "errorMessages" is undefined');
                    }
                },

                /**
                 * table row click handlers
                 *
                 * @method tableRowClick
                 */
                tableRowClick: function (data) {

                    var location = window.location;

                    controls.history.add(document.title, location.protocol +
                        '//' + location.host + location.pathname + '#' + data);

                    handlers.main.openLink(data);
                },

                /**
                 * form data change event
                 *
                 * @method formDataChange
                 */
                formDataChange: function () {
                    controls.isFormChange = true;
                },

                /**
                 * Show filter block
                 *
                 * @method showFilterBlock
                 */
                showFilterBlock: function () {
                    var element = this,
                        dataId = element.getAttribute('id'),
                        filterBlock = document.querySelector('[data-id="' + dataId + '"]'),
                        jFilterBlock = $(filterBlock);

                    if (!filterBlock) {
                        return;
                    }

                    if (!jFilterBlock.is(':visible')) {
                        jFilterBlock.slideDown(function () {
                            jFilterBlock.removeClass('hidden');
                            global.controls.select.updateScroll();
                        });
                    } else {
                        jFilterBlock.slideUp(function () {
                            jFilterBlock.addClass('hidden');
                        });
                    }
                },

                /**
                 * Copy or remove block
                 *
                 * @method copyRemoveBlockClick
                 */
                copyRemoveBlockClick: function () {
                    var element = this,
                        jElement = $(element),
                        type,
                        currentBlock,
                        blockCopy,
                        jBlockCopy,
                        tinyElement,
                        tinyName;

                    if (jElement.hasClass('button_copy-block')) {
                        type = 'copy';
                    } else if (jElement.hasClass('button_remove-block')) {
                        type = 'remove';
                    }

                    if (!type) {
                        console.log('Ошибка. Не задан тип кнопки');
                        return;
                    }

                    currentBlock = jElement.parents('.input-row__group');

                    switch (type) {
                    case 'copy':
                        blockCopy = currentBlock[0].cloneNode(true);
                        jBlockCopy = $(blockCopy);
                        jBlockCopy.find('input').val('');
                        tinyElement = jBlockCopy.find('.mce-tinymce');

                        if (tinyElement.length) {
                            tinyName = tinyElement.find('textarea').attr('name');
                            tinyElement.replaceWith('<textarea name="' + tinyName + '" data-module="tinymce"></textarea>');
                        }

                        currentBlock.eq(0).find('.button__block').eq(0)
                            .removeClass('button_copy-block')
                            .addClass('button_remove-block');

                        currentBlock.eq(0).parent().append(blockCopy);
                        if (blockCopy.querySelector('.select')) {

                            $(blockCopy).find('.select').each(function () {
                                FRONDEVO_ADMIN.global.controls.select.cloneAdd(this);
                            });

                        }

                        break;

                    case 'remove':
                        currentBlock.eq(0).remove();

                        break;
                    }
                },

                tabsElementChange: function (event) {
                    var element = $(this),
                        radioWrap = element.find('.radio-wrap'),
                        input,
                        selectTextValue;

                    radioWrap.each(function () {
                        var item = $(this);

                        if (!item.find('input[type="radio"]').is(':checked')) {
                            item.find('input').each(function () {
                                //this.value = '';
                            });

                            item.find('.select').each(function () {
                                var currentValue = $(this).find('.select__current span'),
                                    options = $(this).find('.select__option');

                                options.removeClass('active');
                                options.eq(0).addClass('active');

                                currentValue.html(options.eq(0).html());
                            });
                        }
                    });
                },

                tabsChange: function (event) {
                    var element = this,
                        url = element.getAttribute('action'),
                        form = $(element),
                        data = form.serialize(),
                        additionalData = '',
                        destination = $('#' + this.getAttribute('data-destination')),
                        destinationInput = destination.find('input'),
                        inputs = form.find('[data-warning]'),
                        inputsCount = inputs.length,
                        i,
                        tempInput,
                        selectTextValue,
                        selectedInput;

                    event.preventDefault();
                    event.stopPropagation();
                    event.stopImmediatePropagation();

                    for (i = 0; i < inputsCount; i++) {

                        if (inputs.eq(i).parents('.radio-wrap').find('input[type="radio"]').is(':checked')) {
                            tempInput = inputs[i].querySelector('input[type="hidden"]');
                            selectTextValue = inputs[i].querySelector('.select__current span');

                            if (tempInput.value === selectTextValue.innerHTML) {
                                notification.show({
                                    type: 'error',
                                    message: inputs[i].getAttribute('data-warning')
                                });
                                return;
                            } else {
                                selectedInput = inputs[i];
                            }
                        }

                    }

                    clearTimeout(controls.requestTimeout);
                    controls.requestTimeout = setTimeout(function () {

                        if (element.getAttribute('data-type') === 'submit') {
                            additionalData = '&' + destinationInput.serialize() + '&' +
                                $('.tabs__content-item[data-type="change"]').serialize();

                            if (!form.find('input:checked').length || !destinationInput.filter('input:checked').length) {

                                if (selectedInput) {
                                    notification.show({
                                        type: 'error',
                                        message: selectedInput.getAttribute('data-warning')
                                    });
                                } else {
                                    notification.show({
                                        type: 'error',
                                        message: form.attr('data-warning')
                                    });

                                }


                                return;
                            }
                        }


                        controls.thisFormStoped = this;

                        core.ajaxSend({
                            url: url,
                            data: data + additionalData,
                            type: 'get',
                            callback: function (data) {
                                var parentTable,
                                    mainTableCheckBox,
                                    theOtherCheckBox,
                                    allChecked = true;

                                if (destination) {
                                    destination.html(data.content);

                                    parentTable = destination.parents('table');

                                    parentTable.trigger("update");
                                    mainTableCheckBox = parentTable.find('#select-all');
                                    theOtherCheckBox = parentTable.find('tbody .check-box');

                                    theOtherCheckBox.each(function () {
                                        if (!this.checked) {
                                            allChecked = false;
                                        }
                                    });

                                    mainTableCheckBox[0].checked = allChecked;
                                }

                                if (data.message) {
                                    notification.show(data.message);
                                }

                            }

                        });

                    }, 300);


                },

                switchTabs: function () {
                    global.controls.select.updateScroll();
                },

                inputModelChange: function () {
                    var modelUpdate = this.getAttribute('data-update'),
                        modelUpdateCount,
                        expression,
                        updateControl,
                        updateControlCount,
                        i,
                        selector = '',
                        getModelByExpression = function (exp) {
                            var input = document.querySelector('[data-model="' +
                                    exp.replace('{{', '').replace('}}', '') + '"]'),
                                result = '';

                            if (input) {
                                result = input.value;
                            }

                            return result;
                        },

                        changeStringToValue = function (inputString) {
                            var resultString = inputString,
                                temp,
                                beforeLen,
                                afterLen;

                            while (resultString.indexOf('{{') > -1) {
                                beforeLen = resultString.length;

                                temp = resultString.substr(resultString.indexOf('{{'));
                                temp = temp.substr(0, temp.indexOf('}}') + 2);
                                resultString = resultString.replace(temp, getModelByExpression(temp));

                                afterLen = resultString.length;

                                if (beforeLen === afterLen) {
                                    break;
                                }

                            }

                            return resultString;
                        },

                        preparedString,
                        result;

                    if (!modelUpdate) {
                        return;
                    }

                    modelUpdate = modelUpdate.split(',');
                    modelUpdateCount = modelUpdate.length;

                    for (i = 0; i < modelUpdateCount; i++) {
                        if (selector.length) {
                            selector += ', ';
                        }

                        selector += '[data-model="' + modelUpdate[i].replace(/\s/g, '') + '"]';
                    }

                    console.log(selector);

                    updateControl = document.querySelectorAll(selector);
                    updateControlCount = updateControl.length;

                    if (!updateControlCount) {
                        return;
                    }

                    for (i = 0; i < updateControlCount; i++) {
                        expression = updateControl[i].getAttribute('data-calc');

                        if (!expression) {
                            return;
                        }

                        preparedString = changeStringToValue(expression);

                        try {
                            result = eval(preparedString);
                        } catch(e) {
                            console.log(e);
                            result = 0;
                        }

                        updateControl[i].value = Math.round(result * 100) / 100;
                    }


                },

                btnCloneClick: function () {
                    var element = this,
                        row = $(element).parents('tr'),
                        url = element.getAttribute('data-url'),
                        id = element.getAttribute('data-id');

                    FRONDEVO_ADMIN.core.ajaxSend({
                        url: url,
                        data: 'id=' + id,
                        type: element.getAttribute('data-method') || 'get',
                        dataType: 'json',
                        callback: function (data) {
                            row.after(data.content);
                        },
                        completeCallback: function (data) {
                            //console.log(data);
                        }
                    });
                }
            }
        };

    /**
     * submit dit content form
     *
     * @method saveFormEditContent
     */
    saveFormEditContent = function (callback) {
        var form = wrap.querySelector('#form-edit-content'),
            formAction = form.getAttribute('action'),
            method = form.getAttribute('method'),
            tinyMCEEditors,
            tinyMCEEditorsCount,
            i;

        if (window.tinyMCE) {
            tinyMCEEditors = tinyMCE.editors;
            tinyMCEEditorsCount = tinyMCEEditors.length;

            for (i = 0; i < tinyMCEEditorsCount; i++) {
                tinyMCEEditors[i].save();
            }
        }

        if (validate.check(form, true)) {

            core.ajaxSend({
                url: formAction,
                data: $(form).serialize(),
                type: method,
                callback: handlers.main.formEditContentSubmitCallback
            });

            controls.isFormChange = false;
            controls.newDocument = false;

            if (callback) {
                callback();
            }
        }
    };

    /**
     * remove edit content form
     *
     * @method removeFormEditContent
     * @param data
     */
    removeFormEditContent = function (data) {

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
                    url: action + data,
                    callback: function (response) {
                        if (parseInt(response.code, 10) === 0) {
                            alert(response.message);
                            controls.history.back();
                        } else {
                            alert(response.message);
                        }
                    }
                });

            }

        });
    };

    copyFormEditContent = function (data) {
        FRONDEVO_ADMIN.core.ajaxSend({
            url: action + data,
            callback: function (response) {
                if (parseInt(response.code, 10) === 0) {
                    location.href = response.id;
                } else {
                    alert(response.message);
                }
            }
        });
    };

    /**
     * add events to main page
     *
     * @method addEventList
     */
    function addEventList() {
        var mainHandlers = handlers.main,
            content = controls.content,
            jContent = $(content),
            listener = modules.listener;

        $(controls.headerLogo).on('click', mainHandlers.headerLogoClick);
        jContent.on('click', 'a[data-href]', mainHandlers.contentReferenceClick);
        $(wrap).on('click', '.sidebar_right a[data-href]', mainHandlers.contentReferenceClick);
        jContent.on('change', '.check-box[action]', mainHandlers.changeActionElement);
        jContent.on('click', '.pagination__item', mainHandlers.paginationClick);
        jContent.on('mouseenter', '.check-box__label', mainHandlers.checkBoxMouseEnter);
        $(window).on('scroll', mainHandlers.windowScroll);
        jContent.on('click', '#filter-button-show', mainHandlers.showFilterBlock);
        jContent.on('click', '.button__block', mainHandlers.copyRemoveBlockClick);
        jContent.on('change', '.tabs__content-item[data-type="change"]', mainHandlers.tabsChange);
        jContent.on('submit', 'form.tabs__content-item[data-type="submit"]', mainHandlers.tabsChange);
        jContent.on('change', 'form.tabs__content-item[data-type="submit"]', mainHandlers.tabsElementChange);
        jContent.on('submit', 'form', mainHandlers.formSubmit);
        jContent.on('change', '[name="tabs-controls"]', mainHandlers.switchTabs);
        jContent.on('change, keyup', '[data-model]', mainHandlers.inputModelChange);
        jContent.on('click', '.btn__clone', mainHandlers.btnCloneClick);

        listener.triggerHandler(mainHandlers.tableRowClick, 'table-row-click');
        listener.triggerHandler(mainHandlers.formDataChange, 'form-data-change');
        listener.triggerHandler(mainHandlers.formDataChange, 'uploader-data-change');
    }

    /**
     * get controls
     *
     * @method getControls
     */
    function getControls() {
        var doc = document;

        controls.wrap = wrap;
        controls.sidebarMenu = doc.getElementById('sidebar__menu');
        controls.content = doc.getElementById('content');
        controls.headerLogo = wrap.querySelector('.header__logo a');
        controls.language = doc.getElementById('languages');

        controls.sidebar = new modules.SideBar({
            wrap: controls.sidebarMenu,
            language: controls.language,
            callback: {
                click: handlers.sidebar.sideBarMenuClick
            }
        });

        controls.history = new modules.History({
            wrap: wrap,
            callback: function (link) {
                var mainHandlers = handlers.main;
                controls.sidebar.setActiveMenu(link);
                mainHandlers.openLink(link);
            }
        });

        global.controls.sidebar = controls.sidebar;
    }

    function includeOtherLibraries() {

        var libraryName = global.jsLibraryPath.name,
            initSSE = function () {
                modules.sse({
                    open: function (data) {
                        console.log('open', data);
                    },

                    message: function (data) {
                        console.log('message', data);
                    },

                    error: function (data) {
                        console.log('error', data);
                    }
                });
            };

        core.include([
            libraryName + 'modules/main/modules.hot-keys.js',
            libraryName + 'modules/main/modules.server-events.js'
        ], function () {

            //if (window.EventSource) {
            //    initSSE();
            //} else {
            //    core.include([
            //        libraryName + 'modules/main/eventsource.js'
            //    ], function () {
            //        initSSE();
            //    }, null);
            //}

        }, null);

        if (!modules.ErrorMessages) {
            FRONDEVO_ADMIN.core.include([
                FRONDEVO_ADMIN.global.jsLibraryPath.name + 'modules/main/modules.error-messages.js'
            ], function () {
                errorMessages = modules.ErrorMessages;
            }, null);
        } else {
            errorMessages = modules.ErrorMessages;
        }
    }

    /**
     * init main module
     *
     * @method init
     */
    function init() {
        getControls();
        addEventList();
        includeOtherLibraries();
    }

    return init();
};