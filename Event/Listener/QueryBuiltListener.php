<?php

namespace Ict\FormFilterBundle\Event\Listener;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Ict\EasyFormFilterBundle\Event\QueryBuiltEvent;

class QueryBuiltListener
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var book
     */
    protected $manageSessionData;

    /**
     * QueryBuiltListener constructor.
     * @param $session
     */
    public function __construct(SessionInterface $session, $manageSessionData)
    {
        $this->session = $session;
        $this->manageSessionData = $manageSessionData;
    }

    /**
     * @param QueryBuiltEvent $event
     */
    public function onQueryBuilt(QueryBuiltEvent $event){

        if($event->getRequestMethod() == 'POST' && $this->manageSessionData)
        {
            $this->session->set('ict_easy_form_bundle.filter_data', $event->getData());    
        }
    }
}