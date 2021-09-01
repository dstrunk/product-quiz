<?php

namespace Silentpost\ProductQuiz\Model\ResourceModel\AnswerModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Silentpost\ProductQuiz\Model\AnswerModel;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerResource;

class AnswerCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_answers_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(AnswerModel::class, AnswerResource::class);
    }
}
