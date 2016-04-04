/*
 ExFilter Class
 Version: 10.02.2014
 ---
 Frondevo corp.
 http://frondevo.com
 Author: Andrew "Bikkuri" Kosyack
 */
function ExFilter( params ){
    var	self = this;

    self.elems = {
        form: $( '.icmsr-tabs').eq( 0 ),
        list: $( '.icmsr-list').eq( 0 )
    };

    self.elems.checks = self.elems.form.find( '.icmsr-tab' );
    self.elems.items = self.elems.list.find( '.icmsr-item' );


    self.settings = {
        action: self.elems.form.attr( 'data-action' )
    };
    $.extend( self.settings, params );

    self.init( params );

    return this;
};



ExFilter.prototype = {
    init: function( params ){
        var	self = this;

        self.controls();

        return this;
    },

    addPreloader: function( $wrap ){
        var self = this,
            $preloader = {};

        $wrap = $wrap || $( 'body' );
        $preloader = $wrap.find('>.filters-preloader');
        if (!$preloader.length) {
            $wrap.append( '<div class="filters-preloader"><span></span></div>' );
            $preloader = $wrap.find('>.filters-preloader');
        }

        TweenMax.to($preloader, 0.3, {
            autoAlpha: 1
        });

        return this;
    },
    removePreloader: function( $wrap ){
        var self = this,
            $preloader = {};

        $wrap = $wrap || $( 'body' );
        $preloader = $wrap.find( '>.filters-preloader' ).remove();
        TweenMax.to($preloader, 0.3, {
            autoAlpha: 0,
            onComplete: function () {
                $preloader.remove();
            }
        });
        return this;
    },

    showItems: function( items ){
        var self = this;

        self.elems.list.css( 'min-height', self.elems.list.height() );
        var times = 0;

        TweenMax.staggerTo( self.elems.items, .3, {
            css: {
                autoAlpha: 0
            },
            ease: Power1.easeIn,
            overwrite: 'all',
            onComplete: function(){
                times++;

                if ( times == self.elems.items.length ) {

                    // insert new items
                    self.elems.list.empty();
                    self.elems.list.html( items );

                    // new items grabbing
                    self.elems.items = self.elems.list.find( '>li' );

                    // set list height for "antijumping"
                    self.elems.list.css( 'min-height', 0 );

                    // show new items
                    TweenMax.staggerFromTo( self.elems.items, 1, {
                        css: {
                            autoAlpha: 0
                        }
                    }, {
                        css: {
                            autoAlpha: 1
                        },
                        ease: Power3.easeOut
                    }, .05 );

                    self.removePreloader( self.elems.list.parent() );

                };
            }

        }, .05 );


        return this;
    },

    getItemCode: function( data ){
        var self = this;

        return '<li class="icmsr-item">' +
            '   <div class="lightbox-item">' +
            '       <div class="lightbox-imgwrap">' +
            '           <a href="#" class="lightbox-lnk">' +
            '               <img src="' + data.img + '" alt="img" width="230" height="230" alt="' + data.imgalt + '">' +
            '          </a>' +
            '      </div>' +
            '   </div>' +
            '   <div class="icmsr-info">' +
            '       <div class="icmsr-header">' +
            '           <h3 class="icmsr-title">' + data.title + '</h3>' +
            '           <time datetime="' + data.date[1] + '">' + data.date[0] + '</time>' +
            '       </div>' +
            '       <div class="icmsr-descr">' + data.description + '</div>' +
            '   </div>' +
            '</li>';
    },

    getFiltered: function($tab){
        var self = this,
            settings = self.settings,
            data = $tab.attr('data-filter');

        /*if ( self.xhr ) {
            self.xhr.abort();
        }

        self.xhr = $.ajax( {
            url: settings.action,
            timeout: 10000,
            type: 'post',
            dataType: 'json',
            data: {filter: data},
            beforeSend: function(){
                self.addPreloader( self.elems.list.parent() );
            },
            complete: function( xhr, response ){
                var answer = xhr.responseJSON;

                if ( response == 'success' && answer.length ) {

                    *//*TweenMax.to( self.elems.list,.2, {
                        delay:.5,
                        autoAlpha: .7,
                        onComplete: function () {

                        }
                    } );*//*

                    var items = '';
                    $.each( answer, function( key, value ){
                        items += self.getItemCode( value );
                    } );

                    TweenMax.to( self.elems.list, .1, {
                        autoAlpha: 1,
                        overwrite: 'all',
                        onComplete: function(){
                            if (answer.length) {
                                self.showItems( items );
                            } else {

                            }
                        }
                    } );

                    self.elems.checks
                        .removeClass('active')
                        .removeClass('clicked');
                    $tab.addClass('active');


                } else {
                    self.elems.checks
                        .removeClass('clicked');
                    self.removePreloader( self.elems.list.parent() );
                }

            },
            error: function(){
                self.elems.checks
                    .removeClass('clicked');
                self.removePreloader( self.elems.list.parent() );
            }
        } );
*/

        var $currents = self.elems.items.filter(':not(.hidden)'),
            $targets = self.elems.items.filter('[data-filter=' + data + ']');
        $currents.addClass('target');
        setTimeout(function () {
            $currents
                .removeClass('target')
                .addClass('hidden');
            $targets.removeClass('hidden');

            setTimeout(function () {

            }, 300);
        }, 300);
        self.elems.checks
            .removeClass('active')
            .removeClass('clicked');
        $tab.addClass('active');

        return this;
    },

    controls: function(){
        var	self = this;

        // value change event ======================
        /*self.elems.form.on( {
            click: function(){
                self.getFiltered();
            }
        }, '.niceCheck' );*/

        // report tabs ====================================================
        self.elems.checks.on({
            click: function (event) {
                event.preventDefault();
                var $self = $(this);

                if ($self.hasClass('active') || $self.hasClass('clicked')) {
                    return false;
                }
                $self.addClass('clicked');
                self.getFiltered($self);

            }
        });

        return this;
    }
};