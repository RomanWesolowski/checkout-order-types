<?php
declare(strict_types=1);

namespace WebIt\Types\Block\Adminhtml;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Backend\Block\Template;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Backend\Block\Template\Context;
use WebIt\Types\Model\ResourceModel\Types\Collection as TypesCollection;

/**
 * Class Attributes
 */
class Attributes extends Template
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var TypesCollection
     */
    protected $typesCollection;

    /**
     * @param Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param TypesCollection $typesCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        OrderRepositoryInterface $orderRepository,
        TypesCollection $typesCollection,
        array $data = []
    ) {
        $this->orderRepository = $orderRepository;
        $this->typesCollection = $typesCollection;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getOrderTypeName(): string
    {
        try {
            $orderId = $this->getRequest()->getParam('order_id');
            $order = $this->orderRepository->get($orderId);
            $orderTypeId = $order->getShippingAddress()->getOrderType() ?: 0;
            $orderType = $this->typesCollection->addFieldToFilter('id', $orderTypeId)->getFirstItem();

            return $orderType->getName() ?: '';
        } catch (NoSuchEntityException $e) {
            return '';
        }
    }
}
