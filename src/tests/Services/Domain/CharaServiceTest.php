<?php

use PHPUnit\Framework\TestCase;
use app\Services\Domain\CharaService;
use app\Services\Application\CharaService as ApplicationCharaService;
use app\Repositories\InMemoryCharaRepository;

class CharaServiceTest extends TestCase
{
    /**
     * @var CharaService
     */
    protected $charaService;

    /**
     * @var ApplicationCharaService
     */
    protected $applicationCharaService;

    /**
     * @var array|array[]
     */
    protected $charaDatas = [];

    protected function setup(): void
    {
        $repository = new InMemoryCharaRepository;
        $this->charaService = new CharaService($repository);
        $this->applicationCharaService = new ApplicationCharaService($repository);

        $this->charaDatas = [
            ['id' => 1, 'firstname' => '義勇', 'lastname' => '富岡', 'age' => 19],
            ['id' => 2, 'firstname' => 'しのぶ', 'lastname' => '胡蝶', 'age' => 18],
            ['id' => 3, 'firstname' => '杏寿郎', 'lastname' => '煉獄', 'age' => 20],
            ['id' => 4, 'firstname' => '天元', 'lastname' => '宇髄', 'age' => 23],
            ['id' => 5, 'firstname' => '無一郎', 'lastname' => '時透', 'age' => 14],
            ['id' => 6, 'firstname' => '蜜璃', 'lastname' => '甘露寺','age' =>  19],
            ['id' => 7, 'firstname' => '行冥', 'lastname' => '悲鳴嶼','age' =>  27],
            ['id' => 8, 'firstname' => '小芭内', 'lastname' => '伊黒', 'age' => 21],
            ['id' => 9, 'firstname' => '実弥', 'lastname' => '不死川','age' =>  21],
        ];
    }

    /**
     * idが重複している
     * @return void
     */
    public function test_is_exists_true(): void
    {
        $this->applicationCharaService->store(
            id: $this->charaDatas[0]['id'],
            firstname: $this->charaDatas[0]['firstname'],
            lastname: $this->charaDatas[0]['lastname'],
            age: $this->charaDatas[0]['age']
        );
        $this->assertEquals(expected: true, actual: $this->charaService->isExistById(1));
    }

    /**
     * idが重複していない
     * @return void
     */
    public function test_is_exists_false(): void
    {
        $this->applicationCharaService->store(
            id: $this->charaDatas[0]['id'],
            firstname: $this->charaDatas[0]['firstname'],
            lastname: $this->charaDatas[0]['lastname'],
            age: $this->charaDatas[0]['age']
        );
        $this->assertEquals(expected: false, actual: $this->charaService->isExistById(2));
    }
}