<?php
namespace Bgehlot\AutoRelatedProducts\Model\Config\Source;

class Category implements \Magento\Framework\Option\ArrayInterface
{
 public function toOptionArray()
 {
  return [
    ['value' => 'any', 'label' => __('Any Category')],
    ['value' => 'same', 'label' => __('Same category')]
  ];
 }
}