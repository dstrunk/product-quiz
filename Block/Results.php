<?php

namespace Silentpost\ProductQuiz\Block;

use Magento\Catalog\Helper\Image;
use Magento\Checkout\Helper\Cart;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Silentpost\ProductQuiz\Model\Results as ResultsModel;

class Results extends Template
{
    /** @var ResultsModel */
    private $resultsModel;

    /** @var Escaper */
    public $escaper;

    /** @var Image */
    private $image;

    /** @var Cart */
    private $cartHelper;

    public function __construct(
        Context $context,
        ResultsModel $resultsModel,
        Escaper $escaper,
        Image $image,
        Cart $cartHelper,
        array $data = []
    ) {
        $this->resultsModel = $resultsModel;
        $this->escaper = $escaper;
        $this->image = $image;
        $this->cartHelper = $cartHelper;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getImageUrl($product, $imageId = 'product_thumbnail')
    {
        return $this->image->init($product, $imageId)->getUrl();
    }

    public function getSubmitUrl($product, $additional = [])
    {
        $requestingPageUrl = $this->getRequest()->getParam('requesting_page_url');
        if (! isset($additional['_escape'])) {
            $additional['_escape'] = true;
        }

        if (! isset($additional['_query'])) {
            $additional['_query'] = [];
        }

        $additional['_query']['options'] = 'cart';

        return $this->cartHelper->getAddUrl($product, $additional);
    }

    public function getRecommendedProduct()
    {
        return $this->resultsModel->getRecommendedProduct();
    }

    public function getTopProducts()
    {
        return $this->resultsModel->getTopProducts();
    }

    public function getQuiz()
    {
        return $this->resultsModel->getQuiz();
    }

    public function getQuestions()
    {
        return $this->resultsModel->getQuestions();
    }

    public function getUserProvidedAnswers()
    {
        return $this->resultsModel->getUserProvidedAnswers();
    }
}
