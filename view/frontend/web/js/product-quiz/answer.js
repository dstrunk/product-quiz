define([
    'uiComponent',
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz/stage/quiz/answer',
            tracks: {
                id: true,
                title: true,
                selected: true,
            },
        },

        initialize: function (answer) {
            this._super()

            this.id = answer.id
            this.title = answer.title
            this.selected = answer.selected
        },
    })
})
