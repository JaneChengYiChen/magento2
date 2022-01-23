<?php
namespace Learning\HelloPage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class TestDisplay extends Template
{
    public function __construct(Context $context)
	{
		parent::__construct($context);
	}

    public function getTxt()
    {
        return __('Hello World~~~~~');
    }
}