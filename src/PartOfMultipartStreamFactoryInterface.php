<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Psr\Http\Message\StreamInterface;

interface PartOfMultipartStreamFactoryInterface
{
    /**
     * @param non-empty-string $name
     * @param array<non-empty-string,non-empty-string> $headers
     */
    public function createPartOfMultipart(
        string $name,
        StreamInterface $stream,
        string $filename = '',
        array $headers = []
    ): PartOfMultipartStreamInterface;
}
