<?php

use PHPUnit\Framework\TestCase;
use app\Repositories\InMemoryCharaRepository;
use app\Services\Application\CharaService;

class CharaServiceTest extends TestCase
{
    /**
     * @var CharaService $charaService
     */
    protected $charaService;

    protected function setUp(): void
    {
        $repository = new InMemoryCharaRepository;
        $this->charaService = new CharaService($repository);
    }

    /**
     * キャラ追加に成功
     * @return void
     */
    public function test_store_success()
    {
        $result = $this->charaService->store(1, '義勇', '富岡', 19);
        $this->assertEquals(true, $result);
    }

    /**
     * キャラ追加に失敗（同一プライマリーキー）
     * @return void
     */
    public function test_store_failed_exists_same_id()
    {
        $this->charaService->store(1, '義勇', '富岡', 19);
        $result = $this->charaService->store(1, 'しのぶ', '胡蝶', 18);
        $this->assertEquals(false, $result);
    }

    /**
     * idによるキャラ取得に成功
     * @return void
     */
    public function test_get_chara_by_id_success()
    {
        $this->charaService->store(1, '義勇', '富岡', 19);
        $chara = $this->charaService->getCharaById(1);
        $this->assertArrayHasKey('id', $chara);
    }

    /**
     * idによるキャラ取得に失敗
     * @return void
     */
    public function test_get_chara_by_id_faield_not_exists()
    {
        $this->charaService->store(1, '義勇', '富岡', 19);
        $chara = $this->charaService->getCharaById(10);
        $this->assertEmpty($chara);
    }

    /**
     * キャラ一覧の取得に成功
     * @return void
     */
    public function test_get_charas_success()
    {
        $this->charaService->store(1, '義勇', '富岡', 19);
        $this->charaService->store(2, 'しのぶ', '胡蝶', 18);
        $this->charaService->store(3, '杏寿郎', '煉獄', 20);
        $this->charaService->store(4, '天元', '宇髄', 23);
        $this->charaService->store(5, '無一郎', '時透', 14);
        $this->charaService->store(6, '蜜璃', '甘露寺', 19);
        $this->charaService->store(7, '行冥', '悲鳴嶼', 27);
        $this->charaService->store(8, '小芭内', '伊黒', 21);
        $this->charaService->store(9, '実弥', '不死川', 21);

        $charas = $this->charaService->getCharaList();
        $this->assertEquals(9, count($charas));
    }
}