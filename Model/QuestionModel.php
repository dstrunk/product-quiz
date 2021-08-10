<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Framework\Model\AbstractModel;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionResource;

class QuestionModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_questions_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuestionResource::class);
    }
}
