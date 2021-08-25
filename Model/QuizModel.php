<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Framework\Model\AbstractModel;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizResource;

class QuizModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_quizzes_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuizResource::class);
    }
}
