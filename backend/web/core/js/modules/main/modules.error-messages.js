/**
 * Created by Valera Siestov on 20.12.13.
 */

/*global FRONDEVO_ADMIN, document */

FRONDEVO_ADMIN.core.namespace('modules.ErrorMessages');

/**
 * Config file for error messages
 *
 */
FRONDEVO_ADMIN.modules.ErrorMessages = (function (app, lang) {
    "use strict";

    return {
        checkbox: {
            active: 'Отключить страницу',
            notActive: 'Включить страницу'
        },

        input: {
            number: (function () {

                var result;

                switch (lang) {

                case 'ru':
                    result = 'Некорректное число';
                    break;

                case 'en':
                    result = 'Invalid number';
                    break;

                default:
                    result = 'Некорректное число';
                    break;

                }

                return result;
            }()),

            currency: (function () {

                var result;

                switch (lang) {

                case 'ru':
                    result = 'Некорректная сумма';
                    break;

                case 'en':
                    result = 'Invalid currency';
                    break;

                default:
                    result = 'Некорректная сумма';
                    break;

                }

                return result;
            }()),

            minCount: (function () {
                var result;

                switch (lang) {

                case 'ru':
                    result = 'Введено недостаточное количество символов';
                    break;

                case 'en':
                    result = 'insufficient quantity';
                    break;

                default:
                    result = 'Введено недостаточное количество символов';
                    break;
                }

                return result;
            }()),

            maxCount: (function () {
                var result;

                switch (lang) {

                case 'ru':
                    result = 'Введено предельно допустимое количество символов';
                    break;

                case 'en':
                    result = 'maximum number of characters allowed';
                    break;

                default:
                    result = 'Введено предельно допустимое количество символов';
                    break;
                }

                return result;
            }()),

            email: (function () {
                var result;

                switch (lang) {
                case 'ru':
                    result = 'Некорректный E-Mail';
                    break;

                case 'en':
                    result = 'E-Mail is not valid';
                    break;

                default:
                    result = 'Некорректный E-Mail';
                    break;
                }

                return result;
            }()),

            defaultMessage: (function () {
                var result;

                switch (lang) {
                case 'ru':
                    result = 'Поле обязательное для заполнения';
                    break;

                case 'en':
                    result = 'Required field';
                    break;

                default:
                    result = 'Поле обязательное для заполнения';
                    break;
                }

                return result;
            }())
        },

        textArea: {
            minCount: (function () {
                var result;

                switch (lang) {

                case 'ru':
                    result = 'Введено недостаточное количество символов';
                    break;

                case 'en':
                    result = 'insufficient quantity';
                    break;

                default:
                    result = 'Введено недостаточное количество символов';
                    break;
                }

                return result;
            }()),

            maxCount: (function () {
                var result;

                switch (lang) {

                case 'ru':
                    result = 'Введено предельно допустимое количество символов';
                    break;

                case 'en':
                    result = 'maximum number of characters allowed';
                    break;

                default:
                    result = 'Введено предельно допустимое количество символов';
                    break;
                }

                return result;
            }()),

            defaultMessage: (function () {
                var result;

                switch (lang) {
                case 'ru':
                    result = 'Поле обязательное для заполнения';
                    break;

                case 'en':
                    result = 'Required field';
                    break;

                default:
                    result = 'Поле обязательное для заполнения';
                    break;
                }

                return result;
            }())
        },

        select: {
            defaultMessage: (function () {
                var result;

                switch (lang) {

                case 'ru':
                    result = 'Поле обязательное для заполнения';
                    break;

                case 'en':
                    result = 'Required field';
                    break;

                default:
                    result = 'Поле обязательное для заполнения';
                    break;

                }

                return result;
            }())
        }
    };

}(FRONDEVO_ADMIN, document.querySelector('html').getAttribute('lang')));
