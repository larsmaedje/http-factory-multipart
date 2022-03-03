<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Mime\MimeTypes;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getServiceDependencies(),
        ];
    }

    private function getServiceDependencies(): array
    {
        return [
            'factories' => [
                MimeTypeGuesserInterface::class              => static function (): MimeTypeGuesserInterface {
                    return new SymfonyMimeMimeTypeGuesser(new MimeTypes());
                },
                MultipartStreamFactoryInterface::class       => static function (ContainerInterface $container): MultipartStreamFactoryInterface {
                    return new MutltipartStreamFactory(
                        $container->get(StreamFactoryInterface::class),
                        $container->get(PartOfMultipartStreamFactoryInterface::class)
                    );
                },
                PartOfMultipartStreamFactoryInterface::class => static function (ContainerInterface $container): PartOfMultipartStreamFactoryInterface {
                    return new PartOfMultipartStreamFactory($container->get(MimeTypeGuesserInterface::class));
                },
            ],
        ];
    }
}
