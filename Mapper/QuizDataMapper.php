<?php

namespace Silentpost\ProductQuiz\Mapper;

use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Silentpost\ProductQuiz\Api\Data\QuizInterface;
use Silentpost\ProductQuiz\Api\Data\QuizInterfaceFactory;
use Silentpost\ProductQuiz\Model\QuizModel;

/**
 * Converts a collection of Quiz entities to an array of data transfer objects.
 */
class QuizDataMapper
{
    /**
     * @var QuizInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param QuizInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        QuizInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|QuizInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var QuizModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var QuizInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
