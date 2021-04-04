<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\Photoswipe\Tests\Kernel;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\Photoswipe\ChartjsBundle;
use Symfony\UX\Photoswipe\PhotoswipeBundle;

/**
 * Trait TwigAppKernel
 * @package Symfony\UX\Photoswipe\Tests\Kernel
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @internal
 */
class TwigAppKernel extends Kernel
{
    use AppKernelTrait;

    public function registerBundles()
    {
        return [new FrameworkBundle(), new TwigBundle(), new PhotoswipeBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', ['secret' => '$ecret', 'test' => true]);
            $container->loadFromExtension('twig', ['default_path' => __DIR__.'/templates', 'strict_variables' => true, 'exception_controller' => null]);

            $container->setAlias('test.photoswipe.builder', 'photoswipe.builder')->setPublic(true);
            $container->setAlias('test.photoswipe.twig_extension', 'photoswipe.twig_extension')->setPublic(true);
        });
    }
}
