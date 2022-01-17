<?php
namespace Bgehlot\AutoRelatedProducts\Model\Config\Source;

class RelatedProductDisplay implements \Magento\Framework\Option\ArrayInterface
{
 public function toOptionArray()
 {
  return [
    ['value' => 'manual', 'label' => __('Manual Added Product')],
    ['value' => 'replace', 'label' => __('Replace Manual Added Products')]
  ];
  // return [
  //   ['value' => 'manual', 'label' => __('Manual Added Product')],
  //   ['value' => 'replace', 'label' => __('Replace Manual Added Products')],
  //   ['value' => 'merge', 'label' => __('Merge Products')]
  // ];
 }
}