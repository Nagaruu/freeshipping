<?php

namespace AHT\Checkout\Plugin;
use Magento\Framework\UrlInterface;
use Magento\Framework\Locale\CurrencyInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Checkout\Model\CartFactory;

class ConfigPlugin
{
    /**
     * @var UrlInterface
     */
    protected $url;
    protected $_localecurrency;
    protected $scopeConfig;
    protected $_cart;

    /**
     * ConfigPlugin constructor.
     * @param UrlInterface $url
     */
    public function __construct(
        UrlInterface $url,CurrencyInterface $localeCurrency,ScopeConfigInterface $scopeConfig,CartFactory $cart
    ) {
        $this->url = $url;
        $this->_cart = $cart;
        $this->scopeConfig = $scopeConfig;
        $this->_localecurrency = $localeCurrency;
    }

    /**
     * @param \Magento\Checkout\Block\Cart\Sidebar $subject
     * @param array $result
     * @return array
     */
    public function afterGetConfig(
        \Magento\Checkout\Block\Cart\Sidebar $subject,
        array $result
    ) {

        // $FreeShippingStatus  = $this->scopeConfig->getValue('carriers/freeshipping/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $enable =  $this->scopeConfig->getValue('freeshippingbar/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $mess_free = $this->scopeConfig->getValue('freeshippingbar/general/freeshipping', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
        //Get symbol curency
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->create('\Magento\Store\Model\StoreManagerInterface');
        $currencycode = $storeManager->getStore()->getCurrentCurrencyCode();
        $symbol = $this->_localecurrency->getCurrency($currencycode)->getSymbol();

        //Get value free shipping
        $FreeShippingSubtotal = $this->scopeConfig->getValue('carriers/freeshipping/free_shipping_subtotal', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($enable  == 1){
                $result['freeShippingSubtotal'] = $FreeShippingSubtotal;
                $result['symbol'] = $symbol;
                $result['currency'] = $currencycode;
                $result['mess_free'] = $mess_free;  
        }
        return $result;
    }
}

