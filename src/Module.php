<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Webmozart\Assert\Assert;

final class Module
{
    public function getConfig(): array
    {
        $config = (new ConfigProvider())();
        Assert::keyExists($config, 'dependencies');
        Assert::isArray($config['dependencies']);
        $dependencies              = $config['dependencies'];
        $config['service_manager'] = $dependencies;
        unset($config['dependencies']);

        return $config;
    }
}
