<?php
namespace Shop\ItemPage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Shop\ItemPage\Api\GetApi;
use Shop\ItemPage\Api\GetUrl;

class CurrencyDisplay extends Template
{
    public function __construct(Context $context)
	{
		parent::__construct($context);
	}

    public function getContent()
    {
        $api = new GetApi(GetUrl::currencyUri);
        return $api->getResponse();
    }
}