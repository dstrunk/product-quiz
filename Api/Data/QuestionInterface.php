<?php

namespace Silentpost\ProductQuiz\Api\Data;

interface QuestionInterface
{
    /**
     * String constants for property names
     */
    const QUESTION_ID = "question_id";
    const TITLE = "title";
    const DESCRIPTION = "description";
    const IS_ENABLED = "is_enabled";

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
     * Getter for IsEnabled.
     *
     * @return bool|null
     */
    public function getIsEnabled(): ?bool;

    /**
     * Setter for IsEnabled.
     *
     * @param bool|null $isEnabled
     *
     * @return void
     */
    public function setIsEnabled(?bool $isEnabled): void;
}
