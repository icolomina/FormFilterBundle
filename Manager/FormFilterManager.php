<?php

namespace Ict\FormFilterBundle\Manager;

use Ict\FormFilterBundle\Event\QueryBuiltEvent;
use Ict\FormFilterBundle\Adapter\ConditionAdapterInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class FormFilterManager
{
    /**
     * @var ConditionAdapterInterface
     */
    protected $adapter;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var FormFilterDataManager
     */
    protected $formFilterDataManager;

    /**
     * FormFilterManager constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param FormFilterDataManager $formFilterDataManager
     */
    public function __construct(EventDispatcherInterface $dispatcher, FormFilterDataManager $formFilterDataManager)
    {
        $this->dispatcher = $dispatcher;
        $this->formFilterDataManager = $formFilterDataManager;
    }


    /**
     * @param ConditionAdapterInterface $adapter
     */
    public function setAdapter(ConditionAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    
    /**
     * 
     * @return type
     */
    public function getAdapter(){
        
        return $this->adapter;
    }

    /**
     * Build query with filters
     *
     * @param Request $request Request
     * @param Form $form Form with data
     */
    public function build(Request $request, Form $form){

        $data = $this->formFilterDataManager->getData($form, $request->getMethod(), $request->query->get('page', false));
        $filters = $form->getConfig()->getOption('filters');

        while($filters->valid()){

            $comparision = $filters->current();
            if($data->containsKey($comparision->getFormField())){

                if(!method_exists($this->adapter, $comparision->getType())){
                    throw new \InvalidArgumentException(sprintf('%s comparision does no exists', $comparision->getType()));
                }

                call_user_func_array(
                    array($this->adapter, $comparision->getType()),
                    array($comparision, $data->get($comparision->getFormField()))
                );
            }

            $filters->next();

        }

        $this->dispatcher->dispatch('ict_form_filter_bundle.query_built', new QueryBuiltEvent($request->getMethod(), $data));

    }

    /**
     * @return \ModelCriteria
     */
    public function getQueryObject()
    {
        return $this->adapter->getQueryObject();
    }


}