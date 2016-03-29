/*
    DeafaultClass Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function DeafaultClass(params) {
    'use strict';
    var self = this;

    self.elems = {
    };
    self.settings = {
    };
    $.extend(self.settings, params);

    self.init(params);

    return this;
}



DeafaultClass.prototype = {
    init: function () {
        'use strict';
        var self = this;

        self.controls();

        return this;
    },
    controls: function () {
        'use strict';
        var self = this;

        return this;
    }
};