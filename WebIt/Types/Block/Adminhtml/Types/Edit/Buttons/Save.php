<?php
declare(strict_types=1);

namespace WebIt\Types\Block\Adminhtml\Types\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Model\UrlInterface;

/**
 * Class Save
 */
class Save implements ButtonProviderInterface
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param UrlInterface $url
     */
    public function __construct(
        UrlInterface $url
    ) {
        $this->urlBuilder = $url;
    }

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save Name'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
