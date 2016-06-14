<?php

namespace Ict\FormFilterBundle\Manager;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FormFilterDataManager
{
    /**
     * @var SessionInterface
     */
    protected $session;
    
    /**
     * @var bool
     */
    protected $manageSessionData;

    /**
     * FormFilterDataManager constructor.
     * @param SessionInterface $session
     * @param $manageSessionData
     */
    public function __construct(SessionInterface $session, $manageSessionData)
    {
        $this->session = $session;
        $this->manageSessionData = $manageSessionData;
    }

    /**
     * @param Form $form Data form
     * @param string $method Request method
     * @param int|bool $page Page number
     * @return array
     */
    public function getData(Form $form, $method, $page)
    {
        if($this->manageSessionData) 
        {
            $data = ($method == 'GET' && is_numeric($page) && $this->session->has('ict_easy_form_bundle.filter_data')) 
                ? $this->session->get('ict_easy_form_bundle.filter_data')
                : $form->getData()
            ;

            if(!is_numeric($page))
            {
                $this->session->remove('ict_easy_form_bundle.filter_data');
            }
        }
        else
        {
            $data = $form->getData();
        }
        
        return $data;
    }
}