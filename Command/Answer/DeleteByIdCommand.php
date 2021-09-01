<?php

namespace Silentpost\ProductQuiz\Command\Answer;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Silentpost\ProductQuiz\Model\AnswerModel;
use Silentpost\ProductQuiz\Model\AnswerModelFactory;
use Silentpost\ProductQuiz\Model\ResourceModel\AnswerResource;

/**
 * Delete Answer by id Command.
 */
class DeleteByIdCommand
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
     * Delete Answer.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function execute(int $entityId)
    {
        try {
            /** @var AnswerModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, 'answer_id');

            if (!$model->getData('answer_id')) {
                throw new NoSuchEntityException(
                    __('Could not find Answer with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Answer. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Answer.'));
        }
    }
}
