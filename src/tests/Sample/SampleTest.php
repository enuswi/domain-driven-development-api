<?php

use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    protected function setUp(): void
    {
        //
    }

    /**
     * success sample
     */
    public function testPHPUnit()
    {
        $this->assertArrayHasKey('test', ['test' => 'testVal']);
    }

    /**
     * failed sample
     */
    public function testPHPUnit2()
    {
        $this->assertArrayHasKey('test', ['test2' => 'testVal']);
    }

    /**
     * imcomplete test
     */
    public function testPHPUnit3()
    {
        $this->markTestIncomplete('テスト未実装');
    }

    /**
     * skip test
     */
    public function testPHPUnit4()
    {
        $this->markTestSkipped('テストスキップ');
    }
}