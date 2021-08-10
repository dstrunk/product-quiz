<?php

namespace Silentpost\ProductQuiz\Model\ResourceModel\QuestionModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Silentpost\ProductQuiz\Model\QuestionModel;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionResource;

class QuestionCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_questions_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuestionModel::class, QuestionResource::class);
    }
}
