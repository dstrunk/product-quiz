<?php

namespace Silentpost\ProductQuiz\Command\Question;

use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Silentpost\ProductQuiz\Api\Data\QuestionInterface;
use Silentpost\ProductQuiz\Model\QuestionModel;
use Silentpost\ProductQuiz\Model\QuestionModelFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionResource;

/**
 * Save Question Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var QuestionModelFactory
     */
    private $modelFactory;

    /**
     * @var QuestionResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param QuestionModelFactory $modelFactory
     * @param QuestionResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        QuestionModelFactory $modelFactory,
        QuestionResource $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save Question.
     *
     * @param QuestionInterface|DataObject $question
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(QuestionInterface $question): int
    {
        try {
            /** @var QuestionModel $model */
            $model = $this->modelFactory->create();
            $model->addData($question->getData());
            $model->setHasDataChanges(true);

            if (!$model->getId()) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Question. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Question.'));
        }

        return (int)$model->getEntityId();
    }
}
