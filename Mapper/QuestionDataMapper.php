<?php

namespace Silentpost\ProductQuiz\Mapper;

use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Silentpost\ProductQuiz\Api\Data\QuestionInterface;
use Silentpost\ProductQuiz\Api\Data\QuestionInterfaceFactory;
use Silentpost\ProductQuiz\Model\QuestionModel;

/**
 * Converts a collection of Question entities to an array of data transfer objects.
 */
class QuestionDataMapper
{
    /**
     * @var QuestionInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param QuestionInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        QuestionInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|QuestionInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var QuestionModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var QuestionInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
