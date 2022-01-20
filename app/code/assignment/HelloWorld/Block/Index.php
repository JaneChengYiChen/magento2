<?php
/**
* Simple Hello World Module
*
* @category Assignment
* @package Assignment_HelloWorld
*
*/
namespace Assignment\HelloWorld\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout() {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('First Hello World Module'));
        return $this;
    }
}