<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\HelloPage\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Learning\HelloPage\Api\GetApi;
use Learning\HelloPage\Api\GetApiSimple;

class Jane extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * View  page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $api = new GetApiSimple;
        $txt = $api->getResponse();
        $result = $this->resultPageFactory->create();

        return $result;
    }
}