<?php

namespace ZoiloMora\ElasticAPM\Utils;

abstract class Collection implements \Iterator, \Countable, \JsonSerializable
{
    /**
     * @var array
     */
    private $items;

    /**
     * @param array $items
     */
    final protected function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return \current($this->items);
    }

    /**
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function next()
    {
        \next($this->items);
    }

    /**
     * @return int|mixed|string|null
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return \key($this->items);
    }

    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function valid()
    {
        return \array_key_exists($this->key(), $this->items);
    }

    /**
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        \reset($this->items);
    }

    /**
     * @return int|void
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return \count($this->items);
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->items;
    }

    /**
     * @param array $items
     *
     * @return static
     */
    public static function from(array $items)
    {
        return new static($items);
    }
}
