<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Answer;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Answer backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::answer_management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Silentpost_ProductQuiz::quiz_management');
        $resultPage->addBreadcrumb(__('Answer'), __('Answer'));
        $resultPage->addBreadcrumb(__('Manage Answers'), __('Manage Answers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Answer List'));

        return $resultPage;
    }
}
