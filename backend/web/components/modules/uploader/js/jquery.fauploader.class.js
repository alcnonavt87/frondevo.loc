/*
 FAUploader Class
 Version:
 ---
 Frondevo corp.
 http://frondevo.com
 Author: Andrew "Bikkuri" Kosyack
 */

FRONDEVO_ADMIN.core.namespace('modules.FAUploader');

FRONDEVO_ADMIN.modules.FAUploader = function ($wrap, params) {
    "use strict";

    var	self = this,
        acceptedFiles = {
            docs: {
                exp: /(\.|\/)(doc|docx|xls|xlsx|txt|pdf)$/i,
                ext: '.doc, .docx, .xls, .xlsx, .txt, .pdf'
            },
            imgs: {
                exp: /(\.|\/)(gif|jpe?g|png|apng)$/i,
                ext: '.gif, .jpeg, .jpg, .png'
            }
        },
        currentFormat = acceptedFiles['imgs'],
        format = 'imgs',
        userFormat = '';

    self.elems = {
        wrap: $wrap,
        fileList: $wrap.find('.fa__file-list').eq( 0 ),
        titleList: $wrap.find('.fa__file-edit-list').eq( 0 ),
        progressBar: $wrap.find( '.progress' )
    };
    userFormat = self.elems.wrap.attr('data-accept-formats');

    if (userFormat) {
        currentFormat = acceptedFiles[userFormat] || acceptedFiles['imgs'];
        format = userFormat || 'imgs';
    }

    self.singleUpload = false;
    self.descriptionUpload = false;

    // check for single file
    if ( self.elems.wrap.hasClass( 'single' ) ) {
        self.elems.wrap.find( 'input[type=file]').eq( 0).removeAttr( 'multiple' );
        self.singleUpload = true;
    } else {
        self.elems.wrap.find( 'input[type=file]').eq( 0).attr( 'multiple', 'true' );
    }

    // check for description upload
    if ( self.elems.wrap.attr( 'data-description-fld' ) ) {
        self.descriptionUpload = true;
    }

    self.id = self.elems.wrap.attr( 'id' );
    self.settings = {
        filePath: self.elems.wrap.attr( 'data-filepath' ),
        format: format,
        uploader: {
            /*url: 'modules/uploader/php/',*/
            url: self.elems.wrap.attr( 'data-href' ) + self.elems.wrap.attr( 'data-action' ),
            dataType: 'json',
            acceptFileTypes: currentFormat.exp,
            autoUpload: false,
            maxFileSize: 5000000, // 5 MB
            //disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
			disableImageResize: true,
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            dropZone: self.elems.wrap,
            messages: {
                maxNumberOfFiles: 'Ошибка! </br>Превышено максимальное кол-во файлов!',
                acceptFileTypes: 'Ошибка! </br>Недопустимый формат файла! </br>Допускается: ' + currentFormat.ext,
                maxFileSize: 'Ошибка! </br>Файл слишком большой!',
                minFileSize: 'Ошибка! </br>Файл слишком мал!'
            }
        },
        wrapPreview: function( data ){
            var //emptyIdx = self.setEmptyIdx(),
                idx = typeof emptyIdx == 'number' ? emptyIdx : self.elems.fileList.children().length,
                formatClass = self.settings ? ' fa__file_' + self.settings.format : '',
                placeIdx = self.elems.fileList.children().length,
                nameTitle = 'images['+ data.id +'][imgTitle]',
                namePlace = 'images['+ data.id +'][picking]',
                nameId = 'images['+ data.id +'][imgId]',
                nameDeleted = 'images['+ data.id +'][deleted]',
                nameDescr = 'images['+ data.id +'][imgDesc]',
                descr = data.descr || '',
                title = data.title;
            /*title = self.titles[ nameTitle ] || '';*/

            return $('<div class="fa__file' + formatClass + '">' +
                '<a href="' + data.colorbox + '" title="' + title + '" rel="' + self.id + '">' +
                '<span class="fa__file-img">' +
                '<span class="fa__file-cell"></span>' +
                    '<input class="title-fld" type="hidden" name="'+ nameTitle +'" value="'+ title +'">' +
                    '<input class="place-fld" type="hidden" name="'+ namePlace +'" value="'+ placeIdx +'">' +
                    (self.descriptionUpload ? '<input class="descr-fld" type="hidden" name="'+ nameDescr +'" value="' + descr + '">' : '') +
                    '<input class="item-id" type="hidden" name="'+ nameId +'" value="'+ data.id +'">' +
                    '<input class="item-deleted" type="hidden" name="'+ nameDeleted +'" value="0">' +
                '</span>' +
                '<span class="fa__file-title">'+title+'</span>' +
                '</a>' +
                '<input class="button button_small button_edit" type="button" title="Редактировать" value="Редактировать">' +
                '<input class="button button_small button_delete" type="button" title="Удалить" value="Удалить">' +
                '</div>').find( '.fa__file-cell').eq( 0 ).html( data.preview ).parents( '.fa__file').eq( 0 );
        },
        listPreview: function( data ){

            data = data || {};

            var //emptyIdx = self.getEmptyIdx(),
                idx = typeof emptyIdx == 'number' ? emptyIdx : ( self.elems.fileList.children().length + self.elems.titleList.children().length ),
            //name = data.name || self.id + '__item'+ idx +'__title',
                formatClass = self.settings.format ? ' fa__edit-file_' + self.settings.format : '',
                name = data.name || 'images[imgid][imgTitle]',
                descrName = data.descrName || 'images[imgid][imgDesc]',
                title = data.title || '',
                descr = data.descr || '',
                preview = data.noPreview ? '' : '<span class="fa__file-img"><span class="fa__file-cell">' + data.preview + '</span></span>';

            return $( '<li class="fa__edit-file' + formatClass + '">' + preview +
                '<span class="fa__edit-input">' +
                '<span class="input-row input-wrap"><input class="input catalog_input input-width_400 item-alt" name="'+ name +'" type="text" value="'+ title +'"></span>' +
                (self.descriptionUpload ? '<span class="input-row input-wrap"><textarea class="textarea textarea-width_400x100 item-description" name="'+ descrName +'">' + descr + '</textarea></span>' : '') +
                '</span>' +
                '</li>');
        },
        popupBtns: '<div class="fa__file-edit-btns">' +
            '<span class="button save">Загрузить</span>' +
            '<span class="button cancel">Отмена</span>' +
            '</div>',
        popupBtns2: '<div class="fa__file-edit-btns">' +
            '<span class="button edit">Изменить</span>' +
            '<span class="button cancel">Отмена</span>' +
            '</div>'

    };
    $.extend( self.settings, params );

    //self.childs = self.elems.fileList.children().length;
    self.childs = 0;

    self.init();

    return this;
};

