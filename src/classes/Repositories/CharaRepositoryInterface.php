<?php

namespace app\Repositories;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

interface CharaRepositoryInterface
{
    /**
     * キャラを追加する
     * @param int $id
     * @param Firstname $firstname
     * @param Lastname $lastname
     * @param Age $age
     * @return bool
     */
    public function store(int $id, Firstname $firstname, Lastname $lastname, Age $age): bool;

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
    public function getById(int $id): Chara|bool;
}