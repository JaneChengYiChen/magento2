<?php
namespace Shop\ItemPage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class CurrencyDisplay extends Template
{
    public function __construct(Context $context, JsonFactory $resultJsonFactory)
	{
		parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
	}

    public function getContent()
    {
        return $this->curlApi();
    }

    private function curlApi()
    {
        $result = $this->resultJsonFactory->create();
        $url ='https://tw.rter.info/capi.php';
        $url_data = file_get_contents($url);
        $currency = json_decode($url_data); 

        return $result->setData($currency);
    }
}