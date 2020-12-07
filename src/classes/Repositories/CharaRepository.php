<?php
namespace app\Repositories;

class CharaRepository implements CharaRepositoryInterface
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