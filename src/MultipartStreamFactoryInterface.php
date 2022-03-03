<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use InvalidArgumentException;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

interface MultipartStreamFactoryInterface extends StreamFactoryInterface
{
    /**
     * @param non-empty-string $boundary
     * @throws InvalidArgumentException In case that no parts were provided.
     */
    public function createMultipartStream(string $boundary, PartOfMultipartStreamInterface ...$parts): MultipartStreamInterface;

    /**
     * @param non-empty-string $name
     * @param array<non-empty-string,non-empty-string> $headers
     */
    public function createPartOfMultipart(string $name, StreamInterface $stream, string $filename = '', array $headers = []): PartOfMultipartStreamInterface;
}
