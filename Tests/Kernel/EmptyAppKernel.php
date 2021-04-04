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

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\Photoswipe\PhotoswipeBundle;

/**
 * Trait EmptyAppKernel
 * @package Symfony\UX\Photoswipe\Tests\Kernel
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @internal
 */
class EmptyAppKernel extends Kernel
{
    use AppKernelTrait;

    public function registerBundles()
    {
        return [new PhotoswipeBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}
