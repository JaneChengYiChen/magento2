<?php
namespace Learning\HelloPage\Block;

use Magento\Framework\View\Element\Template;
 
class Test extends Template
{
    public function getTxt()
    {
        return 'Hello world!';
    }
}