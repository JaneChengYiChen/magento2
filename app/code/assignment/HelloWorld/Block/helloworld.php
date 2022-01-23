<?php
namespace Assignment\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getText() {
        return "Hello World";
    }
}