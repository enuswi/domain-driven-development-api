<?php
namespace app\Models\Domain\ValueObjects;

abstract class AbstractValueObject
{
    /**
     * @return mixed
     */
    abstract public function getValue();
}