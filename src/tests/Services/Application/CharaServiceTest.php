<?php

use PHPUnit\Framework\TestCase;
use app\Repositories\MockCharaRepository;
use app\Services\Application\CharaService;

class CharaServiceTest extends TestCase
{
    /**
     * CharaService $charaService
     */
    protected $charaService;

    protected function setUp(): void
    {
        $repository = new MockCharaRepository;
        $this->charaService = new CharaService($repository);
    }

    public function testGetCharaById_charaExists()
    {
        $chara = $this->charaService->getCharaById(1);
        $this->assertArrayHasKey('id', $chara);
    }

    public function testGetCharaById_CharaNotExists()
    {
        $chara = $this->charaService->getCharaById(6);
        $this->assertEmpty($chara);
    }
}