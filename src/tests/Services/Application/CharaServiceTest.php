<?php

use PHPUnit\Framework\TestCase;
use app\Models\Domain\Entities\Chara;
use app\Repositories\InMemoryCharaRepository;
use app\Services\Application\CharaService;

class CharaServiceTest extends TestCase
{
    /**
     * @var CharaService $charaService
     */
    protected $charaService;

    /**
     * @var array|array[]
     */
    protected $charaDatas = [];

    protected function setUp(): void
    {
        $repository = new InMemoryCharaRepository;
        $this->charaService = new CharaService($repository);

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
     * キャラ追加に成功
     * @return void
     */
    public function test_store_success()
    {
        $chara = $this->charaDatas[0];
        $result = $this->charaService->store(
            $chara['id'],
            $chara['firstname'],
            $chara['lastname'],
            $chara['age']
        );
        $this->assertEquals(true, $result);
    }

    /**
     * キャラ追加に失敗（同一プライマリーキー）
     * @return void
     */
    public function test_store_failed_exists_same_id()
    {
        $chara1 = $this->charaDatas[0];
        $this->charaService->store(
            $chara1['id'],
            $chara1['firstname'],
            $chara1['lastname'],
            $chara1['age']
        );
        $chara2 = $this->charaDatas[1];
        $result = $this->charaService->store(
            $chara1['id'],
            $chara2['firstname'],
            $chara2['lastname'],
            $chara2['age']
        );
        $this->assertEquals(false, $result);
    }

    /**
     * idによるキャラ取得に成功
     * @return void
     */
    public function test_get_chara_by_id_success()
    {
        $chara = $this->charaDatas[0];
        $this->charaService->store(
            $chara['id'],
            $chara['firstname'],
            $chara['lastname'],
            $chara['age']
        );

        $result = $this->charaService->getCharaById(1);
        $this->assertEquals($chara['id'], $result['id']);
        $this->assertEquals($chara['firstname'], $result['firstname']);
        $this->assertEquals($chara['lastname'], $result['lastname']);
        $this->assertEquals($chara['age'], $result['age']);
    }

    /**
     * idによるキャラ取得に失敗
     * @return void
     */
    public function test_get_chara_by_id_failed_not_exists()
    {
        $chara = $this->charaDatas[0];
        $this->charaService->store(
            $chara['id'],
            $chara['firstname'],
            $chara['lastname'],
            $chara['age']
        );

        $result = $this->charaService->getCharaById(10);
        $this->assertEmpty($result);
    }

    /**
     * キャラ一覧の取得に成功
     * @return void
     */
    public function test_get_charas_success()
    {
        foreach ($this->charaDatas as $chara) {
            $this->charaService->store(
                $chara['id'],
                $chara['firstname'],
                $chara['lastname'],
                $chara['age']
            );
        }

        $characters = $this->charaService->getCharaList();
        $this->assertCount(count($this->charaDatas), $characters);
    }
}