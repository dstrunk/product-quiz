<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionModel\QuestionCollection;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionModel\QuestionCollectionFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizResource;

class QuizModel extends AbstractModel
{
    /** @var QuestionCollectionFactory */
    private $questionCollectionFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        QuestionCollectionFactory $questionCollectionFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->questionCollectionFactory = $questionCollectionFactory;
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
    protected $_eventPrefix = 'silentpost_productquiz_quizzes_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuizResource::class);
    }

    /**
     * @return QuestionCollection
     */
    public function getQuestions(): QuestionCollection
    {
        return $this
            ->questionCollectionFactory
            ->create()
            ->addFieldToSelect('*');
    }
}
