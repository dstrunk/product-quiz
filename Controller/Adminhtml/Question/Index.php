<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Question backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::question_management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Silentpost_ProductQuiz::question_management');
        $resultPage->addBreadcrumb(__('Question'), __('Question'));
        $resultPage->addBreadcrumb(__('Manage Questions'), __('Manage Questions'));
        $resultPage->getConfig()->getTitle()->prepend(__('Question List'));

        return $resultPage;
    }
}
