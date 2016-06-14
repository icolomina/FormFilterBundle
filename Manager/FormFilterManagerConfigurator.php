<?php

namespace Ict\FormFilterBundle\Manager;

use Ict\FormFilterBundle\Data\AdaptersCollection;

class FormFilterManagerConfigurator
{
    /**
     * Adapter name (configured on config.yml)
     * @var string
     */
    protected $adapterName;

    /**
     * Adapters collection
     * @var ArrayCollection
     */
    protected $adapters;

    /**
     * FormFilterManagerConfigurator constructor.
     * @param string $adapterName
     * @param ArrayCollection $adapters
     */
    public function __construct(AdaptersCollection $adapters, $adapterName)
    {
        $this->adapterName = $adapterName;
        $this->adapters = $adapters;
    }

    /**
     * Configures form filter service with current adapter
     * @param FormFilterManager $formFilterManager
     */
    public function configure(FormFilterManager $formFilterManager)
    {
        if(!$this->adapters->hasAdapter($this->adapterName)){
            throw new \InvalidArgumentException(sprintf('Adapter %s does not exists', $this->adapterName));
        }

        $formFilterManager->setAdapter($this->adapters->getAdapter($this->adapterName));
    }
}