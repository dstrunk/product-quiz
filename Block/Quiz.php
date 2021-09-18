<?php

namespace Silentpost\ProductQuiz\Block;

use Magento\Customer\CustomerData\JsLayoutDataProviderPoolInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Silentpost\ProductQuiz\Helper\Data;
use Silentpost\ProductQuiz\Model\AnswerModel;
use Silentpost\ProductQuiz\Model\Data\AnswerData;
use Silentpost\ProductQuiz\Model\Data\QuestionData;
use Silentpost\ProductQuiz\Model\QuestionModel;

class Quiz extends Template
{
    /** @var Escaper */
    public Escaper $escaper;

    /** @var Data */
    private $helper;

    /** @var Json */
    private $json;

    public function __construct(
        Context $context,
        Escaper $escaper,
        JsLayoutDataProviderPoolInterface $jsLayout,
        Data $helper,
        Json $json,
        array $data = []
    ) {
        $this->escaper = $escaper;
        $this->jsLayout = isset($data['jsLayout'])
            ? array_merge_recursive($jsLayout->getData(), $data['jsLayout'])
            : $jsLayout->getData();
        $this->helper = $helper;
        $this->json = $json;

        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function hasQuiz(): bool
    {
        return $this->helper->hasQuiz();
    }

    public function getJsLayout()
    {
        return $this->json->serialize([
            'types',
            'components' => [
                'productQuizContainer' => [
                    'component' => 'Silentpost_ProductQuiz/js/product-quiz',
                    'data' => $this->buildQuizData(),
                    'displayArea' => 'productQuizContainer',
                    'children' => [
                        'introStage' => [
                            'component' => 'uiComponent',
                            'displayArea' => 'introStage',
                            'config' => [
                                'template' => 'Silentpost_ProductQuiz/product-quiz/stage/intro',
                            ],
                        ],
                        'quizStage' => [
                            'component' => 'uiComponent',
                            'displayArea' => 'quizStage',
                            'config' => [
                                'template' => 'Silentpost_ProductQuiz/product-quiz/stage/quiz',
                            ],
                        ],
                        'errorStage' => [
                            'component' => 'uiComponent',
                            'displayArea' => 'errorStage',
                            'config' => [
                                'template' => 'Silentpost_ProductQuiz/product-quiz/stage/error',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * @return array
     */
    public function buildQuizData()
    {
        $questions = [];
        /** @var QuestionData|QuestionModel $question */
        foreach ($this->helper->getQuiz()->getQuestions() as $question) {
            $answers = [];

            /** @var AnswerData|AnswerModel $answer */
            foreach ($question->getAnswers() as $answer) {
                $answers[] = [
                    'id' => $answer->getId(),
                    'title' => $answer->getTitle(),
                    'description' => $answer->getDescription(),
                    'selected' => false,
                ];
            }

            $questions[] = [
                'id' => $question->getId(),
                'title' => $question->getTitle(),
                'description' => $question->getDescription(),
                'answers' => $answers,
            ];
        }

        return [
            'title' => $this->helper->getQuiz()->getTitle(),
            'description' => $this->helper->getQuiz()->getDescription(),
            'button_text' => $this->helper->getQuiz()->getButtonText(),
            'questions' => $questions,
        ];
    }
}
