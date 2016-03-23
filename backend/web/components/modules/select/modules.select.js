/**
 * Created by Валерий on 18.12.13.
 */

/*global FRONDEVO_ADMIN, document, IScroll, IScroll_IE8, $, window */

FRONDEVO_ADMIN.core.namespace('modules.Select');

/**
 * Create custom ComboBox
 *
 * @class Select
 *
 * @param param
 * @returns {*}
 * @constructor
 */
FRONDEVO_ADMIN.modules.Select = function (param) {
    "use strict";

    var self = this,
        global = FRONDEVO_ADMIN.global,
        core = FRONDEVO_ADMIN.core,
        modules = FRONDEVO_ADMIN.modules,
        parameters,
        controls = {
            elements: []
        },

        /**
         * function of init scroll bar in container
         *
         * @method initScroll
         * @param object
         */
        initScroll = function (object) {
            var element = object.element,
                id = element.getAttribute('id'),
                contentId = '#' + id + '_content',
                contentBlock,
                scrollIndicator;

            if (window.IScroll_IE8) {

                object.scroll = new IScroll_IE8(element.querySelector(contentId), {
                    scrollbarClass: 'iScrollVerticalScrollbar',
                    mouseWheel: true,
                    scrollY: true
                });

            } else {
                object.scroll = new IScroll(contentId, {
                    mouseWheel: true,
                    scrollbars: 'custom',
                    scrollY: true,
                    interactiveScrollbars: true,
                    lockDirection: true
                });
            }

            contentBlock = element.querySelector(contentId);

            scrollIndicator = contentBlock.querySelector('.iScrollIndicator');

            if (scrollIndicator && !scrollIndicator.clientHeight) {
                contentBlock.querySelector('.iScrollVerticalScrollbar').style.cssText = 'display: none';
            }

            $(contentBlock).addClass('init-complete');
        },

        /**
         * @property create
         * @type {{comboBox: Function}}
         */
        create = {

            convertNodeListToArray: function (nodeList) {

                if (window.addEventListener) {
                    create.convertNodeListToArray = function (nodeList) {
                        return nodeList;
                    };
                } else {
                    create.convertNodeListToArray = function (nodeList) {
                        var i,
                            nodeListLength = nodeList.length,
                            result = [];

                        for (i = 0; i < nodeListLength; i++) {
                            result.push(nodeList[i]);
                        }

                        return result;
                    };
                }

                return create.convertNodeListToArray(nodeList);
            },

            /**
             * replace default SELECT on custom comboBox
             *
             * @method comboBox
             * @param element
             * @param index {Number} index of element in collection
             */
            comboBox: function (element, index) {

                var elementAttributes = element.attributes,
                    elementAttributesCount = elementAttributes.length,
                    comboBoxElement = document.createElement('div'),
                    comboBoxContent = document.createElement('div'),
                    comboBoxCurrent = document.createElement('div'),
                    comboBoxButton = document.createElement('div'),
                    comboBoxInput = document.createElement('input'),
                    comboBoxContentWrap,
                    options = element.options,
                    optionsCount = options.length,
                    i,
                    optionTemp,
                    currentOption,
                    elements = controls.elements,
                    elementId = 'combo-box__' + new Date().getTime() + parseInt(index + elements.length, 10),
                    optionImage,
                    optGroup,
                    tempOptGroup;

                comboBoxElement.className = element.className;
                element.parentNode.setAttribute('id', element.getAttribute('id') || '');

                if (element.hasAttribute('data-module')) {
                    element.removeAttribute('data-module');
                    elementAttributesCount--;
                }

                for (i = 0; i < elementAttributesCount; i++) {
                    comboBoxElement.setAttribute(elementAttributes[i].name, elementAttributes[i].value);
                }

                comboBoxElement.setAttribute('id', elementId);
                comboBoxElement.setAttribute('tabindex', '0');
                comboBoxContent.setAttribute('class', 'select__content');
                comboBoxCurrent.setAttribute('class', 'select__current');

                comboBoxButton.setAttribute('class', 'select__button');

                if (element.hasAttribute('required')) {
                    comboBoxInput.setAttribute('required', 'required');
                }

                comboBoxInput.setAttribute('type', 'hidden');
                comboBoxInput.setAttribute('name', element.name);
                comboBoxInput.value = element.value;

                comboBoxElement.appendChild(comboBoxCurrent);
                comboBoxElement.appendChild(comboBoxContent);

                comboBoxContent.innerHTML = '<div></div>';
                comboBoxContentWrap = comboBoxContent.querySelector('div');

                comboBoxContent.setAttribute('id', elementId + '_content');

                comboBoxCurrent.innerHTML = '<span></span>';
                comboBoxCurrent.appendChild(comboBoxButton);

                for (i = 0; i < optionsCount; i++) {
                    if (options[i].hasAttribute('data-action')) {
                        optionTemp = document.createElement('a');
                        optionTemp.setAttribute('href', options[i].getAttribute('data-action'));
                        optionTemp.setAttribute('data-href', options[i].getAttribute('data-href'));
                    } else {
                        optionTemp = document.createElement('div');
                    }

                    optionImage = '';

                    optionTemp.setAttribute('class', 'select__option');
                    optionTemp.setAttribute('data-value', options[i].value);
                    optionTemp.setAttribute('data-index', i.toString());

                    if (options[i].hasAttribute('data-image')) {
                        optionTemp.innerHTML =
                            '<span class="select__image">' +
                                '<img src="' + options[i].getAttribute('data-image') + '">' +
                                '</span>' +
                                '<span class="select__image-text">' + options[i].textContent ||
                                options[i].innerText || '</span>';
                    } else {
                        optionTemp.innerHTML = options[i].textContent || options[i].innerText || '';
                    }

                    if (options[i].parentNode.tagName.toLowerCase() === 'optgroup') {

                        if (optGroup !== options[i].parentNode.getAttribute('label')) {
                            tempOptGroup = document.createElement('div');
                            tempOptGroup.className = 'select__opgroup';
                            tempOptGroup.innerHTML = optGroup =  options[i].parentNode.getAttribute('label');
                            comboBoxContentWrap.appendChild(tempOptGroup);
                        }
                    }

                    if (optGroup !== undefined) {
                        optionTemp.classList.add('in-group')
                    }

                    comboBoxContentWrap.appendChild(optionTemp);

                    if (i === element.selectedIndex) {
                        optionTemp.className += ' active';
                    }

                    if (options[i].selected) {
                        currentOption = options[i];
                    }

                }

                if (currentOption) {
                    comboBoxCurrent.querySelector('span').innerHTML =
                        currentOption.textContent || currentOption.innerText || '';
                }

                comboBoxElement.appendChild(comboBoxInput);
                element.parentNode.replaceChild(comboBoxElement, element);


                elements.push({
                    element: comboBoxElement,
                    scroll: null
                });

                initScroll(elements[elements.length - 1]);
            }
        },

        /**
         * Event handlers of combobox
         *
         * @type {{show: Function, hide: Function, comboBoxClick: Function, comboBoxHeaderClick: Function,
         * comboBoxItemClick: Function}}
         */
        handlers = {

            /**
             * show drop down list
             *
             * @method show
             * @param element
             */
            show: function (element) {
                self.hideAll();

                var elements = controls.elements,
                    i,
                    elementsCount = elements.length,
                    iScroll,
                    activeElement = element.querySelector('.select__option.active');

                for (i = 0; i < elementsCount; i++) {
                    if (elements[i].element === element) {
                        iScroll = elements[i].scroll;
                    }
                }

                $(element).addClass('active');

                if (iScroll) {
                    iScroll.scrollToElement(activeElement, 0);
                }
            },

            /**
             * hide drop down list
             *
             * @param element
             */
            hide: function (element) {
                $(element).removeClass('active');
            },

            /**
             * Click by comboBox
             *
             * @method comboBoxClick
             * @param event
             */
            comboBoxClick: function (event) {
                core.stopPropagation(event);
                core.preventDefault(event);
            },

            /**
             * Click by comboBox header
             *
             * @method comboBoxHeaderClick
             */
            comboBoxHeaderClick: function (event) {
                var element = this,
                    parent = element.parentNode,
                    jParent = $(parent);

                event.stopPropagation();

                if (jParent.hasClass('active')) {
                    handlers.hide(parent);
                } else {
                    handlers.show(parent);
                }
            },

            comboBoxItemChange: function (comboBox) {

                var dataChange = comboBox.getAttribute('data-change'),
                    action = comboBox.getAttribute('action'),
                    value = comboBox.querySelector('input').value;

                if (dataChange) {

                    core.ajaxSend({
                        url: global.controls.baseUrl + 'ajax/' + action + '/' + value,
                        dataType: 'json',
                        callback: function (data) {

                            var changeElement = document.getElementById(dataChange),
                                div = document.createElement('template'),
                                fragment = document.createDocumentFragment();

                            if (parseInt(data.code, 10) === 0) {

                                div.innerHTML = data.content;

                                //while (div.firstChild) {
                                //    fragment.appendChild(div.firstChild);
                                //}

                                $(changeElement).replaceWith(data.content)/*.parentNode.replaceChild(div, changeElement)*/;

                            } else {

                                modules.Notification.show({
                                    type: 'error',
                                    message: data.message
                                });

                            }

                            $(comboBox).trigger('change');
                        }
                    });

                } else {
                    $(comboBox).trigger('change');
                }
            },

            comboBoxItemSetActive: function () {
                var element = this,
                    jElement = $(element),
                    parent = element.parentNode.parentNode.parentNode,
                    input = parent.querySelector('input[type="hidden"]'),
                    activeItem = parent.querySelector('.active');

                if (!jElement.hasClass('active')) {

                    input.value = element.getAttribute('data-value');
                    parent.querySelector('span').innerHTML = element.textContent || element.innerText || '';

                    if (activeItem) {
                        $(activeItem).removeClass('active');
                    }

                    jElement.addClass('active');
                    handlers.comboBoxItemChange(parent);
                }

                return parent;
            },

            /**
             * Click by comboBox item
             *
             * @method comboBoxItemClick
             */
            comboBoxItemClick: function () {

                var parent = handlers.comboBoxItemSetActive.call(this);

                handlers.hide(parent);
            },

            /**
             * ComboBox keydown
             *
             * @method comboBoxKeyDown
             */
            comboBoxKeyDown: function (event) {

                var preventDefault = FRONDEVO_ADMIN.core.preventDefault;

                switch (event.keyCode) {
                case 13:
                    preventDefault(event);
                    handlers.hide(event.target);
                    break;
                case 27:
                    preventDefault(event);
                    handlers.hide(event.target);
                    break;
                case 32:
                    preventDefault(event);
                    handlers.show(this);
                    break;
                case 38:
                    preventDefault(event);
                    handlers.prevItem(this);
                    break;

                case 40:
                    preventDefault(event);
                    handlers.nextItem(this);
                    break;
                }
            },

            movePosition: function (element, direction) {
                var elements = controls.elements,
                    i,
                    elementsCount = elements.length,
                    options = element.querySelectorAll('.select__option'),
                    activeOption = element.querySelector('.select__option.active'),
                    newActive,
                    count = options.length,
                    currentPosition,
                    newPosition,
                    iScroll;

                for (i = 0; i < elementsCount; i++) {
                    if (elements[i].element === element) {
                        iScroll = elements[i].scroll;
                    }
                }

                currentPosition = parseInt(activeOption.getAttribute('data-index'), 10);
                newPosition = currentPosition + direction;

                if (direction > 0) {
                    if (newPosition >= count) {
                        return;
                    }
                } else {
                    if (newPosition < 0) {
                        return;
                    }
                }

                newActive = element.querySelector('.select__option[data-index="' + newPosition + '"]');

                if (newActive) {
                    handlers.comboBoxItemSetActive.call(newActive);

                    if (iScroll) {
                        iScroll.scrollToElement(newActive, 0);
                    }

                }
            },

            nextItem: function (element) {
                handlers.movePosition(element, 1);
            },

            prevItem: function (element) {
                handlers.movePosition(element, -1);
            },

            /**
             * Wrap click
             *
             * @method wrapClick
             */
            wrapClick: function (event) {

                if (event.target.nodeName === 'INPUT' && event.target.type === 'radio') {
                    return;
                }


                self.hideAll();
            }
        };

    /**
     * Create elements
     *
     * @method createElements
     * @param param
     */
    function createElements(param) {

        var elements = create.convertNodeListToArray(param.elements),
            elementsCount = elements.length,
            i;

        if (!elements || !elementsCount) {
            return;
        }

        for (i = 0; i < elementsCount; i++) {

            if (elements[i] == undefined) {
                continue;
            }

            create.comboBox(elements[i], i);
        }
    }

    /**
     * get parameters
     *
     * @method getParameters
     * @param param
     */
    function getParameters(param) {
        parameters = param;
    }

    /**
     * add event listener
     *
     * @method addEventList
     * @param param
     */
    function addEventList(param) {
        var wrap = param.wrap;

        $(wrap).on('click', '.select', handlers.comboBoxClick);
        $(wrap).on('click', '.select .select__current', handlers.comboBoxHeaderClick);
        $(wrap).on('click', '.select .select__option', handlers.comboBoxItemClick);
        $(wrap).on('keydown', '.select', handlers.comboBoxKeyDown);
        $(wrap).on('click', handlers.wrapClick);
    }

    /**
     * remove event listener from comboBox
     *
     * @method removeEventList
     * @param param
     */
    function removeEventList(param) {
        var wrap = param.wrap;

        $(wrap).off('click', '.select');
        $(wrap).off('click', '.select .select__current');
        $(wrap).off('click', '.select .select__option');
    }

    /**
     * init custom comboBox
     *
     * @method init
     */
    function init() {
        getParameters(param);
        createElements(param);
        addEventList(param);
    }

    /**
     * append new comboBox
     *
     * @method add
     */
    this.add = function (element) {

        if (!element) {
            return;
        }

        create.comboBox(element, 0);
    };

    /**
     * Remove element from DOM and from Class
     *
     * @method remove
     * @param element
     */
    this.remove = function (element) {
        var i,
            elements = controls.elements,
            elementsCount = elements.length;

        for (i = 0; i < elementsCount; i++) {

            if (elements[i].element === element) {

                if (elements[i].scroll) {
                    elements[i].scroll.destroy();
                }

                elements.splice(i, 1);

                if (element.parentNode) {
                    element.parentNode.removeChild(element);
                }

                break;
            }
        }
    };

    /**
     * Destroy element
     *
     * @method destroy
     */
    this.destroy = function () {
        delete controls.elements;
        removeEventList(param);
    };

    /**
     * Hide all drop down list
     *
     * @method hideAll
     */
    this.hideAll = function () {
        var comboBoxes = controls.elements,
            comboBoxesCount = comboBoxes.length,
            i;

        for (i = 0; i < comboBoxesCount; i++) {
            handlers.hide(comboBoxes[i].element);
        }

    };

    this.updateScroll = function () {
        var elements = controls.elements,
            count = elements.length,
            i,
            tempContent,
            scrollIndicator;

        for (i = 0; i < count; i++) {
            tempContent = elements[i].element.querySelector('.select__content');

            if (tempContent) {
                tempContent.classList.remove('init-complete');
                tempContent.style.cssText = '';
                tempContent.querySelector('.iScrollVerticalScrollbar').style.cssText = '';
            }

            elements[i].scroll.refresh();

            if (tempContent) {
                scrollIndicator = tempContent.querySelector('.iScrollIndicator');

                if (scrollIndicator && !scrollIndicator.clientHeight) {
                    tempContent.querySelector('.iScrollVerticalScrollbar').style.cssText = 'display: none';
                }

                tempContent.classList.add('init-complete');
            }
        }
    };

    this.cloneAdd = function (dom) {
        var id,
            content;

        id = 'combo-box__' + new Date().getTime() + parseInt(controls.elements.length, 10);
        content = dom.querySelector('.select__content');

        dom.setAttribute('id', id);
        content.setAttribute('id', id + '_content');
        content.classList.remove('init-complete');
        $(dom).find('.iScrollVerticalScrollbar').remove();

        controls.elements.push({
            element: dom,
            scroll: null
        });

        initScroll(controls.elements[controls.elements.length - 1]);
    };


    return init();
};

FRONDEVO_ADMIN.config.select_init = function (object) {
    var global = FRONDEVO_ADMIN.global,
        globalControls = global.controls,
        wrap = global.wrap,
        modules = FRONDEVO_ADMIN.modules;

    if (globalControls.select !== undefined) {
        globalControls.select.add(object);
    } else {
        globalControls.select = new modules.Select({
            wrap: wrap,
            elements: wrap.querySelectorAll('[data-module="select"]')
        });
    }
};