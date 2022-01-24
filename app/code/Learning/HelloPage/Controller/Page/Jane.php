<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\HelloPage\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Learning\HelloPage\Api\GetApi;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Psr7\ResponseFactory;

class Jane extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->apiFactory = new GetApi(new ClientFactory, new ResponseFactory);
    }

    /**
     * View  page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $text = $this->apiFactory->execute();
        $result = $this->resultJsonFactory->create();

        return $result->setData($text);
    }
}