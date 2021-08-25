<?php

namespace Silentpost\ProductQuiz\Model\Data;

use Magento\Framework\DataObject;
use Silentpost\ProductQuiz\Api\Data\QuizInterface;

class QuizData extends DataObject implements QuizInterface
{
    /**
     * @inheritDoc
     */
    public function getQuizId(): ?int
    {
        return $this->getData(self::QUIZ_ID) === null ? null
            : (int)$this->getData(self::QUIZ_ID);
    }

    /**
     * @inheritDoc
     */
    public function setQuizId(?int $quizId): void
    {
        $this->setData(self::QUIZ_ID, $quizId);
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(?string $title): void
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getIsEnabled(): ?bool
    {
        return $this->getData(self::IS_ENABLED) === null ? null
            : (bool)$this->getData(self::IS_ENABLED);
    }

    /**
     * @inheritDoc
     */
    public function setIsEnabled(?bool $isEnabled): void
    {
        $this->setData(self::IS_ENABLED, $isEnabled);
    }

    /**
     * @inheritDoc
     */
    public function getProducts(): ?string
    {
        return $this->getData(self::PRODUCTS);
    }

    /**
     * @inheritDoc
     */
    public function setProducts(?string $products): void
    {
        $this->setData(self::PRODUCTS, $products);
    }
}
