<?php
namespace app\Repositories;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class MockCharaRepository implements ICharaRepository
{
    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        $charas = [
            new Chara(1, new Firstname('炭治郎'), new Lastname('竈門'), new Age(15)),
            new Chara(2, new Firstname('禰󠄀豆子'), new Lastname('竈門'), new Age(14)),
            new Chara(3, new Firstname('善逸'), new Lastname('我妻'), new Age(16)),
            new Chara(4, new Firstname('伊之助'), new Lastname('嘴平'), new Age(15)),
            new Chara(5, new Firstname('カナヲ'), new Lastname('栗花落'), new Age(16))
        ];
        return $charas;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id)
    {
        switch ($id) {
            case 1:
                return new Chara($id, new Firstname('炭治郎'), new Lastname('竈門'), new Age(15));
            case 2:
                return new Chara($id, new Firstname('禰󠄀豆子'), new Lastname('竈門'), new Age(14));
            case 3:
                return new Chara($id, new Firstname('善逸'), new Lastname('我妻'), new Age(16));
            case 4:
                return new Chara($id, new Firstname('伊之助'), new Lastname('嘴平'), new Age(15));
            case 5:
                return new Chara($id, new Firstname('カナヲ'), new Lastname('栗花落'), new Age(16));
            default:
                return false;
        }
    }
}