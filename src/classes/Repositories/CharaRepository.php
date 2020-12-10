<?php
namespace app\Repositories;

use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;
use app\Models\Domain\ValueObjects\Chara\Age;

class CharaRepository implements CharaRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function store(int $id, Firstname $firstname, Lastname $lastname, Age $age): bool
    {
        return false;
    }

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