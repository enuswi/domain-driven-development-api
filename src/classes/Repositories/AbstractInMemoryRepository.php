<?php
namespace app\Repositories;

abstract class AbstractInMemoryRepository
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('sqlite::memory:', null, null);
        $this->createTable();
    }

    abstract protected function createTable(): void;
}