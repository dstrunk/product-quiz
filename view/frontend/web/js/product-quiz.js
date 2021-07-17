define([
    'ko',
    'uiComponent',
    'productQuizQuestion',
], function (ko, Component, QuizQuestion) {
    'use strict';

    const data = {
        title: 'A Quiz!',
        description: 'Click below to get started.',
        questions: [
            {
                id: 0,
                title: 'Question 1',
                answers: [
                    {
                        id: 0,
                        title: 'Answer 1',
                        selected: false,
                    },
                    {
                        id: 1,
                        title: 'Answer 2',
                        selected: false,
                    },
                    {
                        id: 2,
                        title: 'Answer 3',
                        selected: false,
                    },
                ],
            },
            {
                id: 1,
                title: 'Question 2',
                answers: [
                    {
                        id: 0,
                        title: 'Answer 1',
                        selected: false,
                    },
                    {
                        id: 1,
                        title: 'Answer 2',
                        selected: false,
                    },
                    {
                        id: 2,
                        title: 'Answer 3',
                        selected: false,
                    },
                ],
            },
            {
                id: 2,
                title: 'Question 3',
                answers: [
                    {
                        id: 0,
                        title: 'Answer 1',
                        selected: false,
                    },
                    {
                        id: 1,
                        title: 'Answer 2',
                        selected: false,
                    },
                    {
                        id: 2,
                        title: 'Answer 3',
                        selected: false,
                    },
                ],
            },
        ],
    };

    let self;
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
            self = this;
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
