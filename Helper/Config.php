<?php

namespace Silentpost\ProductQuiz\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Config extends AbstractHelper
{
    const PRODUCTQUIZ_GENERAL_TITLE = 'product_quiz/general/title';
    const PRODUCTQUIZ_GENERAL_DESCRIPTION = 'product_quiz/general/description';

    public function getConfigValue(
        $value,
        $type = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $store = null
    ) {
        return $this->scopeConfig->getValue($value, $type, $store);
    }
}
