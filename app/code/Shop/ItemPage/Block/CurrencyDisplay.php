<?php
namespace Shop\ItemPage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CurrencyDisplay extends Template
{
    public function __construct(Context $context)
	{
		parent::__construct($context);
	}

    public function getContent()
    {
        return $this->curlApi();
    }

    private function curlApi()
    {
        $url ='https://tw.rter.info/capi.php';
        $url_data = file_get_contents($url);
        $currency = json_decode($url_data); 

        return $url_data;
    }
}