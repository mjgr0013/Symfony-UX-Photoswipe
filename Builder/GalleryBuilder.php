<?php


namespace Symfony\UX\Photoswipe\Builder;

use Symfony\UX\Photoswipe\Model\Gallery;

/**
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @final
 * @experimental
 */
class GalleryBuilder implements GalleryBuilderInterface
{
    /**
     * @return Gallery
     */
    public function createGallery(): Gallery
    {
        return new Gallery();
    }
}
