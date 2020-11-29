<?php
namespace app\Models\Domain\ValueObjects\Chara;

use app\Models\Domain\ValueObjects\AbstractValueObject;

class BaseName extends AbstractValueObject
{
    /**
     * @var string $value
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}