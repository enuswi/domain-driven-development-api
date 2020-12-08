<?php
namespace app\Models\Domain\Entities;

use app\Models\Domain\Entities\Chara;

class CharaFactory
{
    public function create(array $param)
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
                $param[Chara::FIRSTNAME],
                $param[Chara::LASTNAME],
                $param[Chara::AGE]
            );
        } catch (\Exception $e) {
            return null;
        }
    }
}