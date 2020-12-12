<?php
namespace app\Repositories;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\Entities\CharaFactory;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class InMemoryCharaRepository extends AbstractInMemoryRepository implements CharaRepositoryInterface
{
    /**
     * @var CharaFactory $charaFactory
     */
    protected $charaFactory;

    public function __construct()
    {
        parent::__construct();
        $this->charaFactory = new CharaFactory;
    }

    /**
     * テーブル作成
     * @return void
     */
    protected function createTable(): void
    {
        try {
            $this->pdo->exec('CREATE TABLE Charas (id INTEGER PRIMARY KEY, firstname STRING, lastname STRING, age INTEGER)');
        } catch (\Exception $e) {
            // TODO monolog
        }
    }

    /**
     * レコード作成
     * @param int $id
     * @param Firstname $firstname
     * @param Lastname $lastname
     * @param Age $age
     * @return void
     */
    protected function insert(int $id, Firstname $firstname, Lastname $lastname, Age $age): void
    {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare('INSERT INTO Charas VALUES (?, ?, ?, ?)');

            $stmt->bindValue(1, $id, \PDO::PARAM_INT);
            $stmt->bindValue(2, $firstname->getValue());
            $stmt->bindValue(3, $lastname->getValue());
            $stmt->bindValue(4, $age->getValue(), \PDO::PARAM_INT);

            $stmt->execute();
            $this->pdo->commit();
        } catch (\Exception $e) {
            // TODO monolog
            $this->pdo->rollBack();
            throw $e;
        }
    }

    /**
     * 全件取得
     * @return array
     */
    protected function fetchAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Charas');
        $stmt->execute();
        if ($characters = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
            return $characters;
        }
        return [];
    }

    /**
     * idで指定した１件を取得する
     * @param int $id
     * @return array|null
     */
    protected function fetchById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Charas WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($chara = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $chara;
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function store(int $id, Firstname $firstname, Lastname $lastname, Age $age): bool
    {
        try {
            $this->insert($id, $firstname, $lastname, $age);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        $list = [];
        try {
            $characters = $this->fetchAll();
            foreach ($characters as $chara) {
                $list[] = $this->charaFactory->factory($chara);
            }
            return $list;
        } catch (\Exception $e) {
            return $list;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Chara|bool
    {
        try {
            $chara = $this->fetchById($id);
            if (!$chara) {
                throw new \Exception('Chara not found.');
            }
            return $this->charaFactory->factory($chara);
        } catch (\Exception $e) {
        }
        return false;
    }
}