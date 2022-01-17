<?php
namespace Bgehlot\AutoRelatedProducts\Model\Config\Source;

class Price implements \Magento\Framework\Option\ArrayInterface
{
 public function toOptionArray()
 {
  return [
    ['value' => 'any', 'label' => __('Any Price')],
    ['value' => 'same', 'label' => __('Same as Product price')],
    ['value' => 'more', 'label' => __('More then current Product Price')],
    ['value' => 'less', 'label' => __('Less then current Product Price')]
  ];
 }
}