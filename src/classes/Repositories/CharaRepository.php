<?php
namespace app\Repositories;

class CharaRepository implements ICharaRepository
{
    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id)
    {
        return false;
    }
}