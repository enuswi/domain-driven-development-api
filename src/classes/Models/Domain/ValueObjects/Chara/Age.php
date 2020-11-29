<?php
namespace app\Models\Domain\ValueObjects\Chara;

use app\Models\Domain\ValueObjects\AbstractValueObject;

class Age extends AbstractValueObject
{
    /**
     * @var int $value
     */
    private $value;

    public function __construct(int $value)
    {
        // 正整数でなければ、例外を返す
        if ($value < 0) {
            throw new \Exception('');
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