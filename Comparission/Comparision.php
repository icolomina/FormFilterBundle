<?php

namespace Ict\FormFilterBundle\Comparission;

use PhpCollection\Map;

class Comparision
{
    /**
     *
     * @var type 
     */
    protected $formField;
    
    /**
     * @var
     */
    protected $field;

    /**
     * @var
     */
    protected $type;

    /**
     * @var
     */
    protected $extra;

    /**
     * 
     * @param type $formField
     * @param type $field
     * @param type $type
     * @param type $extra
     */
    public function __construct($formField, $field, $type, $extra = array())
    {
        $this->formField = $formField;
        $this->field = $field;
        $this->type  = $type;
        $this->extra = new Map($extra);
    }
    
    /**
     * @return mixed
     */
    public function getFormField() {
        
        return $this->formField;
    }

    
    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     *
     */
    public function getNormalizedField(){

        if(strpos($this->field, '.') !== false){
            list($beforeDot, $afterDot) = explode('.', $this->field);
            return $afterDot;
        }

        return $this->field;
    }

    /**
     *
     */
    public function getForBindField(){

        return ':' . $this->getNormalizedField();
    }
    
    /**
     * @param string $formField
     */
    public function setFormField($formField) {
        
        $this->formField = $formField;
    }

    
    /**
     * @param mixed $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param mixed $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     *
     */
    public function resolveExtras(){}

}