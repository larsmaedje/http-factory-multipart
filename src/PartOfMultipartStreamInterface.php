<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Psr\Http\Message\StreamInterface;

interface PartOfMultipartStreamInterface extends StreamInterface
{
    /**
     * Returns the filename of the multipart stream.
     * In case no filename was provided, this method returns an empty string.
     */
    public function getFilename(): string;

    /**
     * @return non-empty-string
     */
    public function getName(): string;

    /**
     * Returns all headers which are passed for the stream.
     * All header names are converted to lowercase.
     *
     * @return array<non-empty-string,non-empty-string>
     */
    public function getHeaders(): array;

    public function getStream(): StreamInterface;
}
