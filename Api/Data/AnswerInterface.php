<?php

namespace Silentpost\ProductQuiz\Api\Data;

interface AnswerInterface
{
    /**
     * String constants for property names
     */
    const ANSWER_ID = "answer_id";
    const TITLE = "title";
    const DESCRIPTION = "description";
    const IS_ENABLED = "is_enabled";
    const QUESTION_ID = "question_id";
    const IMAGE = "image";
    const CONDITIONS_SERIALIZED = "conditions_serialized";

    /**
     * Getter for AnswerId.
     *
     * @return int|null
     */
    public function getAnswerId(): ?int;

    /**
     * Setter for AnswerId.
     *
     * @param int|null $answerId
     *
     * @return void
     */
    public function setAnswerId(?int $answerId): void;

    /**
     * Getter for QuestionId.
     *
     * @return int|null
     */
    public function getQuestionId(): ?int;

    /**
     * Setter for QuestionId.
     *
     * @param int|null $questionId
     *
     * @return void
     */
    public function setQuestionId(?int $questionId): void;

    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Setter for Title.
     *
     * @param string|null $title
     *
     * @return void
     */
    public function setTitle(?string $title): void;

    /**
     * Getter for Description.
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Setter for Description.
     *
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void;

    /**
     * Getter for Image.
     *
     * @return string|null
     */
    public function getImage(): ?string;

    /**
     * Setter for Image.
     *
     * @param string|null $image
     *
     * @return void
     */
    public function setImage(?string $image): void;

    /**
     * Getter for ConditionsSerialized.
     *
     * @return string|null
     */
    public function getConditionsSerialized(): ?string;

    /**
     * Setter for ConditionsSerialized.
     *
     * @param string|null $conditionsSerialized
     *
     * @return void
     */
    public function setConditionsSerialized(?string $conditionsSerialized): void;

    /**
     * Getter for IsEnabled.
     *
     * @return int|null
     */
    public function getIsEnabled(): ?int;

    /**
     * Setter for IsEnabled.
     *
     * @param int|null $isEnabled
     *
     * @return void
     */
    public function setIsEnabled(?int $isEnabled): void;
}
