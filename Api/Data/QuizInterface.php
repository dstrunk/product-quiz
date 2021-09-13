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
    const BUTTON_TEXT = "button_text";
    const NUMBER_OF_PRODUCTS = "number_of_products";
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
     * Getter for Button Text.
     *
     * @return string|null
     */
    public function getButtonText(): ?string;

    /**
     * Setter for Button Text.
     *
     * @param string|null $buttonText
     *
     * @return void
     */
    public function setButtonText(?string $buttonText): void;

    /**
     * Getter for Number of Products.
     *
     * @return string|null
     */
    public function getNumberOfProducts(): ?string;

    /**
     * Setter for Number of Products.
     *
     * @param string|null $numberOfProducts
     *
     * @return void
     */
    public function setNumberOfProducts(?string $numberOfProducts): void;

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
