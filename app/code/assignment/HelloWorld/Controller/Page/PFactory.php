<?php
namespace Assignment\HelloWorld\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;

class PFactory extends Action
{
	private $pageFactory;

	public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

	public function execute()
    {
        $page = $this->pageFactory->create();
        return $page;
    }
}