<?php
namespace app\Models\Domain\Entities;

abstract class AbstractEntity
{
    /**
     * 自身（オブジェクト）を配列形式で取得する
     * @return array
     */
    abstract public function toArray(): array;
}