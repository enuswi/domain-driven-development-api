<?php
namespace app\Models\Domain\ValueObjects\Chara;

use app\Models\Domain\ValueObjects\AbstractValueObject;

class Age extends AbstractValueObject
{
    public function __construct(private int $value)
    {
        // 正整数でなければ、例外を投げる
        if ($value < 0) {
            throw new \Exception('Chara.age is invalid.');
        }
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}