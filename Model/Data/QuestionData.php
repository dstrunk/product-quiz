<?php

namespace Silentpost\ProductQuiz\Model\Data;

use Magento\Framework\DataObject;
use Silentpost\ProductQuiz\Api\Data\QuestionInterface;

class QuestionData extends DataObject implements QuestionInterface
{
    /**
     * @inheritDoc
     */
    public function getQuestionId(): ?int
    {
        return $this->getData(self::QUESTION_ID) === null ? null
            : (int)$this->getData(self::QUESTION_ID);
    }

    /**
     * @inheritDoc
     */
    public function setQuestionId(?int $questionId): void
    {
        $this->setData(self::QUESTION_ID, $questionId);
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
    public function getQuizIds(): ?string
    {
        return $this->getData(self::QUIZ_IDS);
    }

    /**
     * @inheritDoc
     */
    public function setQuizIds(?string $quizIds): void
    {
        $this->setData(self::QUIZ_IDS, $quizIds);
    }
}
