<?php

namespace MovingImage\VideoCollection\Interfaces;

use Generator;
use MovingImage\DataProvider\Wrapper\Video;

interface CollectionInterface
{
    /**
     * Get the collection's identifier.
     */
    public function getName(): string;

    /**
     * Set the value for an override attribute option.
     */
    public function setOption(string $key, $value): void;

    /**
     * Retrieve all defined options.
     */
    public function getOptions(): array;

    /**
     * Retrieve the value of a single option.
     *
     * @return mixed
     */
    public function getOption(string $key);

    /**
     * The efficient iterator that holds the actual collection of videos.
     */
    public function generator(): Generator;

    /**
     * Load the entire collection at once, instead of gradually on-iteration.
     */
    public function getAll();

    public function getOne(): Video;

    /**
     * Get the videos count based on all options provided.
     */
    public function getCount(): int;
}
