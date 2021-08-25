<?php

namespace Silentpost\ProductQuiz\Command\Quiz;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Silentpost\ProductQuiz\Model\QuizModel;
use Silentpost\ProductQuiz\Model\QuizModelFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizResource;

/**
 * Delete Quiz by id Command.
 */
class DeleteByIdCommand
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
     * Delete Quiz.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function execute(int $entityId)
    {
        try {
            /** @var QuizModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, 'quiz_id');

            if (!$model->getData('quiz_id')) {
                throw new NoSuchEntityException(
                    __('Could not find Quiz with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Quiz. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Quiz.'));
        }
    }
}
