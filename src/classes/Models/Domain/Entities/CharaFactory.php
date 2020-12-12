<?php
namespace app\Models\Domain\Entities;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class CharaFactory
{
    /**
     * @param array $param
     * @return Chara|null
     */
    public function factory(array $param): Chara|null
    {
        try {
            if (!isset($param[Chara::ID]) || !$param[Chara::ID]) {
                throw new \Exception('Chara.id not found.');
            }

            if (!isset($param[Chara::FIRSTNAME]) || !$param[Chara::FIRSTNAME]) {
                throw new \Exception('Chara.firstname not found.');
            }

            if (!isset($param[Chara::LASTNAME]) || !$param[Chara::LASTNAME]) {
                throw new \Exception('Chara.lastname not found.');
            }

            if (!isset($param[Chara::AGE]) || !$param[Chara::AGE]) {
                throw new \Exception('Chara.age not found.');
            }

            return new Chara(
                id: $param[Chara::ID],
                firstname: new Firstname($param[Chara::FIRSTNAME]),
                lastname: new Lastname($param[Chara::LASTNAME]),
                age: new Age($param[Chara::AGE])
            );
        } catch (\Exception $e) {
            return null;
        }
    }
}