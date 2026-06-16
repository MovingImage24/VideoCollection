<?php

declare(strict_types=1);

namespace MovingImage\VideoCollection\Entity;

use Generator;
use MovingImage\DataProvider\Wrapper\Video;
use MovingImage\VideoCollection\Interfaces\CollectionInterface;
use MovingImage\DataProvider\Interfaces\DataProviderInterface;

class Collection implements CollectionInterface
{
    public function __construct(
        private readonly DataProviderInterface $dataProvider,
        private readonly string $name,
        private array $options,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $key): mixed
    {
        if (!array_key_exists($key, $this->options)) {
            throw new \Exception(sprintf('Option \'%s\' does not exist within this collection', $key));
        }

        return $this->options[$key];
    }

    public function setOption(string $key, mixed $value): void
    {
        $this->options[$key] = $value;
    }

    public function generator(): Generator
    {
        yield from $this->dataProvider->getAll($this->getOptions());
    }

    public function getOne(): Video
    {
        if (!array_key_exists('player_id', $this->options)) {
            throw new \Exception('Cannot call \'getOne()\' if option \'player_id\' is not set.');
        }

        return $this->dataProvider->getOne($this->getOptions());
    }

    public function getAll(): array
    {
        return $this->dataProvider->getAll($this->getOptions());
    }

    public function getCount(): int
    {
        return $this->dataProvider->getCount($this->getOptions());
    }
}
