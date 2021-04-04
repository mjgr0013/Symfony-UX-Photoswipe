<?php


namespace Symfony\UX\Photoswipe\Builder;

use Symfony\UX\Photoswipe\Model\Gallery;

/**
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @experimental
 */
interface GalleryBuilderInterface
{
    /**
     * @return Gallery
     */
    public function createGallery(): Gallery;
}
