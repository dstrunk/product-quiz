define([
    'ko',
    'uiComponent',
], function (ko, Component) {
    'use strict';

    let self;
    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz/stage/quiz/answer',
        },

        initialize: function () {
            self = this;
            this._super();
        },
    });
});
