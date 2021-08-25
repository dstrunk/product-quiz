<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\ProductQuiz\Quiz;

use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\Serializer\Json;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizModel\QuizCollectionFactory;

class AssignProducts extends Template
{
    protected $_template = 'Silentpost_ProductQuiz::productquiz/quiz/edit/assign_products.phtml';

    /** @var Registry */
    private $registry;

    /** @var Json */
    private $jsonEncoder;

    /** @var QuizCollectionFactory */
    private $quizCollectionFactory;

    /** @var Product */
    private $blockGrid;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        Json $jsonEncoder,
        QuizCollectionFactory $quizCollectionFactory,
        array $data = [],
        ?JsonHelper $jsonHelper = null,
        ?DirectoryHelper $directoryHelper = null
    ) {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->quizCollectionFactory = $quizCollectionFactory;

        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
    }

    public function getBlockGrid()
    {
        if ($this->blockGrid === null) {
            $this->blockGrid = $this->getLayout()->createBlock(
                Product::class,
                'productquiz.product.grid'
            );
        }

        return $this->blockGrid;
    }

    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }

    public function getProductsJson()
    {
        $entityId = $this->getRequest()->getParam('quiz_id');
        $productFactory = $this->quizCollectionFactory->create();
        $productFactory->addFieldToSelect(['products']);
        $productFactory->addFieldToFilter('quiz_id', ['eq' => $entityId]);

        $products = $productFactory->getData()[0]['products'];
        if (empty($productFactory->getData()) || $products === '') {
            return $this->jsonEncoder->serialize('');
        }

        return $productFactory->getData()[0]['products'];
    }

    public function getItem()
    {
        return $this->registry->registry('productquiz_products');
    }
}
