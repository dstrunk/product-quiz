<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\Quiz;

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
        $quizId = $this->getRequest()->getParam('quiz_id');
        $quizFactory = $this->quizCollectionFactory->create();
        $quizFactory->addFieldToSelect(['products']);
        $quizFactory->addFieldToFilter('quiz_id', ['eq' => $quizId]);

        if (empty($quizFactory->getData())) {
            return $this->jsonEncoder->serialize('');
        }

        $products = $quizFactory->getData()[0]['products'];
        if ($products === '') {
            return $this->jsonEncoder->serialize('');
        }

        return $quizFactory->getData()[0]['products'];
    }

    public function getItem()
    {
        return $this->registry->registry('productquiz_products');
    }
}
