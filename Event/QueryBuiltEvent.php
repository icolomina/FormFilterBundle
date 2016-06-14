<?php

namespace Ict\FormFilterBundle\Event;

class QueryBuiltEvent
{
    /**
     * @var string
     */
    protected $requestMethod;

    /**
     * @var array
     */
    protected $data;

    /**
     * QueryBuiltEvent constructor.
     * @param $requestMethod
     * @param $data
     */
    public function __construct($requestMethod, array $data)
    {
        $this->requestMethod = $requestMethod;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestMethod
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
    
    
}