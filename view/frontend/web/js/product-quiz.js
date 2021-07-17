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
                        id: 3,
                        title: 'Answer 1',
                        selected: false,
                    },
                    {
                        id: 4,
                        title: 'Answer 2',
                        selected: false,
                    },
                    {
                        id: 5,
                        title: 'Answer 3',
                        selected: false,
                    },
                ],
            }
        ],
    };

    let self;
    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz',
            tracks: {
                isVisible: true,
                errorStage: true,
                introStage: true,
                quizStage: true,
                quizDescription: true,
                questions: true,
                quizIndex: true,
            },
        },

        initialize: function () {
            self = this
            self._super()

            self.questions = []

            self.fetchQuiz()
        },

        openQuiz: function () {
            self.isVisible = true
        },

        closeQuiz: function () {
            self.isVisible = false
        },

        startQuiz: function () {
            self.introStage = false
            self.quizStage = true
        },

        previous: function () {
            self.quizIndex = self.quizIndex - 1
        },

        next: function () {
            self.quizIndex = self.quizIndex + 1
        },

        fetchQuiz: function () {
            // @TODO: Request quiz information and questions from controller.
            // @TODO: Push questions into KO observable array.
            self.quizTitle = data.title
            self.quizDescription = data.description
            data.questions.forEach(function (question) {
                self.questions.push(new QuizQuestion(question))
            })

            self.quizIndex = 0

            self.currentQuestion = ko.pureComputed(function () {
                return self.questions[self.quizIndex]
            }, self)

            self.introStage = true
        },

        submit: function () {
            // @TODO: Submit results to controller.
        },

        restartQuiz: function () {
            return false;
        },
    });
});
