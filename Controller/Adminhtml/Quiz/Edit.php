<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Quiz;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizModel\QuizCollectionFactory;

/**
 * Edit Quiz entity backend controller.
 */
class Edit extends Action implements HttpGetActionInterface
{
    /** @var QuizCollectionFactory */
    private $quizCollectionFactory;

    public function __construct(
        Context $context,
        QuizCollectionFactory $quizCollectionFactory
    )
    {
        parent::__construct($context);
        $this->quizCollectionFactory = $quizCollectionFactory;
    }

    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::quiz_management';

    /**
     * Edit Quiz action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Silentpost_ProductQuiz::management');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Quiz'));

        return $resultPage;
    }
}
