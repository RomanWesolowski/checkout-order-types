<?php
declare(strict_types=1);

namespace WebIt\Types\Model\ResourceModel\Types;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('WebIt\Types\Model\Types', 'WebIt\Types\Model\ResourceModel\Types');
    }

}
