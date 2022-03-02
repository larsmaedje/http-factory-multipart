<?php

declare(strict_types=1);

namespace Boesing\Laminas\Diactoros\Multipart;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [];
    }

    public function getServiceDependencies(): array
    {
        return [];
    }
}
