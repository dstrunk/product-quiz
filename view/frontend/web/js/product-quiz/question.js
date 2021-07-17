define([
    'ko',
    'uiComponent',
    'productQuizAnswer',
], function (ko, Component, QuizAnswer) {
    'use strict';

    let self;
    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz/stage/quiz/question',
        },

        initialize: function () {
            self = this;
            this._super();
        },
    });
});
