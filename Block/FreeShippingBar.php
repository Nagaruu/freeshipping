<?php
namespace AHT\Checkout\Block;
use Magento\Framework\View\Element\Template;
use AHT\Checkout\Helper\Data;

class FreeShippingBar extends Template
{
    protected $_helper;

    /**
     * FreeShippingBar constructor.
     * @param Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
        Data $helper,
        array $data = []
    ) {
        $this->_helper = $helper;
    }
    public function messfree(){
        return $this->_helper->getFreeshipping();
    }
}
