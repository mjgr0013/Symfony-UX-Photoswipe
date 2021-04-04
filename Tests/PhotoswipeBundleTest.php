<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\Photoswipe\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\Photoswipe\Tests\Kernel\EmptyAppKernel;
use Symfony\UX\Photoswipe\Tests\Kernel\FrameworkAppKernel;
use Symfony\UX\Photoswipe\Tests\Kernel\TwigAppKernel;

/**
 * Trait PhotoswipeBundleTest
 * @package Symfony\UX\Photoswipe\Tests
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @internal
 */
class PhotoswipeBundleTest extends TestCase
{
    public function provideKernels()
    {
        yield 'empty' => [new EmptyAppKernel('test', true)];
        yield 'framework' => [new FrameworkAppKernel('test', true)];
        yield 'twig' => [new TwigAppKernel('test', true)];
    }

    /**
     * @dataProvider provideKernels
     */
    public function testBootKernel(Kernel $kernel)
    {
        $kernel->boot();
        $this->assertArrayHasKey('PhotoswipeBundle', $kernel->getBundles());
    }
}