FRONDEVO_ADMIN.modules.FAUploader.prototype = {
    init: function( params ){
        var	self = this,
            options = self.settings,
            elems = self.elems;

        self.popup = new FRONDEVO_ADMIN.modules.ExtendPopup({
            data: '<div class="fa__file-edit-wrap"></div>',
            handlers: [
                {
                    type: 'click',
                    element: '.button.save',
                    f: function (event) {
                        if (self.uploaderData.length) {
                            self.titles = $.parseParams( elems.titleList.serializeAnything() );
                            self.popup.hide();
                            self.upload();
                            FRONDEVO_ADMIN.modules.listener.add(null, 'uploader-data-change');
                        }
                    }
                },
                {
                    type: 'click',
                    element: '.button.cancel',
                    f: function (event) {
                        if (self.uploaderData.length) {
                            elems.titleList.empty();
                            self.uploaderData = [];
                            FRONDEVO_ADMIN.modules.listener.add(null, 'uploader-data-change');
                        };
                        self.popup.hide();
                    }
                },
                {
                    type: 'click',
                    element: '.button.edit',
                    f: function (event) {

                        function findInput (el, name) {
                            var $elems = $(el),
                                result = null;
                            $elems.each(function (key, value) {
                                if ($(value).attr('name') && $(value).attr('name') === name) {
                                    result = $(value);
                                    return false;
                                }
                            });
                            return result;
                        };

                        if (self.editNow) {
                            var $input = $( self.popup.controls.popupContent ).find( '.item-alt').eq( 0),
                                $descr = $( self.popup.controls.popupContent ).find( '.item-description').eq( 0),
                                value = $input.val(),
                                $targetInput = findInput('.fa__file-img input', $input.attr( 'name' ));

                            if ($targetInput) {
                                var $parent = $targetInput.parents('.fa__file').eq(0),
                                    $targetTitle = $parent.find('.fa__file-title').eq(0),
                                    $targetDescr = $parent.find( '.descr-fld').eq(0),
                                    $lnk = $parent.find( '>a').eq( 0 );

                                $targetInput.val( value );
                                $targetTitle.text( value );
                                $lnk.attr( 'title', value );

                                if ($targetDescr.length) {
                                    $targetDescr.val($descr.val());
                                }
                            }

                            self.popup.hide();
                            FRONDEVO_ADMIN.modules.listener.add(null, 'uploader-data-change');
                        }
                    }
                }
            ],
            callback: {
                beforeShow: function () {
                    $(self.popup.controls.popupContent).find('.fa__file-edit-list input, .fa__file-edit-list textarea').each(function (key, value) {
                        $(value)
                            .attr('name', $(value).data('name'))
                            .attr('data-name', $(value).attr('name'));
                    });
                },
                afterShow: function () {
                    $( self.popup.controls.popupContent ).find( 'input').eq( 0 ).focus();
                    self.uploader.fileupload( 'option', 'disabled', true );
                },
                beforeClose: function () {
                    $('.fa__file-edit-list input, .fa__file-edit-list textarea').each(function (key, value) {
                        $(value)
                            .attr('data-name', $(value).attr('name'))
                            .removeAttr('name');
                    });
                },
                afterClose: function () {
                    // чистим список файлов
                    elems.titleList.empty();
                    // чистим список сабмитов
                    self.uploaderData = [];
                    // кеш начального списка
                    elems.titleList = elems.wrap.find('.fa__file-edit-list').eq( 0 );
                    // сброс счетчика дочерних
                    self.childs = self.elems.titleList.children().length;

                    // обнуление типа попапа
                    $( self.popup.controls.popupContent.childNodes[0]).removeClass( 'short' );
                    /*extendPopup.show(
                     '<div>Абалдеть, тащусь <span class="button">Еще одна кнопка</span></div>'
                     );*/

                    //self.tempidstore = [].concat( self.idstore );
                    self.uploader.fileupload( 'option', 'disabled', false );

                }
            }
        });

        self.totalFiles = 0;
        self.totalFilesLoaded = 0;
        self.uploaderData = [];

        self.uploader = elems.wrap.fileupload( options.uploader /*{
            url: options.url,
            dataType: options.dataType,
            autoUpload: options.autoUpload,
            acceptFileTypes: options.acceptFileTypes,
            maxFileSize: options.maxFileSize, // 5 MB
            disableImageResize: options.disableImageResize,
            previewMaxWidth: options.previewMaxWidth,
            previewMaxHeight: options.previewMaxHeight,
            dropZone: elems.wrap
        }*/ );

        self.needClearQueue = true;
        self.uploader
            .on( 'fileuploadadd', function( e, data ){
                data.context = elems.titleList;

                $.each(data.files, function (index, file) {
                    var $file = options.listPreview();
                    $file.appendTo(data.context);
                });
                self.uploaderData.push( data );

                self.totalFiles++;

            } )
            .on( 'fileuploadchange fileuploaddrop', function( e, data ){

                setTimeout(function () {

                    if (!data.files[0].error) {
                        // вставка списка фото с полями для подписей
                        self.popup.show( elems.titleList.parent()[ 0 ].outerHTML + options.popupBtns );
                        // кеширование списка
                        elems.titleList = $( self.popup.controls.popup ).find( '.fa__file-edit-list').eq( 0 );

                        self.dragover = false;
                        elems.wrap.removeClass( 'dragover' );
                    } else {
                        alert(data.files[0].error);
                        if (self.uploaderData.length) {
                            elems.titleList.empty();
                            self.uploaderData = [];
                        };
                        self.popup.hide();
                    }
                }, 50);

            } )
            .on( 'fileuploaddragover', function( e, data ){
                self.dragover = true;
                elems.wrap.addClass( 'dragover' );
            })
            .on('fileuploadprocessalways', function (e, data) {
                setTimeout(function () {
                    var index = data.index,
                        file = data.files[index],
                        node = $( elems.titleList.children()[index + self.childs] );

                    node = node.length ? node : $( elems.titleList.children()[0] );

                    if (file.preview) {
                        console.log(file.preview);
                        // уменьшаем в два раза
                        $( file.preview ).css( {
                            width: file.preview.width *.5,
                            height: file.preview.height *.5
                        } );
                        node.find( '.fa__file-cell').eq( 0 ).html( file.preview );
                    }
                    if (file.error) {
                        node.find( '.fa__file-cell').eq( 0 )
                            .html($('<span class="text-danger"/>').text(file.error));
                    }

                    self.childs++;
                }, 100);

            })
            .on('fileuploaddone', function (e, data) {

                self.totalFilesLoaded += 1;

                var index = data.index,
                    file = data.files[0],
                    node = $( elems.fileList.children()[index + self.childs]),
                    $pBar = elems.progressBar.find('.progress-bar'),
                    progress = ( self.totalFilesLoaded / self.totalFiles ) * 100;

                $pBar.animate( {
                    width: progress  + '%'
                }, 300, function(){
                    if ( progress >= 100 ) {
                        elems.progressBar.fadeOut( 500, function(){
                            self.totalFilesLoaded = 0;
                            self.totalFiles = 0;
                            $pBar.css( 'width', 0 );
                            self.elems.fileList.find( '.fa__file > a').colorbox();
                        } );
                    }
                } );

                if (file.preview) {

                    // в нормальный размер
                    $( file.preview ).css( {
                        width: file.preview.width,
                        height: file.preview.height
                    } );

                    var $item = options.wrapPreview( {
                        colorbox: data.jqXHR.responseJSON.filepath || '#',
                        preview: file.preview,
                        title: data.formData.value,
                        descr: data.formData.description,
                        id: data.jqXHR.responseJSON.id
                    } );
                    $item.data( 'preview', file.preview );
                    if ( self.singleUpload ) {
                        elems.fileList.html( $item );
                    } else {
                        elems.fileList.append( $item );
                    }

                    $item.find( '> a').colorbox();

                } else if (self.settings.format === 'docs') {
                    var $item = options.wrapPreview( {
                        //colorbox: data.jqXHR.responseJSON.filepath || '#',
                        //preview: file.preview,
                        format: 'docs',
                        title: data.formData.value,
                        descr: data.formData.description,
                        id: data.jqXHR.responseJSON.id
                    } );
                    //$item.data( 'preview', file.preview );
                    if ( self.singleUpload ) {
                        elems.fileList.html( $item );
                    } else {
                        elems.fileList.append( $item );
                    }

                    $item.find( '> a').colorbox();
                }

                if (file.error) {

                }
            });

        self.controls();

        // fix for sortable in Mozilla
        if(navigator.userAgent.toLowerCase().match(/firefox/)) {
            $('html').css('overflow-y', 'inherit');
        }
        elems.fileList.sortable( {
            tolerance: "pointer",
            containment: 'parent',
            helper: 'clone',
            stop: function(){
                elems.fileList.css( 'min-height', 0 );
            },
            update: function( event, ui ) {
                var $items = elems.fileList.find( '.fa__file' );

                $.each( $items, function( key, value ){
                    var $input = $( value ).find( '.place-fld').eq( 0 );
                    $input.val( key );
                } );
            }
        } );
        elems.fileList.disableSelection();

        // заполняем хранилище id элементов
        //self.fillIdxStorage();

        // colorbox
        self.elems.fileList.find( '.fa__file > a').colorbox();

        return this;
    },

    /*// получение ближайшего пустого индекса
     setEmptyIdx: function(){
     var self = this,
     idx = null;

     $.each( self.idstore, function( key, value ){
     if ( !value ) {
     idx = key.toString();
     self.idstore[ key ] = idx;
     return false;
     }
     } );

     if ( !idx ) {
     idx = self.idstore.length.toString();
     self.idstore.push( idx );
     }

     return idx;
     },

     // получение ближайшего пустого индекса
     getEmptyIdx: function(){
     var self = this,
     idx = null;

     $.each( self.tempidstore, function( key, value ){
     if ( !value ) {
     idx = key.toString();
     self.tempidstore[ key ] = idx;
     return false;
     }
     } );

     if ( !idx ) {
     idx = self.tempidstore.length.toString();
     self.tempidstore.push( idx );
     }

     return idx;
     },

     // заполнение хранилища индексов елементов
     fillIdxStorage: function(){
     var self = this,
     elems = self.elems;

     self.idstore = [];
     self.tempidstore = [];
     elems.fileList.find( '.fa__file' ).each( function( key, value ){
     var name = $( value).find( '.title-fld').eq( 0 ).attr( 'name').split( '__')[ 1 ],
     idx = name.match( /\d/ )[0],
     curIdx = 0;

     while ( curIdx != idx ) {
     if ( !self.idstore[ curIdx ] ) {
     self.idstore[ curIdx ] = null;
     }
     curIdx ++;
     }
     self.idstore[ curIdx ] = idx.toString();

     } );

     self.tempidstore = [].concat( self.idstore );

     },*/

    upload: function( callback ){
        var self = this,
            elems = self.elems,
            options = self.settings;

        // показ прогресса
        elems.progressBar.fadeIn( 200 );

        $.each( self.uploaderData, function( key, value ){

            var $input = elems.titleList.find( '.item-alt').eq( key),
                $area = elems.titleList.find( '.item-description').eq( key),
                data = {
                    name: $input.attr( 'name' ),
                    value: $input.val(),
                    place: key,
                    description: $area.length ? $area.val() : '',
                    id: self.elems.wrap.attr('id')
                };

            elems.wrap.fileupload( 'option', 'formData', data );
            value.submit();
        } );

        self.uploaderData = [];
        elems.titleList.empty();

        if ( typeof callback == 'function' ) callback();
    },



    controls: function(){
        var	self = this,
            elems = self.elems,
            options = self.settings;

        // реакция на драг
        elems.wrap.on( {
            dragout: function(){
                elems.wrap.removeClass( 'dragover' );
                self.dragover = false;
            },
            mouseleave: function(){
                elems.wrap.removeClass( 'dragover' );
                self.dragover = false;
            }
        } );


        // обработчик редактирования
        elems.wrap.on( {
            click: function(){
                var $origin = $(this).parents( '.fa__file').eq( 0 ),
                    title = $origin.find( '.fa__file-title').eq( 0 ).text(),
                    name = $origin.find( 'input').eq( 0 ).attr( 'name' ),
                    descr = $origin.find('.descr-fld').eq(0).val() || '',
                    $popupContent = $( self.popup.controls.popupContent.childNodes[0]),
                    $popupTitle, $popupInput,
                    $file = options.listPreview( {
                        title: title,
                        name: name,
                        descr: descr,
                        noPreview: true
                    } );

                // короткий попап
                $popupContent.addClass( 'short' );

                elems.titleList.html( $file );
                self.popup.show( self.popup.show( elems.titleList.parent()[ 0 ].outerHTML + options.popupBtns2 ) );

                // заголовок
                $popupTitle = $( self.popup.controls.popupContent).find( '.catalog__section-header-text').eq( 0 );
                $popupTitle.text( $popupTitle.attr( 'data-edit' ) );

                self.editNow = $origin;
            }
        }, '.button_edit' );


        // обработчик удаления
        elems.wrap.on( {
            click: function(){

                var $btn = $( this),
                    $file = $( this ).parents( '.fa__file').eq( 0),
                    $wrap = $file.children().eq( 0 );

                $file.find('.cboxElement').removeAttr('rel');
                TweenMax.to( $file, .3, {
                    css: {
                        scaleX: 0,
                        autoAlpha: 0,
                        width: 0,
                        borderWidth: 0,
                        marginLeft: 0,
                        marginRight: 0
                    },
                    onComplete: function(){
                        elems.fileList.css( 'min-height', 0 );
                        $file.find( '.item-deleted').val( '1' );
                    }
                } );

                FRONDEVO_ADMIN.modules.listener.add(null, 'uploader-data-change');

            }
        }, '.button_delete' );


        elems.fileList.on( {
            mouseover: function(){
                elems.fileList.css( 'min-height', 134 );
            },
            mouseout: function(){
                elems.fileList.css( 'min-height', 0 );
            }
        } );


        return this;
    }
};

