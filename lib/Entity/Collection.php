<?php

declare(strict_types=1);

namespace MovingImage\VideoCollection\Entity;

use Generator;
use MovingImage\DataProvider\Wrapper\Video;
use MovingImage\VideoCollection\Interfaces\CollectionInterface;
use MovingImage\DataProvider\Interfaces\DataProviderInterface;

class Collection implements CollectionInterface
{
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $options;

    public function __construct(DataProviderInterface $dataProvider, string $name, array $options)
    {
        $this->dataProvider = $dataProvider;
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($key)
    {
        if (!array_key_exists($key, $this->options)) {
            throw new \Exception(sprintf('Option \'%s\' does not exist within this collection', $key));
        }

        return $this->options[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(string $key, $value): void
    {
        $this->options[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function generator(): Generator
    {
        foreach ($this->dataProvider->getAll($this->getOptions()) as $item) {
            yield $item;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOne(): Video
    {
        if (!array_key_exists('player_id', $this->options)) {
            throw new \Exception('Cannot call \'getOne()\' if option \'player_id\' is not set.');
        }

        return $this->dataProvider->getOne($this->getOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->dataProvider->getAll($this->getOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function getCount(): int
    {
        return $this->dataProvider->getCount($this->getOptions());
    }
}
