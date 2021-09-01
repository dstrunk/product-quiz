<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\Question;

use Magento\Framework\Data\OptionSourceInterface;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizModel\QuizCollectionFactory;

class Select implements OptionSourceInterface
{

    /** @var QuizCollectionFactory */
    private $quizCollectionFactory;

    public function __construct(QuizCollectionFactory $quizCollectionFactory)
    {
        $this->quizCollectionFactory = $quizCollectionFactory;
    }

    public function toOptionArray(): array
    {
        $quizzes = $this->quizCollectionFactory->create();

        $options = [];
        foreach ($quizzes as $quiz) {
            $options[] = [
                'value' => $quiz->getId(),
                'label' => $quiz->getTitle()
            ];
        }

        return $options;
    }
}
