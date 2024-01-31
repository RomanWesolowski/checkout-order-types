<?php
declare(strict_types=1);

namespace WebIt\Types\Model;

use WebIt\Types\Api\Data\TypesInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Types
 */
class Types extends AbstractModel implements TypesInterface
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('WebIt\Types\Model\ResourceModel\Types');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(static::NAME) ?: '';
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Types
    {
        $this->setData(static::NAME, $name);

        return $this;
    }
}
