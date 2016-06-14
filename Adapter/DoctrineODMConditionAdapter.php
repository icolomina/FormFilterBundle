<?php

namespace Ict\FormFilterBundle\Adapter;

use Doctrine\ODM\MongoDB\Query\Builder;

class DoctrineODMConditionAdapter implements ConditionAdapterInterface
{
    /**
     * @var Builder
     */
    protected $odmQuery;

    /**
     * {@inheritdoc}
     */
    public function setQueryObject($queryObject){

        $this->odmQuery = $queryObject;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryObject(){

        return $this->odmQuery;
    }

    /**
     * {@inheritdoc}
     */
    public function eq(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->equals($value);
    }

    /**
     * {@inheritdoc}
     */
    public function gt(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->gt($value);
    }

    /**
     * {@inheritdoc}
     */
    public function gte(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->gte($value);
    }

    /**
     * {@inheritdoc}
     */
    public function lt(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->lt($value);
    }

    /**
     * {@inheritdoc}
     */
    public function lte(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->lte($value);
    }

    /**
     * {@inheritdoc}
     */
    public function isNull(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->equals(null);
    }

    /**
     * {@inheritdoc}
     */
    public function isNotNull(Comparision $comp, $value){

        $this->odmQuery->field($comp->getField())->notEqual(null);
    }

    /**
     * {@inheritdoc}
     */
    public function fromClosure(Comparision $comp, $value){

        call_user_func_array($comp->getExtra()->get('callable')->get(), array($this->odmQuery, $value));
    }
}