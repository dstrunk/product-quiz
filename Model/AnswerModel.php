<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\CatalogRule\Model\Rule;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerResource;

class AnswerModel extends Rule
{
    const FORM_NAME = 'silentpost_answer_form';
    const FIELDSET_ID = 'assigned_conditions';

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
