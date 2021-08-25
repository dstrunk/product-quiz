<?php

namespace Silentpost\ProductQuiz\Api\Data;

interface QuizInterface
{
    /**
     * String constants for property names
     */
    const QUIZ_ID = "quiz_id";
    const TITLE = "title";
    const DESCRIPTION = "description";
    const IS_ENABLED = "is_enabled";
    const PRODUCTS = "products";

    /**
     * Getter for QuizId.
     *
     * @return int|null
     */
    public function getQuizId(): ?int;

    /**
     * Setter for QuizId.
     *
     * @param int|null $quizId
     *
     * @return void
     */
    public function setQuizId(?int $quizId): void;

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

    /**
     * Getter for Products
     *
     * @return string|null
     */
    public function getProducts(): ?string;

    /**
     * Setter for Products
     *
     * @param string|null $products
     *
     * @return void
     */
    public function setProducts(?string $products): void;
}