(function($) {

    $.fn.serializeAnything = function() {

        var toReturn	= [];
        var els 		= $(this).find(':input').get();

        $.each(els, function() {
            if (this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /text|hidden|password/i.test(this.type))) {
                var val = $(this).val();
                toReturn.push( encodeURIComponent(this.name) + "=" + encodeURIComponent( val ) );
            }
        });

        return toReturn.join("&").replace(/%20/g, "+");

    }

    var $event = $.event,
        $special = $event.special,

        dragout = $special.dragout = {

            current_elem: false,

            setup: function( data, namespaces, eventHandle ) {
                $('body').on('dragover.dragout',dragout.update_elem)
            },

            teardown: function( namespaces ) {
                $('body').off('dragover.dragout')
            },

            update_elem: function(event){
                if( event.target == dragout.current_elem ) return
                if( dragout.current_elem ) {
                    $(dragout.current_elem).parents().andSelf().each(function(){
                        if($(this).find(event.target).size()==0) $(this).triggerHandler('dragout')
                    })
                }
                dragout.current_elem = event.target
                event.stopPropagation()
            }

        }

    var re = /([^&=]+)=?([^&]*)/g;
    var decodeRE = /\+/g;  // Regex for replacing addition symbol with a space
    var decode = function (str) {return decodeURIComponent( str.replace(decodeRE, " ") );};
    $.parseParams = function(query) {
        var params = {}, e;
        while ( e = re.exec(query) ) {
            var k = decode( e[1] ), v = decode( e[2] );
            if (k.substring(k.length - 2) === '[]') {
                k = k.substring(0, k.length - 2);
                (params[k] || (params[k] = [])).push(v);
            }
            else params[k] = v;
        }
        return params;
    };

})(jQuery);

FRONDEVO_ADMIN.config.FAUploader_init = function (object) {

    var modules = FRONDEVO_ADMIN.modules;

    if (object === undefined) {
        object = $('[data-module="FAUploader"]');
    } else {
        object = $(object);
    }

    object.each(function (key, value) {
        value.removeAttribute('data-module');
        var uploader = new modules.FAUploader($(value), {});
    });
};