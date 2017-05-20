<?php

namespace MovingImage\VideoCollection\Interfaces;

use MovingImage\DataProvider\Wrapper\Video;

/**
 * Interface CollectionInterface.
 *
 * @author Ruben Knol <ruben.knol@movingimage.com>
 */
interface CollectionInterface
{
    /**
     * Get the collection's identifier.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the value for an override attribute option.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function setOption($key, $value);

    /**
     * Retrieve all defined options.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Retrieve the value of a single option.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getOption($key);

    /**
     * The efficient iterator that holds the actual collection of videos.
     *
     * @return \Generator
     */
    public function generator();

    /**
     * Load the entire collection at once, instead of gradually on-iteration.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * @return Video
     */
    public function getOne();

    /**
     * Get the videos count based on all options provided.
     *
     * @return int
     */
    public function getCount();
}
