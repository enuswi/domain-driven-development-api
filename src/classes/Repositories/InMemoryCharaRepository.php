<?php
namespace app\Repositories;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class InMemoryCharaRepository extends AbstractInMemoryRepository implements ICharaRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->insert(1, new Firstname('義勇'), new Lastname('富岡'), new Age(19));
        $this->insert(2, new Firstname('しのぶ'), new Lastname('胡蝶'), new Age(18));
        $this->insert(3, new Firstname('杏寿郎'), new Lastname('煉獄'), new Age(20));
        $this->insert(4, new Firstname('天元'), new Lastname('宇髄'), new Age(23));
        $this->insert(5, new Firstname('無一郎'), new Lastname('時透'), new Age(14));
        $this->insert(6, new Firstname('蜜璃'), new Lastname('甘露寺'), new Age(19));
        $this->insert(7, new Firstname('行冥'), new Lastname('悲鳴嶼'), new Age(27));
        $this->insert(8, new Firstname('小芭内'), new Lastname('伊黒'), new Age(21));
        $this->insert(9, new Firstname('実弥'), new Lastname('不死川'), new Age(21));
    }

    /**
     * キャラテーブル作成
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
     * キャラテーブルへのキャラ作成
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
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        $list = [];
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM Charas');
            $stmt->execute();
            $charas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($charas as $chara) {
                $list[] = new Chara($chara['id'], new Firstname($chara['firstname']), new Lastname($chara['lastname']), new Age($chara['age']));
            }
            return $list;
        } catch (\Exception $e) {
            return $list;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM Charas WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $chara = $stmt->fetch(\PDO::FETCH_ASSOC);
            return new Chara($chara['id'], new Firstname($chara['firstname']), new Lastname($chara['lastname']), new Age($chara['age']));
        } catch (\Exception $e) {
            return null;
        }
    }
}