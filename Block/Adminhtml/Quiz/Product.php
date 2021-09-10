<?php

namespace Silentpost\ProductQuiz\Block\Adminhtml\Quiz;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Module\Manager;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\StoreManagerInterface;
use Silentpost\ProductQuiz\Model\ResourceModel\QuizModel\QuizCollectionFactory;

class Product extends Extended
{
    /** @var ProductFactory */
    private $productFactory;

    /** @var QuizCollectionFactory */
    private $quizCollectionFactory;

    /** @var Registry */
    private $registry;

    /** @var Manager */
    private $moduleManager;

    /** @var StoreManagerInterface */
    private $storeManager;

    /** @var Json */
    private $jsonHelper;

    /** @var Visibility|null */
    private $visibility;

    /** @var Status|null */
    private $status;

    public function __construct(
        Context $context,
        Data $backendHelper,
        ProductFactory $productFactory,
        QuizCollectionFactory $quizCollectionFactory,
        Registry $registry,
        Manager $moduleManager,
        StoreManagerInterface $storeManager,
        Json $jsonHelper,
        Visibility $visibility = null,
        Status $status = null,
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        $this->quizCollectionFactory = $quizCollectionFactory;
        $this->registry = $registry;
        $this->moduleManager = $moduleManager;
        $this->storeManager = $storeManager;
        $this->jsonHelper = $jsonHelper;
        $this->visibility = $visibility ?: ObjectManager::getInstance()->get(Visibility::class);
        $this->status = $status ?: ObjectManager::getInstance()->get(Status::class);

        parent::__construct($context, $backendHelper, $data);
    }

    public function _construct()
    {
        parent::_construct();

        $this->setId('productquiz_grid_products');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
        $this->setDefaultFilter(['in_products' => 0]);
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $store = $this->getStore();
        $collection = $this->productFactory
            ->create()
            ->getCollection()
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('attribute_set_id')
            ->addAttributeToSelect('type_id')
            ->addAttributeToSelect('visibility')
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('status')
            ->setStore($store);

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('in_products', [
            'type' => 'checkbox',
            'html_name' => 'products_id',
            'required' => true,
            'values' => $this->getSelectedProductKeys(),
            'align' => 'center',
            'index' => 'entity_id',
        ]);

        $this->addColumn('entity_id', [
            'header' => __('ID'),
            'width' => '50px',
            'index' => 'entity_id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'header' => __('Name'),
            'index' => 'name',
            'header_css_class' => 'col-type',
            'column_css_class' => 'col-type',
        ]);

        $this->addColumn('sku', [
            'header' => __('SKU'),
            'index' => 'sku',
            'header_css_class' => 'col-sku',
            'column_css_class' => 'col-sku',
        ]);

        $this->addColumn('visibility', [
            'header' => __('Visibility'),
            'index' => 'visibility',
            'type' => 'options',
            'options' => $this->visibility->getOptionArray(),
            'header_css_class' => 'col-visibility',
            'column_css_class' => 'col-visibility',
        ]);

        $this->addColumn('status', [
            'header' => __('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => $this->status->getOptionArray(),
        ]);

        $this->addColumn('price', [
            'header' => __('Price'),
            'type' => 'currency',
            'currency_code' => (string)$this->_scopeConfig->getValue(
                \Magento\Directory\Model\Currency::XML_PATH_CURRENCY_BASE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            ),
            'index' => 'price',
        ]);

        $this->addColumn('position', [
            'header' => __('Position'),
            'index' => 'position',
            'editable' => true,
            'edit_only' => true,
        ]);

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/quiz/productGrid', ['_current' => true]);
    }

    private function getSelectedProductKeys()
    {
        return array_keys($this->getSelectedProducts());
    }

    private function getSelectedProducts(): array
    {
        $id = $this->getRequest()->getParam('quiz_id');
        $model = $this->quizCollectionFactory->create()->addFieldToFilter('quiz_id', $id);

        $products = $model->getData()[0]['products'];
        if (empty($model->getData()) || $products === '') {
            return [];
        }

        $products = $this->jsonHelper->unserialize($products);
        $grid = [];
        foreach ($products as $product => $position) {
            $grid[$product] = ['position' => $position];
        }

        return $grid;
    }

    private function getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);

        return $this->_storeManager->getStore($storeId);
    }
}
