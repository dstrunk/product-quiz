<?php

namespace Silentpost\ProductQuiz\Mapper;

use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Silentpost\ProductQuiz\Api\Data\AnswerInterface;
use Silentpost\ProductQuiz\Api\Data\AnswerInterfaceFactory;
use Silentpost\ProductQuiz\Model\AnswerModel;

/**
 * Converts a collection of Answer entities to an array of data transfer objects.
 */
class AnswerDataMapper
{
    /**
     * @var AnswerInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param AnswerInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        AnswerInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|AnswerInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var AnswerModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var AnswerInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
