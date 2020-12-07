<?php

namespace app\Repositories;

use app\Models\Domain\Entities\Chara;

interface ICharaRepository
{
    /**
     * キャラ一覧を取得する
     * @return array
     */
    public function getList(): array;

    /**
     * 指定したIDのキャラを取得する
     * @param int $id
     * @return Chara|bool
     */
    public function getById(int $id);
}