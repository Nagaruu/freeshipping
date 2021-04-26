<?php
namespace AHT\Checkout\Block;
use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\CartFactory;
use AHT\Checkout\Helper\Data;

class FreeShippingBar extends Template
{
    protected $_helper;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    protected $_cart;
    protected $_localecurrency;

    /**
     * FreeShippingBar constructor.
     * @param Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Locale\CurrencyInterface $localeCurrency,
        Template\Context $context,CartFactory $_cart,
        \Magento\Customer\Model\Session $customerSession,
        Data $helper,
        array $data = []
    ) {
        $this->_cart = $_cart;
        $this->_helper = $helper;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
        $this->_localecurrency = $localeCurrency;
        $this->customerSession = $customerSession;
    }
    public function amountsub(){
        $model = $this->_cart->create();
        $quote = $model->getQuote();
        $sub_amount = $quote->getGrandTotal();
        return $sub_amount;
    }
    public function orderTotal(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart1 = $objectManager->get('\Magento\Checkout\Model\Cart'); 
        $billingAddress = $cart1->getQuote()->getShippingAddress();
        return $billingAddress;
    }
    public function isEnable()
    {
        return $this->scopeConfig->getValue('freeshippingbar/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getFreeShippingSubtotal()
    {
        return $this->scopeConfig->getValue('carriers/freeshipping/free_shipping_subtotal', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getFreeShippingStatus()
    {
        return $this->scopeConfig->getValue('carriers/freeshipping/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function mess(){
        return $this->_helper->gettitle();
    }
    public function messfree(){
        return $this->_helper->getFreeshipping();
    }
    public function getStoreCurrency(){
        $currencycode = $this->_storeManager->getStore()->getCurrentCurrencyCode();
        return $this->_localecurrency->getCurrency($currencycode)->getSymbol();
    }
    public function getCurrentCurrencyCode()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }
}
