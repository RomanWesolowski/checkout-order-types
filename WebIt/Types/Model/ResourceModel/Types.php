<?php
declare(strict_types=1);

namespace WebIt\Types\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Types
 */
class Types extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('webit_types', 'id');
    }

}
