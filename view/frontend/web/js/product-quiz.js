define([
    'ko',
    'uiComponent',
    'productQuizQuestion',
], function (ko, Component, QuizQuestion) {
    'use strict';

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
            self.quizTitle = config.data.title
            self.quizDescription = config.data.description
            config.data?.questions?.forEach(function (question) {
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
