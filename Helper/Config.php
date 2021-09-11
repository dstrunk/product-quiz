<?php

namespace Silentpost\ProductQuiz\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Config extends AbstractHelper
{
    const PRODUCT_QUIZ_GENERAL_IS_ACTIVE = 'product_quiz/general/is_active';
    const PRODUCT_QUIZ_GENERAL_ACTIVE_QUIZ = 'product_quiz/general/active_quiz';

    public function getConfigValue(
        $value,
        $type = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $store = null
    ) {
        return $this->scopeConfig->getValue($value, $type, $store);
    }
}
