<?php
namespace Bgehlot\AutoRelatedProducts\Model\Config\Source;

class Attribute implements \Magento\Framework\Option\ArrayInterface
{
 public function toOptionArray()
 {
  return [
    ['value' => 'any', 'label' => __('Any attrubte')],
    ['value' => 'same', 'label' => __('Same as Product')]
  ];
 }
}