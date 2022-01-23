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
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Test extends Action
{
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * View  page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $page = $this->pageFactory->create();
        return $page;
        // $result = $this->resultJsonFactory->create();
        // $data = ['message' => 'testing Page'];

        // return $result->setData($data);
    }
}