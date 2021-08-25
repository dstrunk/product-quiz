<?php

namespace Silentpost\ProductQuiz\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class QuizResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'silentpost_productquiz_quizzes_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('silentpost_productquiz_quizzes', 'quiz_id');
        $this->_useIsObjectNew = true;
    }
}
