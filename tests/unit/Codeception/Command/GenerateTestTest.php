<?php

declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'BaseCommandRunner.php';

class GenerateTestTest extends BaseCommandRunner
{

    protected function _setUp()
    {
        $this->makeCommand(\Codeception\Command\GenerateTest::class);
        $this->config = [
            'actor' => 'HobbitGuy',
            'path' => 'tests/shire',
        ];
    }

    public function testBasic()
    {
        $this->execute(['suite' => 'shire', 'class' => 'HallUnderTheHill']);
        $this->assertSame('tests/shire/HallUnderTheHillTest.php', $this->filename);
        $this->assertStringContainsString('class HallUnderTheHillTest extends \Codeception\Test\Unit', $this->content);
        $this->assertStringContainsString('Test was created in tests/shire/HallUnderTheHillTest.php', $this->output);
        $this->assertStringContainsString('protected function _before()', $this->content);
        $this->assertStringContainsString('protected function _after()', $this->content);
    }

    public function testCreateWithSuffix()
    {
        $this->execute(['suite' => 'shire', 'class' => 'HallUnderTheHillTest']);
        $this->assertSame('tests/shire/HallUnderTheHillTest.php', $this->filename);
        $this->assertStringContainsString('Test was created in tests/shire/HallUnderTheHillTest.php', $this->output);
    }

    public function testCreateWithNamespace()
    {
        $this->execute(['suite' => 'shire', 'class' => 'MiddleEarth\HallUnderTheHillTest']);
        $this->assertSame('tests/shire/MiddleEarth/HallUnderTheHillTest.php', $this->filename);
        $this->assertStringContainsString('namespace MiddleEarth;', $this->content);
        $this->assertStringContainsString('class HallUnderTheHillTest extends \Codeception\Test\Unit', $this->content);
        $this->assertStringContainsString('Test was created in tests/shire/MiddleEarth/HallUnderTheHillTest.php', $this->output);
    }

    public function testCreateWithExtension()
    {
        $this->execute(['suite' => 'shire', 'class' => 'HallUnderTheHillTest.php']);
        $this->assertSame('tests/shire/HallUnderTheHillTest.php', $this->filename);
        $this->assertStringContainsString('class HallUnderTheHillTest extends \Codeception\Test\Unit', $this->content);
        $this->assertStringContainsString('protected $tester;', $this->content);
        $this->assertStringContainsString('@var \HobbitGuy', $this->content);
        $this->assertStringContainsString('Test was created in tests/shire/HallUnderTheHillTest.php', $this->output);
    }

    public function testValidPHP()
    {
        $this->execute(['suite' => 'shire', 'class' => 'HallUnderTheHill']);
        $this->assertIsValidPhp($this->content);
    }
}
