<?php

namespace Silentpost\ProductQuiz\Controller\Results;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\UrlInterface;

class Post implements HttpPostActionInterface
{
    /** @var RequestInterface */
    private $request;

    /** @var UrlInterface */
    private $url;

    /** @var JsonFactory */
    private $jsonFactory;

    public function __construct(
        RequestInterface $request,
        UrlInterface $url,
        JsonFactory $jsonFactory
    )  {
        $this->request = $request;
        $this->url = $url;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->jsonFactory->create()->setData([
            'response' => 'success',
            'redirect_url' => $this->url->getUrl('*/*/index'),
        ]);
    }
}
