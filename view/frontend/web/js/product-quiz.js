define([
    'ko',
    'uiComponent',
    'productQuizQuestion',
], function (ko, Component, QuizQuestion) {
    'use strict';

    const data = {
        questions: [
            {
                id: 0,
                title: 'Question 1',
                answers: [
                    {
                        id: 0,
                        title: 'Q1: Answer 1',
                        selected: false,
                    },
                    {
                        id: 1,
                        title: 'Q1: Answer 2',
                        selected: false,
                    },
                    {
                        id: 2,
                        title: 'Q1: Answer 3',
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
                        title: 'Q2: Answer 1',
                        selected: false,
                    },
                    {
                        id: 4,
                        title: 'Q2: Answer 2',
                        selected: false,
                    },
                    {
                        id: 5,
                        title: 'Q2: Answer 3',
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

        initialize: function (config) {
            self = this
            self._super()

            self.questions = []

            self.fetchQuiz(config)
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

        canProceedToNextStep: function () {
            return self.quizIndex < self.questions.length - 1 &&
                self.currentQuestion().answers.find(function (answer) {
                    return answer.selected === true
                })
        },

        canViewResults: function () {
            return self.quizIndex === self.questions.length - 1 &&
                self.questions.every(function (question) {
                    return question.answers.find(function (answer) {
                        return answer.selected === true;
                    })
                })
        },

        fetchQuiz: function (config) {
            // @TODO: Request quiz information and questions from controller.
            // @TODO: Push questions into KO observable array.
            self.quizTitle = config.data.title
            self.quizDescription = config.data.description
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
            let values = []

            self.questions.forEach(question => {
                let answer = {}
                let object = question.answers.find(answer => answer.selected === true)
                answer.question_id = question.id
                answer.answer_id = object.id
                values.push(answer)
            })

            // @TODO: Submit results to controller.
        },

        restartQuiz: function () {
            self.quizIndex = 0
            self.resetQuizData()
            self.introStage = true
            self.quizStage = false
        },

        resetQuizData: function () {
            self.questions.forEach(question => question.answers.forEach(answer => answer.selected = false))
        },
    });
});
