<?php

namespace Silentpost\ProductQuiz\Controller\Adminhtml\Quiz;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
use Silentpost\ProductQuiz\Block\Adminhtml\Quiz\Product;

class ProductGrid extends Action
{
    /** @var RawFactory */
    private $rawFactory;

    /** @var LayoutFactory */
    private $layoutFactory;

    public function __construct(
        Action\Context $context,
        RawFactory $rawFactory,
        LayoutFactory $layoutFactory
    ) {
        $this->rawFactory = $rawFactory;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->rawFactory->create();

        return $result->setContents(
            $this->layoutFactory->create()->createBlock(
                Product::class,
                'quiz.product.grid'
            )->toHtml()
        );
    }
}
