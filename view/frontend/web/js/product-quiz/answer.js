define([
    'uiComponent',
], function (Component) {
    'use strict';

    let self;
    return Component.extend({
        defaults: {
            tracks: {
                id: true,
                title: true,
                selected: true,
            },
        },

        initialize: function (answer) {
            self = this
            self._super()

            self.id = answer.id
            self.title = answer.title
            self.selected = answer.selected
        },
    })
})
