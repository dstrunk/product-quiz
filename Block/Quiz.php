<?php

namespace Silentpost\ProductQuiz\Block;

use Magento\Customer\CustomerData\JsLayoutDataProviderPoolInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Quiz extends Template
{
    /** @var Escaper */
    public Escaper $escaper;

    public function __construct(
        Context $context,
        Escaper $escaper,
        JsLayoutDataProviderPoolInterface $jsLayout,
        array $data = []
    ) {
        $this->escaper = $escaper;
        $this->jsLayout = isset($data['jsLayout'])
            ? array_merge_recursive($jsLayout->getData(), $data['jsLayout'])
            : $jsLayout->getData();

        parent::__construct($context, $data);
    }
}
