<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

/**
 * @internal
 */
interface MimeTypeGuesserInterface
{
    /**
     * Guesses a mime-type based on the provided filename.
     * Returns an empty string in case no mime-type could be detected.
     *
     * @param non-empty-string $filename
     */
    public function guessMimeType(string $filename): string;
}
