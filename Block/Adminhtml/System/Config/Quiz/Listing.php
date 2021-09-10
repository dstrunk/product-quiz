<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\System\Config\Quiz;

use Magento\Framework\Data\OptionSourceInterface;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizModel\QuizCollectionFactory;

class Listing implements OptionSourceInterface
{
    /** @var QuizCollectionFactory */
    private $quizCollectionFactory;

    public function __construct(QuizCollectionFactory $quizCollectionFactory)
    {
        $this->quizCollectionFactory = $quizCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        $quizCollection = $this->quizCollectionFactory
            ->create()
            ->addFieldToSelect('title')
            ->addFieldToSelect('is_enabled')
            ->addFieldToSelect('quiz_id')
            ->addFieldToFilter('is_enabled', ['eq' => 1])
            ->getItems();

        $results = [];
        $results[] = ['value' => '', 'label' => __('-- Select a Quiz below --')];

        foreach ($quizCollection as $quiz) {
            $results[] = ['value' => $quiz->getQuizId(), 'label' => $quiz->getTitle()];
        }

        return $results;
    }
}
