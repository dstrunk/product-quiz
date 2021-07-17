define([
    'uiComponent',
    'productQuizAnswer',
], function (Component, QuizAnswer) {
    'use strict';

    let self;
    return Component.extend({
        defaults: {
            tracks: {
                id: true,
                title: true,
                answers: true,
            },
        },

        initialize: function (question) {
            self = this;
            self._super();

            self.id = question.id
            self.title = question.title
            self.answers = []

            question.answers.forEach(function (answer) {
                self.answers.push(new QuizAnswer(answer))
            })
        },

        selectAnswer: function (answer) {
            self.answers.forEach(function (a) {
                a.selected = false
            })

            answer.selected = true
        },
    })
})
