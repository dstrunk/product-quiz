<?php

namespace Silentpost\ProductQuiz\Model\ResourceModel\QuizModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Silentpost\ProductQuiz\Model\QuizModel;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizResource;

class QuizCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_quizzes_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuizModel::class, QuizResource::class);
    }
}
