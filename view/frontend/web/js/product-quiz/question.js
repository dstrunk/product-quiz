define([
    'ko',
    'uiComponent',
    'productQuizAnswer',
], function (ko, Component, QuizAnswer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz/stage/quiz/question',
        },

        initialize: function () {
            this._super();
        },
    });
});
