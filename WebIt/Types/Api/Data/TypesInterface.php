<?php
declare(strict_types=1);

namespace WebIt\Types\Api\Data;

use WebIt\Types\Model\Types;

/**
 * Interface TypesInterface
 */
interface TypesInterface
{
    /**
     * const string
     */
    const NAME = 'name';

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return Types
     */
    public function setName(string $name): Types;

}
