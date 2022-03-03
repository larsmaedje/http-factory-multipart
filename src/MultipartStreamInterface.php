<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Psr\Http\Message\StreamInterface;

interface MultipartStreamInterface extends StreamInterface
{
    /** @return non-empty-string */
    public function getBoundary(): string;
}
