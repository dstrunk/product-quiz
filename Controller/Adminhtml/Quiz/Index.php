<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Quiz;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Quiz backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::quiz_management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Silentpost_ProductQuiz::management');
        $resultPage->addBreadcrumb(__('Quiz'), __('Quiz'));
        $resultPage->addBreadcrumb(__('Manage Quizs'), __('Manage Quizs'));
        $resultPage->getConfig()->getTitle()->prepend(__('Quiz List'));

        return $resultPage;
    }
}
