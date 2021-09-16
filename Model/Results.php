<?php

namespace Silentpost\ProductQuiz\Model;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerModel\AnswerCollectionFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionModel\QuestionCollectionFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizModel\QuizCollectionFactory;

class Results
{
    /** @var QuizCollectionFactory */
    private $quizCollectionFactory;

    /** @var QuestionCollectionFactory */
    private $questionCollectionFactory;

    /** @var AnswerCollectionFactory */
    private $answerCollectionFactory;

    /** @var CollectionFactory */
    private $productCollectionFactory;

    public function __construct(
        QuizCollectionFactory $quizCollectionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        AnswerCollectionFactory $answerCollectionFactory,
        CollectionFactory $productCollectionFactory
    ) {
        $this->quizCollectionFactory = $quizCollectionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->answerCollectionFactory = $answerCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function getRecommendedProduct()
    {
        return $this->productCollectionFactory
            ->create()
            ->addAttributeToSelect('*')
            ->getFirstItem();
    }

    public function getTopProducts()
    {
        return $this->productCollectionFactory
            ->create()
            ->addAttributeToSelect('*')
            ->setPageSize(3)
            ->setCurPage(1);
    }

    public function getQuiz()
    {
        $this->quizCollectionFactory->create();
    }

    public function getQuestions()
    {
        $this->questionCollectionFactory->create();
    }

    public function getUserProvidedAnswers()
    {
        $this->answerCollectionFactory->create();
    }
}
