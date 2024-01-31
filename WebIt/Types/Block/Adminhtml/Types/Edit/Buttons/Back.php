<?php
declare(strict_types=1);

namespace WebIt\Types\Block\Adminhtml\Types\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Model\UrlInterface;

/**
 * Class Back
 */
class Back implements ButtonProviderInterface
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
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->urlBuilder->getUrl('*/index/index')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
