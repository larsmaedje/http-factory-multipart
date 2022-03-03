<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Symfony\Component\Mime\Exception\ExceptionInterface;
use Symfony\Component\Mime\MimeTypesInterface;

use function pathinfo;
use function reset;
use function strpos;

use const PATHINFO_EXTENSION;

/**
 * @internal
 */
final class SymfonyMimeMimeTypeGuesser implements MimeTypeGuesserInterface
{
    /** @var MimeTypesInterface */
    private $mimeTypes;

    public function __construct(MimeTypesInterface $mimeTypes)
    {
        $this->mimeTypes = $mimeTypes;
    }

    public function guessMimeType(string $filename): string
    {
        $mimeTypeFromExtension = $this->detetctMimeTypeFromExtension($filename);
        if ($mimeTypeFromExtension !== '') {
            return $mimeTypeFromExtension;
        }

        if (! $this->mimeTypes->isGuesserSupported()) {
            return '';
        }

        try {
            return $this->mimeTypes->guessMimeType($filename) ?? '';
        } catch (ExceptionInterface $exception) {
            return '';
        }
    }

    private function detetctMimeTypeFromExtension(string $filename): string
    {
        if (strpos($filename, '.') === false) {
            return '';
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension === '') {
            return '';
        }

        $mimeTypes = $this->mimeTypes->getMimeTypes($extension);
        if ($mimeTypes === []) {
            return '';
        }

        return reset($mimeTypes);
    }
}
