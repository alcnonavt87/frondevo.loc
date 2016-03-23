/**
 * Created by Valera Siestov on 24.04.2014.
 */

/*global FRONDEVO_ADMIN, document, window, $ */

/*jslint plusplus: true */

FRONDEVO_ADMIN.core.namespace('modules.color-picker');

FRONDEVO_ADMIN.modules.colorPicker = (function () {
    "use strict";

    /**
     * namespace for work with mouse
     *
     * @namespace mouse
     * @type {{pageX: pageX, pageY: pageY}}
     */
    var controls = {},
        mouse = {

            /**
             * Get mouse X - position
             *
             * @method pageX
             * @param {Event} b
             * @returns {number}
             */
            pageX: function (b) {

                var a = document.body,
                    c = document.documentElement,
                    d;

                d = b || window.event;

                b = parseInt(c.scrollLeft, 10) || (a && parseInt(a.scrollLeft, 10)) || 0;

                return (
                    (null === d.pageX && null !== d.clientX) ?
                            (d.clientX + b - (c.clientLeft || a.clientLeft || 0)) : d.pageX
                );
            },

            /**
             * get mouse Y - position
             *
             * @method pageY
             * @param {Event} b
             */
            pageY: function (b) {
                var a = document.body,
                    c = document.documentElement,
                    d;

                d = b || window.event;

                b = parseInt(c.scrollTop, 10) || (a && parseInt(a.scrollTop, 10)) || 0;

                return (
                    (null === d.pageX && null !== d.clientX) ?
                            (d.clientY + b - (c.clientTop || a.clientTop || 0)) : d.pageY
                );

            }
        },

        /**
         * namespace for work with object positions
         *
         * @namespace Obj
         * @type {{positX: positX, positY: positY}}
         */
        obj = {

            /**
             * get object X - position
             *
             * @method positX
             * @param b
             * @returns {number}
             */
            positX: function (b) {

                var a, c;

                c = b.getBoundingClientRect();
                b = document.body;
                a = document.documentElement;
                a = c.left + (a.scrollLeft || (b && b.scrollLeft) || 0) - (a.clientLeft || b.sclientLeft || 0);

                return Math.round(a);
            },

            /**
             * get object Y - position
             *
             * @method positY
             * @param b
             * @returns {number}
             */
            positY: function (b) {
                var a, c;

                c = b.getBoundingClientRect();
                b = document.body;
                a = document.documentElement;
                a = c.top + (a.scrollTop || (b && b.scrollTop) || 0) - (a.clientTop || b.sclientTop || 0);
                return Math.round(a);
            }
        },

        v,
        s,
        out_color,
        out_colorContainer,
        stringResult,

        rgbToHex = function (r, g, b) {

            function toHex(n) {
                n = parseInt(n, 10);

                if (isNaN(n)) {
                    return "00";
                }
                n = Math.max(0, Math.min(n, 255));

                return "0123456789ABCDEF".charAt((n - n % 16) / 16) + "0123456789ABCDEF".charAt(n % 16);
            }

            return toHex(r) + toHex(g) + toHex(b);
        },

        /**
         * Convert color hsv to rgb
         *
         * @param H
         * @param S
         * @param V
         * @returns {*[]}
         */
        hsv_rgb = function (H, S, V) {
            var f,
                p,
                q,
                t,
                lH,
                r,
                g,
                b;

            S /= 100;
            V /= 100;

            lH = Math.floor(H / 60);

            f = H / 60 - lH;
            p = V * (1 - S);
            q = V * (1 - S * f);
            t = V * (1 - (1 - f) * S);

            switch (lH) {

            case 0:
                r = V;
                g = t;
                b = p;
                break;

            case 1:
                r = q;
                g = V;
                b = p;
                break;

            case 2:
                r = p;
                g = V;
                b = t;
                break;

            case 3:
                r = p;
                g = q;
                b = V;
                break;

            case 4:
                r = t;
                g = p;
                b = V;
                break;

            case 5:
                r = V;
                g = p;
                b = q;
                break;
            }

            return [parseInt(r * 255, 10), parseInt(g * 255, 10), parseInt(b * 255, 10)];
        },

        /**
         * namespace for gradient line
         *
         * @namespace line
         * @type {{Hue: number, init: init, create: create, grd: grd}}
         */
        line = {
            Hue: 0,

            /**
             * gradient line init
             *
             * @method init
             * @param elem
             */
            init: function (elem) {

                var canvasLine,
                    cAr,
                    pst,
                    bk,
                    t = 0,
                    resultArray;

                canvasLine = line.create(elem.h, elem.w, elem.line, "cLine");

                cAr = elem.th;
                bk = elem.bk;

                line.posit = function (e) {
                    var top, rgb;

                    top = mouse.pageY(e) - pst;
                    top = (top < 0) ? 0 : top;
                    top = (top > elem.h) ? elem.h  : top;

                    cAr.style.top = top - 2 + "px";
                    t =  Math.round(top / (elem.h / 360));
                    t = Math.abs(t - 360);
                    t = (t === 360) ? 0 : t;

                    line.Hue = t;

                    resultArray = hsv_rgb(t, 100, 100);

                    bk.style.backgroundColor = '#' + rgbToHex(resultArray[0], resultArray[1], resultArray[2]);

                    out_color.style.backgroundColor = '#' +
                        rgbToHex(resultArray[0], resultArray[1], resultArray[2]);

                    out_colorContainer.style.backgroundColor = '#' +
                        rgbToHex(resultArray[0], resultArray[1], resultArray[2]);

                    stringResult.value = '#' + rgbToHex(resultArray[0], resultArray[1], resultArray[2]);
                };

                cAr.onmousedown = function () {

                    pst = obj.positY(canvasLine);

                    document.onmousemove = function (e) {
                        line.posit(e);
                    };
                };

                cAr.onclick = line.posit;

                canvasLine.onclick = function (e) {
                    line.posit(e);
                };

                canvasLine.onmousedown = function () {

                    pst = obj.positY(canvasLine);

                    document.onmousemove = function (e) {
                        line.posit(e);
                    };
                };

                document.onmouseup = function () {
                    document.onmousemove = null;
                    cAr.onmousemove = null;
                };
            },

            /**
             * create gradient line
             *
             * @method create
             * @param height
             * @param width
             * @param a
             * @param cN
             * @returns {HTMLElement}
             */
            create: function (height, width, a, cN) {
                var canvas = document.createElement("canvas");

                if (!a) {
                    return null;
                }

                canvas.width = width;
                canvas.height = height;

                canvas.className = cN;

                a.appendChild(canvas);

                line.grd(canvas, height, width);

                return canvas;
            },

            /**
             * create grid
             *
             * @method grd
             * @param canvas
             * @param h
             * @param w
             */
            grd: function (canvas, h, w) {
                var gradient,
                    hue,
                    color,
                    ctx,
                    i;

                ctx = canvas.getContext("2d");

                gradient = ctx.createLinearGradient(w / 2, h, w / 2, 0);

                hue = [[255, 0, 0], [255, 255, 0], [0, 255, 0], [0, 255, 255], [0, 0, 255], [255, 0, 255], [255, 0, 0]];

                for (i = 0; i <= 6; i++) {
                    color = 'rgb(' + hue[i][0] + ',' + hue[i][1] + ',' + hue[i][2] + ')';
                    gradient.addColorStop(i / 6, color);
                }

                ctx.fillStyle = gradient;
                ctx.fillRect(0, 0, w, h);
            }

        },

        /**
         * namespace for work with color box
         *
         * @namespace block
         * @type {{init: init}}
         */
        block = {
            /**
             * init color box
             *
             * @method init
             * @param elem
             */
            init: function (elem) {

                var circle,
                    block,
                    bPstX,
                    bPstY,
                    bWi,
                    bHe,
                    cW,
                    cH,
                    pxY,
                    pxX;

                circle = elem.circle;
                block = elem.block;

                cW = circle.offsetWidth;
                cH = circle.offsetHeight;
                bWi = block.offsetWidth - cW;
                bHe = block.offsetHeight - cH;
                pxY = bHe / 100;
                pxX = bWi / 100;

                block.cPos = function (e) {

                    var top,
                        left,
                        resultArray;

                    document.ondragstart = function () { return false; };
                    document.body.onselectstart = function () { return false; };

                    left = mouse.pageX(e) - bPstX - cW / 2;
                    left = (left < 0) ? 0 : left;
                    left = (left > bWi) ? bWi  : left;

                    circle.style.left = left  + "px";

                    s = Math.ceil(left / pxX);

                    top = mouse.pageY(e)  - bPstY - cH / 2;
                    top = (top > bHe) ? bHe : top;

                    top = (top < 0) ? 0 : top;

                    circle.style.top = top   + "px";

                    v = Math.ceil(Math.abs(top / pxY - 100));

                    if (v < 50) {
                        circle.style.borderColor = "#fff";
                    } else {
                        circle.style.borderColor = "#000";
                    }

                    resultArray = hsv_rgb(line.Hue, s, v);

                    out_color.style.backgroundColor = '#' +
                        rgbToHex(resultArray[0], resultArray[1], resultArray[2]);

                    out_colorContainer.style.backgroundColor = '#' +
                        rgbToHex(resultArray[0], resultArray[1], resultArray[2]);

                    stringResult.value = '#' + rgbToHex(resultArray[0], resultArray[1], resultArray[2]);
                };

                block.onclick = function (e) {
                    block.cPos(e);
                };

                block.onmousedown  = function () {
                    document.onmousemove = function (e) {
                        bPstX = obj.positX(block);
                        bPstY = obj.positY(block);
                        block.cPos(e);
                    };
                };

                document.onmouseup = function () {
                    document.onmousemove = null;
                };
            }
        },

        /**
         * create color picker container
         *
         * @method createContainer
         * @param param
         */
        createContainer = function (param) {

            var html = [];

            html.push('<div class="color-picker__wrap">');
            html.push('<div class="color-picker__line">');
            html.push('<div class="color-picker__arrows">');
            html.push('<div class="color-picker__left_arrow"></div>');
            html.push('<div class="color-picker__right_arrow"></div>');
            html.push('</div>');
            html.push('</div>');
            html.push('<div class="color-picker__block-picker">');
            html.push('<img src="/adminsite/components/modules/color-picker/img/bgGradient.png" class="color-picker__bk-img">');
            html.push('<div class="color-picker__circle"></div>');
            html.push('</div>');
            html.push('<div class="color-picker__out-color" style="background-color: ' + param.color + '"></div>');
            html.push('</div>');

            html.push('<div class="popup__controls">');
            html.push('<div tabindex="0" class="button popup__controls_button">ОК</div>');
            html.push('<div tabindex="0" class="button popup__controls_button">Отмена</div>');
            html.push('</div>');

            return html.join('');
        },

        initColorPicker = function (param) {

            if (!param) {
                param = {};
            }

            if (!param.wrap || !param.name) {
                return;
            }

            var wrap = param.wrap,
                id_elements = {
                    primary: wrap.querySelector(".color-picker__wrap"),
                    arrows: wrap.querySelector(".color-picker__arrows"),
                    block: wrap.querySelector(".color-picker__block-picker"),
                    circle: wrap.querySelector(".color-picker__circle"),
                    line: wrap.querySelector(".color-picker__line")
                },
                s = {
                    h: 180,
                    w: 20,
                    th: id_elements.arrows,
                    bk: id_elements.block,
                    line: id_elements.line
                },
                b;

            line.init(s);

            b = {
                block: id_elements.block,
                circle: id_elements.circle
            };

            out_color = param.result;
            out_colorContainer = wrap.querySelector('.color-picker__out-color');
            stringResult = param.input;

            block.init(b);
        },

        handlers = {

            clickByInput: function (event) {
                FRONDEVO_ADMIN.core.stopPropagation(event);
            },

            keyUpInput: function (event) {
                var element = this,
                    value = element.value,
                    background = element.parentNode.querySelector('.color-picker__result');

                if (background) {
                    background.style.backgroundColor = value;
                }
            },

            clickByPicker: function () {

                var wrap = this,
                    popup,
                    colorContainer = wrap.querySelector('.color-picker__result'),
                    colorContainerValue = (colorContainer && colorContainer.style.backgroundColor) || '#fff';

                popup = new FRONDEVO_ADMIN.modules.ExtendPopup({
                    data: '<div></div>',
                    handlers: [
                        {
                            type: 'click',
                            element: '.popup__controls_button',
                            f: function () {
                                popup.hide();
                            }
                        }
                    ],
                    callback: {
                        beforeShow: function () {
                            initColorPicker({
                                wrap: popup.controls.popupContent,
                                name: wrap.getAttribute('data-name'),
                                result: colorContainer,
                                input: wrap.querySelector('.input')
                            });
                        }
                    }
                });

                popup.show(createContainer({color: colorContainerValue}));
            }
        };

    /**
     * init color picker
     *
     * @method initColorPicker
     */

    function add(param) {

        if (!window.addEventListener) {
            return;
        }

        var input = document.createElement('input'),
            wrap = param.wrap;

        wrap.removeAttribute('data-module');
        input.type = 'text';
        input.className = 'input';
        input.name = wrap.getAttribute('data-name');
        input.value = wrap.getAttribute('data-value') || '#000';

        wrap.result = param.result;
        wrap.appendChild(input);
        controls.wrap = wrap;

        $(wrap).on('click', handlers.clickByPicker);
        $(wrap).on('click', '.input', handlers.clickByInput);
        $(wrap).on('keyup', '.input', handlers.keyUpInput);
    }

    return {
        add: add
    };
}());

FRONDEVO_ADMIN.config.color_picker_init = function (object) {

    var modules = FRONDEVO_ADMIN.modules,
        i,
        count,
        initColorPicker = function (cp_object) {

            modules.colorPicker.add({
                wrap: cp_object,
                result: cp_object.querySelector('.color-picker__result')
            });
        };

    if (object === undefined) {
        object = document.querySelectorAll('[data-module="color_picker"]');
    }

    if (object instanceof Array || object instanceof NodeList) {
        count = object.length;

        for (i = 0; i < count; i++) {
            initColorPicker(object[i]);
        }

    } else {
        initColorPicker(object);
    }

};