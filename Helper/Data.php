<?php
namespace AHT\Checkout\Helper;

use \Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\StoreManagerInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem ;

    /**
     * @var \Magento\Framework\App\ProductMetadata
     */
    protected $productMetadata;

    /**
     * @var Json
     */
    protected $json;

    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $currency;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Serialize
     */
    protected $serialize;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\App\ProductMetadata $productMetadata
     * @param Json $json
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param \Magento\Directory\Model\Currency $currency
     * @param \Magento\Framework\Serialize\Serializer\Serialize $serialize
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\ProductMetadata $productMetadata,
        Json $json,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Directory\Model\Currency $currency,
        \Magento\Framework\Serialize\Serializer\Serialize $serialize
    ) {
    
        $this->storeManager = $storeManager;
        $this->date = $date;
        $this->filesystem = $filesystem;
        $this->productMetadata = $productMetadata;
        $this->json = $json;
        $this->priceCurrency = $priceCurrency;
        $this->currency = $currency;
        $this->serialize = $serialize;
        parent::__construct($context);
    }

    /**
     * Get Store.
     *
     * @return \Magento\Store\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStore()
    {
        return $this->storeManager->getStore();
    }

    /**
     * @return \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }

    /**
     * @return \Magento\Directory\Model\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    /**
     * @return bool
     */
    public function isEnable()
    {
        return $this->scopeConfig->getValue(
            'freeshippingbar/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getFreeShippingStatus()
    {
        return $this->scopeConfig->getValue('carriers/freeshipping/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function gettitle()
    {
        return $this->scopeConfig->getValue(
            'freeshippingbar/general/title_freeshipping',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getFreeshipping()
    {
        return $this->scopeConfig->getValue(
            'freeshippingbar/general/freeshipping',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getPriceForShippingBar()
    {
        return $this->scopeConfig->getValue(
            'carriers/freeshipping/free_shipping_subtotal',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

}
