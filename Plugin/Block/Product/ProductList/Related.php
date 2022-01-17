<?php 
namespace Bgehlot\AutoRelatedProducts\Plugin\Block\Product\ProductList;

class Related {

	protected $_categoryFactory;
	protected $_registry;
    protected $_dataHelper;
    protected $_productCollectionFactory;
    protected $_action;
    protected $_configurable;
    protected $_storeManager;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurable,
        \Bgehlot\AutoRelatedProducts\Helper\Data $dataHelper
    ) {
		$this->_categoryFactory = $categoryFactory;
        $this->_registry = $registry;
        $this->_productCollectionFactory = $productCollectionFactory; 
        $this->_configurable = $configurable;
        $this->_dataHelper = $dataHelper;
        $this->_storeManager = $context->getStoreManager();
        $this->_action='';

        $_time = $this->_dataHelper->getCacheTime();
        if ($_time > 0 && $cacheKey = $this->_cacheKey()) {
            $this->addData(array(
                'cache_lifetime'    => $_time,
                'cache_tags'        => array(\Magento\Store\Model\Store::CACHE_TAG),
                'cache_key'         => $cacheKey,
            ));
        }
    }

    protected function _cacheKey()
    {
        $product = $this->_registry->registry('product');
        if ($product) {
            return get_class() . '::' .  $this->_storeManager->getStore()->getCode() . '::' . $product->getId();
        }
        return false;
    }
	
	public function afterGetItems(
		\Magento\Catalog\Block\Product\ProductList\Related $subject,
		$result
	){
        if($this->_dataHelper->isEnabled()){
            $relatedDisplay=$this->_dataHelper->getRelatedDisplayFilter();
            if($relatedDisplay == "manual"){
                return $result;
            }elseif($relatedDisplay == "replace"){
                $this->_action=$relatedDisplay;
                $collection = $this->getRelatedProductsCollection($result);
                return $collection;
            }else{
                $this->_action=$relatedDisplay;
                $collection = $this->getRelatedProductsCollection($result);
                return $collection;
            }
        }
        return $result;
	}
	
	private function getRelatedProductsCollection($loadedCollection)
	{      
        $product = $this->_registry->registry('current_product');
       
        if($product->getTypeId() === 'configurable'){
            $price=$product->getFinalPrice();
        }else{
            $price=$product->getFinalPrice();
        }
        
        $attributes = $product->getAttributes();
        $productCount = $this->_dataHelper->getProductsCount();

        if($this->_dataHelper->getCategoryFilter() == "same"){
            $productCategories = $this->getProductCategories($product);
            $categoryId = end($productCategories);
            $category = $this->_categoryFactory->create()->load($categoryId);
            $product_collection = $category->getProductCollection()->addAttributeToSelect('*')->addStoreFilter($this->_storeManager->getStore());
        }else{
            $product_collection = $this->getProductCollection();
        }
        if($this->_action == 'merge'){
            
        }   
        if($this->_dataHelper->getPriceFilter() == "same"){
            $product_collection->addFieldToFilter('price',['eq' => $price]);
        }elseif($this->_dataHelper->getPriceFilter() == "more"){
            $product_collection->addFieldToFilter('price',array('gt'=> $price));
        }elseif($this->_dataHelper->getPriceFilter() == "less"){
            $product_collection->addFieldToFilter('price',['lt'=> $price]);
        }

        $product_collection->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        $product_collection->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $product_collection->setPageSize($productCount);
        $product_collection->getSelect()->orderRand();
        return $product_collection;
    }

    public function getProductCategories($product){
        return $product->getCategoryIds();
    }

    public function getProductAttributes($product){

    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addStoreFilter($this->_storeManager->getStore());
        return $collection;
    }
}