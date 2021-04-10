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
use Symfony\Component\DomCrawler\Crawler;
use Symfony\UX\Photoswipe\Builder\ChartBuilderInterface;
use Symfony\UX\Photoswipe\Builder\GalleryBuilderInterface;
use Symfony\UX\Photoswipe\Model\Chart;
use Symfony\UX\Photoswipe\Model\Image;
use Symfony\UX\Photoswipe\Tests\Kernel\TwigAppKernel;
use Twig\Environment;

/**
 * Trait AppKernelTrait
 * @package Symfony\UX\Photoswipe\Tests\Twig
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @internal
 */
class GalleryExtensionTest extends TestCase
{
    public function testRenderGallery()
    {
        $kernel = new TwigAppKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');

        /** @var GalleryBuilderInterface $builder */
        $builder = $container->get('test.photoswipe.builder');

        $gallery = $builder->createGallery();
        $gallery->addOption('bgOpacity', 0.5);

        $images = [
            [
                'href' => "https://unsplash.it/1200/900/?image=200",
                'src' => "https://unsplash.it/400/300/?image=200",
                'data-caption' => "Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>"
            ],
            [
                'href' => "https://unsplash.it/1200/900/?image=300}",
                'src' => "https://unsplash.it/400/300/?image=300",
                'data-caption' => "Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>"
            ]
        ];

        foreach ($images as $image) {
            $gallery->addImage(new Image($image['href'], $image['src'],$image['data-caption']));
        }

        $rendered = $container->get('test.photoswipe.twig_extension')->renderGallery(
            $container->get(Environment::class),
            $gallery
        );
        
        $crawler = new Crawler($rendered);
        
        $this->assertEquals(
            $crawler->filter('figure')->count(),
            2
        );

        $this->assertEquals(
            $crawler->filter('div[data-controller="symfony--ux-photoswipe--gallery"]')->count(),
            1
        );

        $this->assertStringContainsString(
            'symfony--ux-photoswipe--gallery',
            $rendered
        );

        // Rendered with custom dataController, in order to override default behaviour
        $gallery->setDataController('homeController');
        
        $rendered = $container->get('test.photoswipe.twig_extension')->renderGallery(
            $container->get(Environment::class),
            $gallery
        );

        $crawler = new Crawler($rendered);

        $this->assertEquals(
            $crawler->filter('div[data-controller="' . $gallery->getDataController() . ' symfony--ux-photoswipe--gallery"]')->count(),
            1
        );

        $this->assertStringContainsString(
            "{$gallery->getDataController()} symfony--ux-photoswipe--gallery",
            $rendered
        );
    }
}
