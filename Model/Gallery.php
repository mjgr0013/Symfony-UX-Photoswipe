<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\Photoswipe\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Gallery
 * @package Symfony\UX\Photoswipe\Model
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @final
 * @experimental
 */
class Gallery
{
    /**
     * @var ArrayCollection $images
     */
    private $images;

    /**
     * @var array|mixed $options
     */
    private $options;

    /**
     * @var string
     */
    private $dataController;

    /**
     * Gallery constructor.
     * @param array $options
     */
    public function __construct($options = [], $dataController = null)
    {
        $this->images = new ArrayCollection();
        $this->options = $options;
        $this->dataController = $dataController;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages(): ArrayCollection
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages(ArrayCollection $images): void
    {
        $this->images = $images;
    }

    /**
     * @param Image $image
     * @return ArrayCollection
     */
    public function addImage(Image $image): ArrayCollection
    {
        $this->images->add($image);
        
        return $this->images;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options): void
    {
        $this->options = $options;
    }

    /**
     * @param string $key
     * @param string $value
     * @return array|mixed
     */
    public function addOption(string $key, string $value)
    {
        $this->options[$key] = $value;

        return $this->options;
    }

    /**
     * @return string
     */
    public function getDataController()
    {
        return $this->dataController;
    }

    /**
     * @param string $dataController
     */
    public function setDataController(string $dataController)
    {
        $this->dataController = $dataController;
    }
}
