<?php
namespace app\Repositories;

abstract class AbstractInMemoryRepository
{
    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('sqlite::memory:', null, null);
        $this->createTable();
    }

    /**
     * テーブル作成
     * @return void
     */
    abstract protected function createTable(): void;
}