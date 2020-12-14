<?php
namespace app\Models\Domain\ValueObjects\Chara;

use app\Models\Domain\ValueObjects\AbstractValueObject;

class BaseName extends AbstractValueObject
{
    /**
     * BaseName constructor.
     * @param string $value
     */
    public function __construct(private string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}