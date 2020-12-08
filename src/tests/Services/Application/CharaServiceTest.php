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

    public function testGetCharaById_charaExists()
    {
        $chara = $this->charaService->getCharaById(1);
        $this->assertArrayHasKey('id', $chara);
    }

    public function testGetCharaById_CharaNotExists()
    {
        $chara = $this->charaService->getCharaById(10);
        $this->assertEmpty($chara);
    }
}