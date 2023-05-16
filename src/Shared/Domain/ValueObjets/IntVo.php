<?php
namespace Src\Shared\Domain\ValueObjets;

abstract class IntVo
{
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isBiggerThan(IntVo $other): bool
    {
        return $this->value() > $other->value();
    }
}