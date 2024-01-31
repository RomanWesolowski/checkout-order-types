<?php
declare(strict_types=1);

namespace WebIt\Types\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Class SaveToOrder
 */
class SaveToOrder implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer): SaveToOrder
    {
        $event = $observer->getEvent();
        $quote = $event->getQuote();
        $orderType = $quote->getShippingAddress()->getOrderType();

        $order = $observer->getOrder();
        $order->getShippingAddress()->setData('order_type', $orderType);

        return $this;
    }
}
