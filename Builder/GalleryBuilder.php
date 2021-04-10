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
     * @param array $options
     * @param null|string $dataController
     * @return Gallery
     */
    public function createGallery($options = [], $dataController = null): Gallery
    {
        return new Gallery($options = [], $dataController = null);
    }
}
