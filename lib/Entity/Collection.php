<?php
namespace MovingImage\VideoCollection\Entity;

use MovingImage\VideoCollection\Interfaces\CollectionInterface;
use MovingImage\DataProvider\Interfaces\DataProviderInterface;

/**
 * Class Collection.
 *
 * @author Ruben Knol <ruben.knol@movingimage.com>
 */
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

    /**
     * Collection constructor.
     *
     * @param DataProviderInterface $dataProvider
     * @param string $name
     * @param array $options
     */
    public function __construct(DataProviderInterface $dataProvider, $name, array $options)
    {
        $this->dataProvider = $dataProvider;
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
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
    public function setOption($key, $value)
    {
        if (!array_key_exists($key, $this->options)) {
            throw new \Exception(sprintf('Option \'%s\' does not exist within this collection', $key));
        }

        $this->getOption($key);
        $this->options[$key] = $value;
    }

    /**
     * @return \Generator
     */
    public function generator()
    {
        foreach ($this->dataProvider->getData($this->getOptions()) as $item) {
            yield $item;
        }
    }
}
