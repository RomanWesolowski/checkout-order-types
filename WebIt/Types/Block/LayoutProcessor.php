<?php
declare(strict_types=1);

namespace WebIt\Types\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use WebIt\Types\Model\ResourceModel\Types\Collection;

/**
 * Class LayoutProcessor
 */
class LayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param Collection $collection
     */
    public function __construct(Collection $collection) {
        $this->collection = $collection;
    }

    /**
     * @param $jsLayout
     * @return array
     */
    public function process($jsLayout): array
    {
        $options = [];
        foreach ($this->collection as $type) {
            $options[] = ['value' => $type['id'], 'label' => $type['name']];
        }

        if (!$options) {
            return $jsLayout;
        }

        $attributeCode = 'order_type';
        $fieldConfiguration = [
            'component' => 'Magento_Ui/js/form/element/checkbox-set',
            'config' => [
                'customScope' => 'shippingAddress.extension_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox-set',
                'checked' => true,
                'options' => $options,
            ],
            'dataScope' => 'shippingAddress.extension_attributes' . '.' . $attributeCode,
            'label' => 'Order Types',
            'provider' => 'checkoutProvider',
            'sortOrder' => 1000,
            'validation' => [
                'required-entry' => true
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => ''
        ];

        $jsLayout['components']['checkout']['children']
        ['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']
        ['children'][$attributeCode] = $fieldConfiguration;

        return $jsLayout;
    }
}
