<?php
namespace app\Repositories;

use app\Models\Domain\Entities\Chara;
use app\Models\Domain\Entities\CharaFactory;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class MockCharaRepository implements CharaRepositoryInterface
{
    /**
     * @var CharaFactory $charaFactory
     */
    protected $charaFactory;

    /**
     * @var array $charas
     */
    protected $charas;

    public function __construct()
    {
        $this->charaFactory = new CharaFactory;
        $this->generateMockData();
    }

    /**
     * モックデータの作成
     * @return void
     */
    protected function generateMockData(): void
    {
        $this->charas = [
            $this->charaFactory->factory([
                Chara::ID => 1,
                Chara::FIRSTNAME => new Firstname('炭治郎'),
                Chara::LASTNAME => new Lastname('竈門'),
                Chara::AGE => new Age(15)
            ]),
            $this->charaFactory->factory([
                Chara::ID => 2,
                Chara::FIRSTNAME => new Firstname('禰󠄀豆子'),
                Chara::LASTNAME => new Lastname('竈門'),
                Chara::AGE => new Age(14)
            ]),
            $this->charaFactory->factory([
                Chara::ID => 3,
                Chara::FIRSTNAME => new Firstname('善逸'),
                Chara::LASTNAME => new Lastname('我妻'),
                Chara::AGE => new Age(16)
            ]),
            $this->charaFactory->factory([
                Chara::ID => 4,
                Chara::FIRSTNAME => new Firstname('伊之助'),
                Chara::LASTNAME => new Lastname('嘴平'),
                Chara::AGE => new Age(15)
            ]),
            $this->charaFactory->factory([
                Chara::ID => 5,
                Chara::FIRSTNAME => new Firstname('カナヲ'),
                Chara::LASTNAME => new Lastname('栗花落'),
                Chara::AGE => new Age(16)
            ]),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function store(int $id, Firstname $firstname, Lastname $lastname, Age $age): bool
    {
        try {
            $chara = $this->charaFactory->factory([
                Chara::ID => $id,
                Chara::FIRSTNAME => $firstname,
                Chara::LASTNAME => $lastname,
                Chara::AGE => $age
            ]);
            $this->charas = array_merge($this->charas, $chara);
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
        return $this->charas;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id)
    {
        // 配列のキーに併せる為に、1引く
        $id --;
        if ($id < 0 || count($this->charas) < $id) {
            return false;
        }
        return $this->charas[$id];
    }
}