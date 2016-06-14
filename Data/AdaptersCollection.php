<?php

namespace Ict\FormFilterBundle\Data;

use Doctrine\Common\Collections\ArrayCollection;
use Ict\FormFilterBundle\Adapter\ConditionAdapterInterface;

class AdaptersCollection implements \IteratorAggregate
{
    /**
     * @var ArrayCollection
     */
    protected $collection;

    /**
     * AdaptersCollection constructor.
     */
    public function __construct()
    {
        $this->collection = new ArrayCollection();
    }

    /**
     * @param $name
     * @param ConditionAdapterInterface $adapter
     */
    public function setAdapter($name, ConditionAdapterInterface $adapter)
    {
        $this->collection->set($name, $adapter);
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getAdapter($name)
    {
        if(!$this->hasAdapter($name)){
            throw new \InvalidArgumentException(sprintf('Adapter %s does not exists', $name));
        }
        
        return $this->collection->get($name);
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasAdapter($name)
    {
        return $this->collection->containsKey($name);
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return $this->collection->getIterator();
    }
}