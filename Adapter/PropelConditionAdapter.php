<?php

namespace Ict\FormFilterBundle\Adapter;

use Ict\EasyFormFilterBundle\Comparission\Comparision;

class PropelConditionAdapter implements SqlConditionAdapterInterface
{
    /**
     * @var \ModelCriteria
     */
    protected $criteria;

    /**
     * {@inheritdoc}
     */
    public function setQueryObject($queryObject){

        $this->criteria = $queryObject;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryObject(){

        return $this->criteria;
    }

    /**
     * {@inheritdoc}
     */
    public function eq(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), $value, \Criteria::EQUAL);
    }

    /**
     * {@inheritdoc}
     */
    public function gt(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), $value, \Criteria::GREATER_THAN);
    }

    /**
     * {@inheritdoc}
     */
    public function gte(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), $value, \Criteria::GREATER_EQUAL);
    }

    /**
     * {@inheritdoc}
     */
    public function lt(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), $value, \Criteria::LESS_THAN);
    }

    /**
     * {@inheritdoc}
     */
    public function lte(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), $value, \Criteria::GREATER_EQUAL);
    }

    /**
     * {@inheritdoc}
     */
    public function like(Comparision $comp, $value){

        $value = sprintf($comp->getExtra()->get('format')->getOrElse('%%%s%%'), $value);
        $this->criteria->add($comp->getField(), $value, \Criteria::LIKE);
    }

    /**
     * {@inheritdoc}
     */
    public function notLike(Comparision $comp, $value){

        $value = sprintf($comp->getExtra()->get('format')->getOrElse('%%%s%%'), $value);
        $this->criteria->add($comp->getField(),  $value, \Criteria::NOT_LIKE);
    }

    /**
     * {@inheritdoc}
     */
    public function isNull(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), null, \Criteria::ISNULL);
    }

    /**
     * {@inheritdoc}
     */
    public function isNotNull(Comparision $comp, $value){

        $this->criteria->add($comp->getField(), null, \Criteria::ISNOTNULL);
    }

    /**
     * {@inheritdoc}
     */
    public function fromClosure(Comparision $comp, $value){

        call_user_func_array($comp->getExtra()->get('callable')->get(), array($this->criteria, $value));
    }
}