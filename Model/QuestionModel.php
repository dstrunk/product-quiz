<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerModel\AnswerCollection;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerModel\AnswerCollectionFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionResource;

class QuestionModel extends AbstractModel
{
    /** @var AnswerCollectionFactory */
    private $answerCollectionFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        AnswerCollectionFactory $answerCollectionFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->answerCollectionFactory = $answerCollectionFactory;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

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

    /**
     * @return AnswerCollection
     */
    public function getAnswers(): AnswerCollection
    {
        return $this
            ->answerCollectionFactory
            ->create()
            ->addFieldToSelect('*')
            ->addFIeldToFilter('question_id', ['eq' => $this->getId()]);
    }
}
