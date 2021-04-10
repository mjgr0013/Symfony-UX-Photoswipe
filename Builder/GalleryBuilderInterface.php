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
     * @param array $options
     * @param null|string $dataController
     * @return Gallery
     */
    public function createGallery($options = [], $dataController = null): Gallery;
}
