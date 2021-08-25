<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Quiz;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Serialize\Serializer\Json;
use Silentpost\ProductQuiz\Api\Data\QuizInterface;
use Silentpost\ProductQuiz\Api\Data\QuizInterfaceFactory;
use Silentpost\ProductQuiz\Command\Quiz\SaveCommand;

/**
 * Save Quiz controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Silentpost_ProductQuiz::quiz_management';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var QuizInterfaceFactory
     */
    private $entityDataFactory;

    /**
     * @var Json
     */
    private $jsonHelper;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param QuizInterfaceFactory $entityDataFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveCommand $saveCommand,
        QuizInterfaceFactory $entityDataFactory,
        Json $jsonHelper
    )
    {
        parent::__construct($context);
        $this->context = $context;
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * Save Quiz Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var QuizInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The Quiz data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                'quiz_id' => $this->getRequest()->getParam('quiz_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
