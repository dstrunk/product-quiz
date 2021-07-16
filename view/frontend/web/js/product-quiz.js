define([
    'ko',
    'uiComponent',
    'productQuizQuestion',
], function (ko, Component, QuizQuestion) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz',
        },

        isVisible: ko.observable(false),
        errorStage: ko.observable(true),
        introStage: ko.observable(true),
        quizStage: ko.observable(true),
        resultsStage: ko.observable(true),
        quizTitle: ko.observable(''),
        quizDescription: ko.observable(''),
        questions: ko.observableArray([]),

        initialize: function () {
            this._super();
        },

        openQuiz: function () {
            return this.isVisible(true);
        },

        closeQuiz: function () {
            return this.isVisible(false);
        },

        previous: function () {
            return false;
        },

        next: function () {
            return false;
        },

        fetchQuiz: function () {
            // @TODO: Request quiz information and questions from controller.
            // @TODO: Push questions into KO observable array.
        },

        submit: function () {
            // @TODO: Submit results to controller.
        },

        restartQuiz: function () {
            return false;
        },
    });
});
