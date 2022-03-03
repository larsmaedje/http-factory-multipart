<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use PHPUnit\Framework\TestCase;

final class ModuleTest extends TestCase
{
    /** @var Module */
    private $module;

    protected function setUp(): void
    {
        parent::setUp();
        $this->module = new Module();
    }

    public function testWillContainSameConfigurationAsConfigProvider(): void
    {
        $config         = $this->module->getConfig();
        $expectedConfig = (new ConfigProvider())();
        self::assertArrayHasKey('dependencies', $expectedConfig);
        self::assertIsArray($expectedConfig['dependencies']);
        $expectedConfig['service_manager'] = $expectedConfig['dependencies'];
        unset($expectedConfig['dependencies']);

        self::assertEquals($expectedConfig, $config);
    }
}
