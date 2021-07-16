define([
    'ko',
    'uiComponent',
], function (ko, Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz/stage/quiz/answer',
        },

        initialize: function () {
            this._super();
        },
    });
});
