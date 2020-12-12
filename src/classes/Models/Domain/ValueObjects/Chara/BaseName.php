<?php
namespace app\Models\Domain\ValueObjects\Chara;

use app\Models\Domain\ValueObjects\AbstractValueObject;

class BaseName extends AbstractValueObject
{
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