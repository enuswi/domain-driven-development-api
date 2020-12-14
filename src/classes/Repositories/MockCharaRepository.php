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
    protected CharaFactory $charaFactory;

    /**
     * @var array $characters
     */
    protected array $characters;

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
        $this->characters = [
            $this->charaFactory->factory([
                Chara::ID => 1,
                Chara::FIRSTNAME => '炭治郎',
                Chara::LASTNAME => '竈門',
                Chara::AGE => 15
            ]),
            $this->charaFactory->factory([
                Chara::ID => 2,
                Chara::FIRSTNAME => '禰󠄀豆子',
                Chara::LASTNAME => '竈門',
                Chara::AGE => 14
            ]),
            $this->charaFactory->factory([
                Chara::ID => 3,
                Chara::FIRSTNAME => '善逸',
                Chara::LASTNAME => '我妻',
                Chara::AGE => 16
            ]),
            $this->charaFactory->factory([
                Chara::ID => 4,
                Chara::FIRSTNAME => '伊之助',
                Chara::LASTNAME => '嘴平',
                Chara::AGE => 15
            ]),
            $this->charaFactory->factory([
                Chara::ID => 5,
                Chara::FIRSTNAME => 'カナヲ',
                Chara::LASTNAME => '栗花落',
                Chara::AGE => 16
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
            $this->characters = array_merge($this->characters, $chara);
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
        return $this->characters;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Chara|bool
    {
        // 配列のキーに併せる為に、1引く
        $id --;
        if ($id < 0 || count($this->characters) < $id) {
            return false;
        }
        return $this->characters[$id];
    }
}