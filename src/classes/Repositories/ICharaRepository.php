<?php

namespace app\Repositories;

use app\Models\Domain\Entities\Chara;

interface ICharaRepository
{
    /**
     * @return array
     */
    public function getList(): array;

    /**
     * @param int $id
     * @return Chara|bool
     */
    public function getById(int $id);
}