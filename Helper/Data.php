<?php
namespace Bgehlot\AutoRelatedProducts\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

	const SYSTEM_CONFIG_PATH_ENABLED = 'general/enabled';
	const SYSTEM_CONFIG_PATH_PRODUCTSCOUNT = 'general/product_count';
	const SYSTEM_CONFIG_PATH_CACHING = 'general/setup/caching';
	const SYSTEM_CONFIG_PATH_RELETEDDISPLAY = 'general/related_display';
	const SYSTEM_CONFIG_PATH_SLIDERENABLE = 'general/slider_enable';
	const SYSTEM_CONFIG_PATH_FILTER_CATEGORY = 'conditions/category';
	const SYSTEM_CONFIG_PATH_FILTER_PRICE = 'conditions/price';
	
	/**
     * @param \Magento\Framework\App\Helper\Context $context
     */
	public function __construct(
		\Magento\Framework\App\Helper\Context $context
	) {
		parent::__construct($context);
	}


	/**
	* @param $xmlPath
	* @param string $section
	*
	* @return string
	*/

	public function getConfigPath(
		$xmlPath,
		$section = 'autorelatedproducts'
	) {
		return $section . '/' . $xmlPath;
	}
	
	/**
     * Check is Module enabled
     *
     * @return string|null
     */
	public function isEnabled()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_ENABLED),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}


    	/**
	* Get Related Display
	*
	* @return string|null
	*/
	public function getRelatedDisplayFilter()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_RELETEDDISPLAY),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

	/**
	* Get Slider Enable
	*
	* @return string|null
	*/
	public function IsSliderEnable()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_SLIDERENABLE),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

	/**
	* Get get Cache lifetime
	*
	* @return string|null
	*/
	public function getCacheTime()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_CACHING),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

	/**
	* Get Category Filter
	*
	* @return string|null
	*/
	public function getCategoryFilter()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_FILTER_CATEGORY),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

	/**
	* Get Price Filter
	*
	* @return string|null
	*/
	public function getPriceFilter()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_FILTER_PRICE),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

     /**
     * Get product count
     *
     * @return string|null
     */
	public function getProductsCount()
	{
		return $this->scopeConfig->getValue(
			$this->getConfigPath(self::SYSTEM_CONFIG_PATH_PRODUCTSCOUNT),
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

}