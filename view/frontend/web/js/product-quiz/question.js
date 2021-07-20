define([
    'uiComponent',
    'productQuizAnswer',
], function (Component, QuizAnswer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Silentpost_ProductQuiz/product-quiz/stage/quiz/question',
            tracks: {
                id: true,
                title: true,
                answers: true,
            },
        },

        initialize: function (question) {
            this._super()

            this.id = question.id
            this.title = question.title
            this.answers = []

            question.answers.forEach(answer => this.answers.push(new QuizAnswer(answer)))

            return this
        },

        selectAnswer: function (answer) {
            this.answers.forEach(function (a) {
                a.selected = false
            })

            answer.selected = true
        },
    })
})
