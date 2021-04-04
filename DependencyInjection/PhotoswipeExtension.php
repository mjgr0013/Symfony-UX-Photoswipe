<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\Photoswipe\DependencyInjection;

use Symfony\UX\Photoswipe\Builder\GalleryBuilder;
use Symfony\UX\Photoswipe\Builder\GalleryBuilderInterface;
use Symfony\UX\Photoswipe\Twig\GalleryExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\UX\Photoswipe\Builder\ChartBuilder;
use Symfony\UX\Photoswipe\Builder\ChartBuilderInterface;
use Symfony\UX\Photoswipe\Twig\ChartExtension;
use Twig\Environment;

/**
 * Class PhotoswipeExtension
 * @package Symfony\UX\Photoswipe\DependencyInjection
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @internal
 */
class PhotoswipeExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->setDefinition('photoswipe.builder', new Definition(GalleryBuilder::class))
            ->setPublic(false)
        ;

        $container
            ->setAlias(GalleryBuilderInterface::class, 'photoswipe.builder')
            ->setPublic(false)
        ;

        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('photoswipe.twig_extension',
                    new Definition(GalleryExtension::class, [new Reference('twig')])
                )
                ->addTag('twig.extension')
                ->setPublic(false)
            ;
        }
    }
}
