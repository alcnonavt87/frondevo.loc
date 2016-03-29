/*
    FDOSlider Class
    Version: 03-09-2014
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function FDOSlider(params) {
    'use strict';
    var self = this;

    self.elems = {
        wrap: $('.fdo-slider').eq(0)
    };
    self.elems.list = self.elems.wrap.find('ul');
    self.elems.items = self.elems.wrap.find('li');
    self.elems.slides = self.elems.wrap.find('.fdo-slider-img');

    self.settings = {
        interval: 10000
    };
    $.extend(self.settings, params);

    self.init(params);

    return this;
}



FDOSlider.prototype = {
    init: function () {
        'use strict';
        var self = this;

        // prepare html
        self.elems.items.each(function (key, value) {
            var $img = $(value).find('img').eq(0),
                $bg = $(value).find('.fdo-slider-img').eq(0),
                src = $img.attr('src');
            $bg.css({
                backgroundImage: 'url(' + src + ')'
            });
            $img.remove();
        });

        self.totalImages = self.elems.items.length;
        self.currentImage = 0;
        self.readyImage = 1;
        self.elems.items.eq(self.currentImage).addClass('in');
        self.elems.items.eq(self.readyImage).addClass('ready');

        self.startRotation();
        self.controls();

        return this;
    },

    startRotation: function () {
        var self = this;

        self.interval = setInterval(function () {
            self.nextImage();
        }, self.settings.interval);

        return this;
    },

    nextImage: function () {
        var self = this;

        self.elems.items
            .removeClass('out');
        self.elems.items.filter('.in').addClass('out');
        self.elems.items
            .removeClass('in')
            .removeClass('ready');

        self.elems.items.eq(self.currentImage).addClass('out');

        if (self.currentImage + 1 <= self.totalImages - 1) {
            self.currentImage += 1;
        } else {
            self.currentImage = 0;
        }

        if (self.readyImage + 1 <= self.totalImages - 1) {
            self.readyImage += 1;
        } else {
            self.readyImage = 0;
        }

        self.elems.items.eq(self.currentImage).addClass('in');
        self.elems.items.eq(self.readyImage).addClass('ready');

        return this;
    },

    controls: function () {
        'use strict';
        var self = this;

        return this;
    }
};