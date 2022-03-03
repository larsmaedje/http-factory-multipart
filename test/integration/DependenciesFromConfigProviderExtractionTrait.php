<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use PHPUnit\Framework\TestCase;

/**
 * @see TestCase
 *
 * @psalm-require-extends TestCase
 */
trait DependenciesFromConfigProviderExtractionTrait
{
    /**
     * @param callable():array $configProvider
     */
    private function extractDependenciesFromConfigProvider(callable $configProvider): array
    {
        $config = $configProvider();
        self::assertArrayHasKey('dependencies', $config);
        self::assertIsArray($config['dependencies']);

        return $config['dependencies'];
    }
}
