<?php

namespace Silentpost\ProductQuiz\Command\Question;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Silentpost\ProductQuiz\Model\QuestionModel;
use Silentpost\ProductQuiz\Model\QuestionModelFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuestionResource;

/**
 * Delete Question by id Command.
 */
class DeleteByIdCommand
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
     * Delete Question.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function execute(int $entityId)
    {
        try {
            /** @var QuestionModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, 'question_id');

            if (!$model->getData('question_id')) {
                throw new NoSuchEntityException(
                    __('Could not find Question with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Question. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Question.'));
        }
    }
}
