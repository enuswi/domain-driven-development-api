<?php
namespace app\Models\Domain\ValueObjects;

abstract class AbstractValueObject
{
    /**
     * @return int|string
     */
    abstract public function getValue(): int|string;
}