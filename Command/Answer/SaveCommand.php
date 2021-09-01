<?php

namespace Silentpost\ProductQuiz\Command\Answer;

use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Silentpost\ProductQuiz\Api\Data\AnswerInterface;
use Silentpost\ProductQuiz\Model\AnswerModel;
use Silentpost\ProductQuiz\Model\AnswerModelFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerResource;

/**
 * Save Answer Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var AnswerModelFactory
     */
    private $modelFactory;

    /**
     * @var AnswerResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param AnswerModelFactory $modelFactory
     * @param AnswerResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        AnswerModelFactory $modelFactory,
        AnswerResource $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save Answer.
     *
     * @param AnswerInterface|DataObject $answer
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(AnswerInterface $answer): int
    {
        try {
            /** @var AnswerModel $model */
            $model = $this->modelFactory->create();
            $model->addData($answer->getData());
            $model->setHasDataChanges(true);

            if (!$model->getId()) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Answer. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Answer.'));
        }

        return (int)$model->getEntityId();
    }
}
