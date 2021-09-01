<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\Answer\Edit\Question;

use Magento\Framework\Data\OptionSourceInterface;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionModel\QuestionCollectionFactory;

class Select implements OptionSourceInterface
{

    /** @var QuestionCollectionFactory */
    private $questionCollectionFactory;

    public function __construct(QuestionCollectionFactory $questionCollectionFactory)
    {
        $this->questionCollectionFactory = $questionCollectionFactory;
    }

    public function toOptionArray(): array
    {
        $questions = $this->questionCollectionFactory->create();

        $options = [];
        foreach ($questions as $question) {
            $options[] = [
                'value' => $question->getId(),
                'label' => $question->getTitle()
            ];
        }

        return $options;
    }
}
