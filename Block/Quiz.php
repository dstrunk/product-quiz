<?php

namespace Silentpost\ProductQuiz\Block;

use Magento\Customer\CustomerData\JsLayoutDataProviderPoolInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Silentpost\ProductQuiz\Helper\Config;

class Quiz extends Template
{
    /** @var Escaper */
    public Escaper $escaper;

    /** @var Config */
    private Config $helper;

    public function __construct(
        Context $context,
        Escaper $escaper,
        JsLayoutDataProviderPoolInterface $jsLayout,
        Config $helper,
        array $data = []
    ) {
        $this->escaper = $escaper;
        $this->jsLayout = isset($data['jsLayout'])
            ? array_merge_recursive($jsLayout->getData(), $data['jsLayout'])
            : $jsLayout->getData();
        $this->helper = $helper;

        parent::__construct($context, $data);
    }

    public function getTitle()
    {
        return $this->helper->getConfigValue(Config::PRODUCTQUIZ_GENERAL_TITLE);
    }

    public function getDescription()
    {
        return $this->helper->getConfigValue(Config::PRODUCTQUIZ_GENERAL_DESCRIPTION);
    }

    public function getJsLayout()
    {
        return json_encode([
            'types',
            'components' => [
                'productQuizContainer' => [
                    'component' => 'Silentpost_ProductQuiz/js/product-quiz',
                    'data' => [
                        'title' => $this->getTitle(),
                        'description' => $this->getDescription(),
                    ],
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
}
