<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
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

    /** @var CollectionFactory */
    private $productCollectionFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        QuestionCollectionFactory $questionCollectionFactory,
        CollectionFactory $productCollectionFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
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
            ->addFieldToSelect('*')
            ->addFieldToFilter('quiz_ids', ['in' => $this->getId()]);
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection|AbstractDb
     */
    public function getProducts()
    {
        return $this
            ->productCollectionFactory
            ->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('product_id', ['in' => $this->getProductIds()]);
    }

    /**
     * @return false|string[]
     */
    private function getProductIds()
    {
        return explode(',', $this->getProducts());
    }
}
