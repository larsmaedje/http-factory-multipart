<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Generator;
use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

use function array_keys;
use function array_replace_recursive;
use function class_exists;
use function interface_exists;

final class ConfigProviderIntegrationTest extends TestCase
{
    use DependenciesFromConfigProviderExtractionTrait;

    /** @var ConfigProvider */
    private $configProvider;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configProvider = new ConfigProvider();
    }

    /**
     * @return Generator<non-empty-string, array{0: ContainerInterface, 1: non-empty-list<string>}>
     */
    public function containerProvider(): Generator
    {
        $dependencies = $this->extractDependenciesFromConfigProvider(new ConfigProvider());
        $serviceNames = $this->extractServiceNamesFromDependencyConfiguration($dependencies);

        $dependencies = array_replace_recursive((new \Laminas\Diactoros\ConfigProvider())->getDependencies(), $dependencies);

        yield ServiceManager::class => [
            new ServiceManager($dependencies),
            $serviceNames,
        ];
    }

    /**
     * @psalm-param non-empty-list<string> $services
     * @dataProvider containerProvider
     */
    public function testDependenciesCanBeResolvedByContainer(ContainerInterface $container, array $services): void
    {
        foreach ($services as $service) {
            self::assertTrue(class_exists($service) || interface_exists($service));
            self::assertInstanceOf($service, $container->get($service));
        }
    }

    /**
     * @param array $dependencies
     * @psalm-return non-empty-list<string>
     * @psalm-suppress MixedReturnTypeCoercion We do explicitly assert stuff with phpunit and thus we can suppress here
     */
    private function extractServiceNamesFromDependencyConfiguration(array $dependencies): array
    {
        $factories = $dependencies['factories'] ?? [];
        self::assertIsArray($factories);
        $serviceNames = array_keys($factories);
        self::assertNotEmpty($serviceNames);
        foreach ($serviceNames as $serviceName) {
            self::assertIsString($serviceName);
        }

        /** @psalm-suppress MixedReturnTypeCoercion We do explicitly assert stuff with phpunit and thus we can suppress here */
        return $serviceNames;
    }
}
