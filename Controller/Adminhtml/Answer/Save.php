<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Answer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Silentpost\ProductQuiz\Api\Data\AnswerInterface;
use Silentpost\ProductQuiz\Api\Data\AnswerInterfaceFactory;
use Silentpost\ProductQuiz\Command\Answer\SaveCommand;

/**
 * Save Answer controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::answer_management';
    const REQUIRED_FIELDS = [
        'title',
        'question_id',
    ];

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var AnswerInterfaceFactory
     */
    private $entityDataFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param AnswerInterfaceFactory $entityDataFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveCommand $saveCommand,
        AnswerInterfaceFactory $entityDataFactory
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save Answer Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var AnswerInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The Answer data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                'answer_id' => $this->getRequest()->getParam('answer_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
