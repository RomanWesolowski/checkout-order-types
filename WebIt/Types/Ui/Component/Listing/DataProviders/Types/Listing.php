<?php
declare(strict_types=1);

namespace WebIt\Types\Ui\Component\Listing\DataProviders\Types;

use WebIt\Types\Model\ResourceModel\Types\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class Listing
 */
class Listing extends AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
