<?php

namespace Silentpost\ProductQuiz\Command\Quiz;

use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Silentpost\ProductQuiz\Api\Data\QuizInterface;
use Silentpost\ProductQuiz\Model\QuizModel;
use Silentpost\ProductQuiz\Model\QuizModelFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizResource;

/**
 * Save Quiz Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var QuizModelFactory
     */
    private $modelFactory;

    /**
     * @var QuizResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param QuizModelFactory $modelFactory
     * @param QuizResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        QuizModelFactory $modelFactory,
        QuizResource $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save Quiz.
     *
     * @param QuizInterface|DataObject $quiz
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(QuizInterface $quiz): int
    {
        try {
            /** @var QuizModel $model */
            $model = $this->modelFactory->create();
            $model->addData($quiz->getData());
            $model->setHasDataChanges(true);

            if (!$model->getId()) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Quiz. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Quiz.'));
        }

        return (int)$model->getEntityId();
    }
}
