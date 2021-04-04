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

/**
 * Class Image
 * @package Symfony\UX\Photoswipe\Model
 * @author Manuel García <mjgr0013@gmail.com>
 *
 * @final
 * @experimental
 */
class Image
{
    /**
     * @var string $href
     */
    private $href;

    /**
     * @var string $src
     */
    private $src;

    /**
     * @var string $dataCaption
     */
    private $dataCaption;

    /**
     * @var int|integer $dataWidth
     */
    private $dataWidth;

    /**
     * @var int|integer $dataHeight
     */
    private $dataHeight;

    /**
     * Image constructor.
     * @param string $href
     * @param string $src
     * @param string $dataCaption
     * @param integer|null $dataWidth
     * @param integer|null $dataHeight
     */
    public function __construct(
        string $href,
        string $src,
        string $dataCaption = '',
        integer $dataWidth = null,
        integer $dataHeight = null
    )
    {
        $this->href = $href;
        $this->src = $src;
        $this->dataCaption = $dataCaption;
        $this->dataWidth = ($dataWidth) ? $dataWidth : 1200;
        $this->dataHeight = ($dataHeight) ? $dataHeight : 700;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref(string $href): void
    {
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @param string $src
     */
    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    /**
     * @return string
     */
    public function getDataCaption(): string
    {
        return $this->dataCaption;
    }

    /**
     * @param string $dataCaption
     */
    public function setDataCaption(string $dataCaption): void
    {
        $this->dataCaption = $dataCaption;
    }

    /**
     * @return int|integer
     */
    public function getDataWidth()
    {
        return $this->dataWidth;
    }

    /**
     * @param int|integer $dataWidth
     */
    public function setDataWidth($dataWidth): void
    {
        $this->dataWidth = $dataWidth;
    }

    /**
     * @return int|integer
     */
    public function getDataHeight()
    {
        return $this->dataHeight;
    }

    /**
     * @param int|integer $dataHeight
     */
    public function setDataHeight($dataHeight): void
    {
        $this->dataHeight = $dataHeight;
    }
}
