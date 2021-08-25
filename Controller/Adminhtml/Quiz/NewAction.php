<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Quiz;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * New action Quiz controller.
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::quiz_management';

    /**
     * Create new Quiz action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Silentpost_ProductQuiz::management');
        $resultPage->getConfig()->getTitle()->prepend(__('New Quiz'));

        return $resultPage;
    }
}
