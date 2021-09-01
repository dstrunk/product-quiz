<?php

namespace Silentpost\ProductQuiz\Model\Data;

use Magento\Framework\DataObject;
use Silentpost\ProductQuiz\Api\Data\AnswerInterface;

class AnswerData extends DataObject implements AnswerInterface
{
    /**
     * @inheritDoc
     */
    public function getAnswerId(): ?int
    {
        return $this->getData(self::ANSWER_ID) === null ? null
            : (int)$this->getData(self::ANSWER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAnswerId(?int $answerId): void
    {
        $this->setData(self::ANSWER_ID, $answerId);
    }

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
    public function getImage(): ?string
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage(?string $image): void
    {
        $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getConditionsSerialized(): ?string
    {
        return $this->getData(self::CONDITIONS_SERIALIZED);
    }

    /**
     * @inheritDoc
     */
    public function setConditionsSerialized(?string $conditionsSerialized): void
    {
        $this->setData(self::CONDITIONS_SERIALIZED, $conditionsSerialized);
    }

    /**
     * @inheritDoc
     */
    public function getIsEnabled(): ?int
    {
        return $this->getData(self::IS_ENABLED) === null ? null
            : (int)$this->getData(self::IS_ENABLED);
    }

    /**
     * @inheritDoc
     */
    public function setIsEnabled(?int $isEnabled): void
    {
        $this->setData(self::IS_ENABLED, $isEnabled);
    }
}
