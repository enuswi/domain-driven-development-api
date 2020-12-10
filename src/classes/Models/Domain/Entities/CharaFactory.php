<?php
namespace app\Models\Domain\Entities;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class CharaFactory
{
    public function factory(array $param)
    {
        try {
            if (!isset($param[Chara::ID]) || !$param[Chara::ID]) {
                throw new \Exception();
            }

            if (!isset($param[Chara::FIRSTNAME]) || !$param[Chara::FIRSTNAME]) {
                throw new \Exception();
            }

            if (!isset($param[Chara::LASTNAME]) || !$param[Chara::LASTNAME]) {
                throw new \Exception();
            }

            if (!isset($param[Chara::AGE]) || !$param[Chara::AGE]) {
                throw new \Exception();
            }

            return new Chara(
                $param[Chara::ID],
                new Firstname($param[Chara::FIRSTNAME]),
                new Lastname($param[Chara::LASTNAME]),
                new Age($param[Chara::AGE])
            );
        } catch (\Exception $e) {
            return null;
        }
    }
}