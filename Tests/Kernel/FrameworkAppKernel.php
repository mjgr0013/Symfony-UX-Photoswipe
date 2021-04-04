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
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\Photoswipe\ChartjsBundle;
use Symfony\UX\Photoswipe\PhotoswipeBundle;

/**
 * Trait FrameworkAppKernel
 * @package Symfony\UX\Photoswipe\Tests\Kernel
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @internal
 */
class FrameworkAppKernel extends Kernel
{
    use AppKernelTrait;

    public function registerBundles()
    {
        return [new FrameworkBundle(), new PhotoswipeBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', ['secret' => '$ecret', 'test' => true]);
        });
    }
}
