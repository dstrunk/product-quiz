<?php

namespace Silentpost\ProductQuiz\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Silentpost\ProductQuiz\Model\QuizModel;
use Silentpost\ProductQuiz\Model\QuizModelFactory;

class Data extends AbstractHelper
{
    /** @var Config */
    private $configHelper;

    /** @var QuizModelFactory */
    private $quizFactory;

    public function __construct(
        Context $context,
        Config $configHelper,
        QuizModelFactory $quizFactory
    ) {
        $this->configHelper = $configHelper;
        $this->quizFactory = $quizFactory;
        parent::__construct($context);
    }

    /**
     * @return false|QuizModel
     */
    public function getQuiz()
    {
        if (! $this->hasQuiz()) {
            return false;
        }

        return $this->quizFactory->create()->load($this->getSelectedQuiz());
    }

    /**
     * @return bool
     */
    public function hasQuiz(): bool
    {
        if (! $this->configHelper->getConfigValue(Config::PRODUCT_QUIZ_GENERAL_IS_ACTIVE)) {
            return false;
        }

        if (! $this->getSelectedQuiz()) {
            return false;
        }

        return true;
    }

    /**
     * @return false|int
     */
    private function getSelectedQuiz()
    {
        return (int) $this->configHelper->getConfigValue(Config::PRODUCT_QUIZ_GENERAL_ACTIVE_QUIZ) ?? false;
    }
}
