<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Framework\Model\AbstractModel;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerResource;

class AnswerModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_answers_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(AnswerResource::class);
    }
}
