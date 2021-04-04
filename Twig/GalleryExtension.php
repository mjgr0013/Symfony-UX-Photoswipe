<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\Photoswipe\Twig;

use Symfony\UX\Photoswipe\Model\Chart;
use Symfony\UX\Photoswipe\Model\Gallery;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Template;
use Twig\TwigFunction;

/**
 * Class GalleryExtension
 * @package Symfony\UX\Photoswipe\Twig
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @final
 * @experimental
 */
class GalleryExtension extends AbstractExtension
{
    /**
     * @var Environment $template
     */
    private $template;

    /**
     * GalleryExtension constructor.
     * @param Environment $template
     */
    public function __construct(Environment $template)
    {
        $this->template = $template;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_gallery', [$this, 'renderGallery'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * @param Environment $env
     * @param Gallery $gallery
     * @param array $attributes
     * @return string
     */
    public function renderGallery(Environment $env, Gallery $gallery, array $attributes = []): string
    {
        /** @var FilesystemLoader $loader */
        $loader = $env->getLoader();
        
        $loader->addPath(__DIR__ . '/../Resources/templates');
        
        return $this->template->render('gallery.html.twig', [
            'gallery' => $gallery
        ]);
    }

}
