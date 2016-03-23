/**
 * Created by Valera Siestov on 08.11.13.
 */

/*global ATF_PARTNER */

/**
 js for field with autocomplete

 Autocomplete:
 methods:
 - getControls
 - createDropList
 - ajaxSend
 - getParameters
 - addEventList
 - init
 */

FRONDEVO_ADMIN.core.namespace('modules.AutoComplete');

FRONDEVO_ADMIN.modules.AutoComplete = function (field, callback) {

    "use strict";

    var Self = this;

    this.paramters = {};
    this.controls = {};

    this.getField = function() {
        return field;
    };

    // get elements of the autocomplete
    this.getControls = function() {

        var parentField = field.parent(),
            ctrl = Self.controls;

        ctrl.autocompleteWrap = parentField.find('.form-autocomplete-wrap');
        ctrl.autocompleteList = ctrl.autocompleteWrap.find('.form-autocomplete__list');
        ctrl.autocompleteItems = ctrl.autocompleteList.find('.form-autocomplete__list-item');
    };

    // create drop list
    this.createDropList = function(list) {

        function getListItem() {

            var html = [];

            for (var i = 0, length = list.length; i < length; i++) {
                html.push('<li class="form-autocomplete__list-item">' + list[i].name + '</li>\n');
            }

            return html.join('');
        }

        var html = [];

        if (Self.controls.autocompleteWrap) {
            Self.controls.autocompleteItems.remove();
            html.push(getListItem());
            Self.controls.autocompleteList.append(html.join(''));
            Self.controls.autocompleteItems = Self.controls.autocompleteList.find('.form-autocomplete__list-item');
        }
        else {
            html.push('<div class="form-autocomplete-wrap" style="display: none">\n');
            html.push('<ul class="form-autocomplete__list">\n');
            html.push(getListItem());
            html.push('</ul>\n');
            html.push('</div>\n');
            field.after(html.join(''));
            Self.getControls();
        }

        Self.controls.autocompleteWrap.slideDown();
    };

    // send ajax request, for get data autocomplete
    this.ajaxSend = function(text) {
        var dataToSend = field.attr('name') + '=' + text,
            form = field.parents('form');

        if (form.length) {
            dataToSend += '&' + form.serialize();
        }

        $.ajax({
            url: Self.paramters.php,
            type: 'get',
            data: dataToSend,
            dataType: 'json',
            beforeSend: function () {
                field.addClass('loading');
            },

            success: function(serverResponse, status, xhr) {

                if (xhr.status === 200) {
                    Self.createDropList(serverResponse.list);
                }
                else {
                    alert(status);
                }

            },
            error: function(xhr) {
                alert(xhr.statusText);
            },
            complete: function () {
                field.removeClass('loading');
            }
        });
    };

    // get field parameters
    this.getParameters = function() {
        Self.paramters.php = field.attr('data-php');
    };

    // keydown on autocomplete list
    this.moveCurrentPosition = function(direction) {

        var controls = Self.controls,
            itemList = controls.autocompleteItems,
            activeItem,
            listHeight = controls.autocompleteList.height(),
            itemHeight,
            listFullHeight,
            diference;

        if (!itemList || !itemList.length) {
            return;
        }

        activeItem = itemList.filter('.active');

        if (!activeItem.length) {

            itemList.eq(0).addClass('active');
            activeItem = itemList.eq(0);

        }
        else {

            if (direction > 0) {
                if (activeItem.index() === itemList.length - 1) {
                    activeItem.removeClass('active');
                    activeItem = itemList.eq(0);
                    activeItem.addClass('active');
                }
                else {
                    activeItem.removeClass('active').next().addClass('active');
                    activeItem = activeItem.next();
                }
            }
            else {
                if (activeItem.index() === 0) {
                    activeItem.removeClass('active');
                    activeItem = itemList.eq(itemList.length - 1);
                    activeItem.addClass('active');
                }
                else {
                    activeItem.removeClass('active').prev().addClass('active');
                    activeItem = activeItem.prev();
                }
            }

        }

        itemHeight = activeItem.outerHeight();

        listFullHeight = itemHeight * itemList.length;
        diference = listFullHeight - listHeight;

        var propPos = itemHeight * activeItem.index() / (listFullHeight - itemHeight);

        controls.autocompleteList.stop(true, true);
        controls.autocompleteList.animate({
            'scrollTop': Math.round(diference * propPos)
        }, 200);


    };

    // click to autocomplete item
    this.setActiveAutocompleteItem = function(currentItem, close) {

        field.val($(currentItem).html());

        if (close) {
            Self.controls.autocompleteWrap.slideUp();
        }

    };

    // add events
    this.addEventList = function() {

        var fieldParent = field.parent();

        field.on('keypress', function(event) {

            if (event.keyCode === 13) {
                field.trigger('change');

                if (Self.controls.autocompleteWrap) {
                    Self.controls.autocompleteWrap.slideUp();
                    if (callback) {
                        callback();
                    }
                }

                //event.stopPropagation();
                return false;
            }

        });

        //==============================================================================================================
        // event keyup for search field
        //==============================================================================================================
        field.on('keyup', function(event) {

            var element = this;
            if (event.keyCode === 40 || event.keyCode === 38) {
                return;
            }

            if (event.keyCode === 13) {
                return;
            }

            if (element.value.length) {
                clearTimeout(Self.controls.ajaxTimeOut);
                Self.controls.ajaxTimeOut = setTimeout(function () {
                    Self.ajaxSend(element.value);
                }, 500);

            }
            else if (Self.controls.autocompleteWrap) {
                Self.controls.autocompleteWrap.slideUp();
            }

            if (!this.value.length && Self.controls.autocompleteWrap) {
                Self.controls.autocompleteWrap.slideUp();
            }
        });

        field.on('focusout', function (event) {

            if (Self.controls.autocompleteWrap) {
                Self.controls.autocompleteWrap.slideUp();
            }

        });

        //==============================================================================================================
        // event keyup for autocomplete list
        //==============================================================================================================
        fieldParent.on('keyup', function(event) {

            if (event.keyCode === 27) {
                if (Self.controls.autocompleteWrap) {
                    Self.controls.autocompleteWrap.slideUp();
                }
                return;
            }

            if (event.keyCode === 40) {
                Self.moveCurrentPosition(1);
                Self.setActiveAutocompleteItem(Self.controls.autocompleteItems.filter('.active')[0], false);
            }
            else if (event.keyCode === 38) {
                Self.moveCurrentPosition(-1);
                Self.setActiveAutocompleteItem(Self.controls.autocompleteItems.filter('.active')[0], false);
            }

        });

        fieldParent.on('click', '.form-autocomplete__list-item', function() {
            Self.setActiveAutocompleteItem(this, true);
            field.trigger('change');
            if (callback) {
                callback();
            }
        });

        //==============================================================================================================
        // for hide autocomplete
        //==============================================================================================================
        $(document).on('click', function(event) {

            if (!$(event.target).hasClass('form-autocomplete-wrap') &&
                !$(event.target).parents('.form-autocomplete-wrap').length &&
                field[0] !== event.target) {

                if (Self.controls.autocompleteWrap) {
                    Self.controls.autocompleteWrap.slideUp();
                }
            }

        });

    };

    // init autocomplete for input field
    this.init = function() {
        this.getParameters();
        this.addEventList();
    };

    return this.init();
};

FRONDEVO_ADMIN.config.auto_complete_init = function (object) {
    var modules = FRONDEVO_ADMIN.modules,
        count,
        i,
        initAutoComplete = function (object) {
            object.autoComplete = new modules.AutoComplete($(object));
        };



    if (object === undefined) {
        object = document.querySelectorAll('[data-module="auto_complete"]');
    }

    if (object instanceof Array || object instanceof NodeList) {
        count = object.length;

        for (i = 0; i < count; i++) {
            initAutoComplete(object[i]);
        }

    } else {
        initAutoComplete(object);
    }

};