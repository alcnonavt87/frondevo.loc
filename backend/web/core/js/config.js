
/**
 * Description:
 * Author Valera Siestov
 * Date: 08.05.2014
 * Time: 15:33
 */

/**
 * @namespace config
 *
 */
FRONDEVO_ADMIN.config = {
    modules: {
        adminPanelUri: 'adminfrondevo_',

        select: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/select/modules.select.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/select/select.css'
            },
            {
                type: 'js',
                path: '/adminfrondevo_/core/js/iscroll.js'
            }
        ],

        calendar: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/calendar/modules.calendar.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/calendar/calendar.css'
            }
        ],

        color_picker: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/color-picker/modules.color-picker.js'
            },
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/extend-popup/modules.extend-popup.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/color-picker/color-picker.css'
            }
        ],

        drag_sort: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/drag-sort/modules.drag-sort.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/drag-sort/drag-sort.css'
            }
        ],

        scroll_container: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/scroll-container/modules.scroll-container.js'
            },
            {
                type: 'js',
                path: '/adminfrondevo_/core/js/iscroll.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/scroll-container/scroll-container.css'
            }
        ],

        tinymce: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/tinymce/tinymce.min.js'
            }
        ],

        extendPopup: [
            {
                type: 'extendPopup',
                path: '/adminfrondevo_/components/modules/extend-popup/modules.extend-popup.js'
            }
        ],

        table: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/table/modules.table.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/table/table.css'
            }
        ],

        FAUploader: [
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/uploader/js/plugin.all.js'
            },
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/uploader/js/jquery.fauploader.class.js'
            },
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/uploader/js/jquery.colorbox-min.js'
            },
            {
                type: 'js',
                path: '/adminfrondevo_/components/modules/extend-popup/modules.extend-popup.js'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/uploader/css/colorbox.css'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/uploader/css/jquery.fileupload.css'
            },
            {
                type: 'css',
                path: '/adminfrondevo_/components/modules/uploader/css/main.css'
            }
        ]
    }
};