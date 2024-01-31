<?php
declare(strict_types=1);

namespace WebIt\Types\Plugin\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Model\ShippingInformationManagement as MagentoShippingInformationManagement;
use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ShippingInformationManagement
 */
class ShippingInformationManagement
{
    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(QuoteRepository $quoteRepository) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param MagentoShippingInformationManagement $subject
     * @param int $cartId
     * @param ShippingInformationInterface $addressInformation
     * @return void
     * @throws NoSuchEntityException
     */
    public function beforeSaveAddressInformation(MagentoShippingInformationManagement $subject, int $cartId, ShippingInformationInterface $addressInformation): void
    {
        $shippingAddress = $addressInformation->getShippingAddress();
        $orderType = $shippingAddress->getExtensionAttributes()->getOrderType();

        $quote = $this->quoteRepository->getActive($cartId);
        $quote->getShippingAddress()->setData('order_type', $orderType);
    }
}
