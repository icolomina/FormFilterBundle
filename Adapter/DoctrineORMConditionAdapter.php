<?php

namespace Ict\FormFilterBundle\Adapter;

use Doctrine\ORM\QueryBuilder;
use Ict\EasyFormFilterBundle\Comparission\Comparision;
use PhpCollection\Map;

class DoctrineORMConditionAdapter implements SqlConditionAdapterInterface
{
    /**
     * @var QueryBuilder
     */
    protected $qb;

    /**
     * {@inheritdoc}
     */
    public function setQueryObject($queryObject){

        $this->qb = $queryObject;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryObject(){

        return $this->qb;
    }

    /**
     * {@inheritdoc}
     */
    public function eq(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->eq($comp->getField(), $comp->getForBindField()));
        $this->qb->setParameter($comp->getNormalizedField(), $value, $this->getPDOParam($comp->getExtra()));
    }

    /**
     * {@inheritdoc}
     */
    public function gt(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->gt($comp->getField(), $comp->getForBindField()));
        $this->qb->setParameter($comp->getNormalizedField(), $value, $this->getPDOParam($comp->getExtra()));
    }

    /**
     * {@inheritdoc}
     */
    public function gte(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->gte($comp->getField(), $comp->getForBindField()));
        $this->qb->setParameter($comp->getNormalizedField(), $value, $this->getPDOParam($comp->getExtra()));
    }

    /**
     * {@inheritdoc}
     */
    public function lt(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->lt($comp->getField(), $comp->getForBindField()));
        $this->qb->setParameter($comp->getNormalizedField(), $value, $this->getPDOParam($comp->getExtra()));
    }

    /**
     * {@inheritdoc}
     */
    public function lte(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->lte($comp->getField(), $comp->getForBindField()));
        $this->qb->setParameter($comp->getNormalizedField(), $value, $this->getPDOParam($comp->getExtra()));
    }

    /**
     * {@inheritdoc}
     */
    public function like(Comparision $comp, $value){

        $value = sprintf($comp->getExtra()->get('format')->getOrElse('%%%s%%'), $value);
        $this->qb->andWhere($this->qb->expr()->like($comp->getField(), $value));
    }

    /**
     * {@inheritdoc}
     */
    public function notLike(Comparision $comp, $value){

        $value = sprintf($comp->getExtra()->get('format')->getOrElse('%%%s%%'), $value);
        $this->qb->andWhere($this->qb->expr()->notLike($comp->getField(), $value));
    }

    /**
     * {@inheritdoc}
     */
    public function isNull(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->isNull($comp->getField()));
    }

    /**
     * {@inheritdoc}
     */
    public function isNotNull(Comparision $comp, $value){

        $this->qb->andWhere($this->qb->expr()->isNotNull($comp->getField()));
    }

    /**
     * {@inheritdoc}
     */
    public function fromClosure(Comparision $comp, $value){

        call_user_func_array($comp->getExtra()->get('callable')->get(), array($this->qb, $value));
    }

    /**
     * @param Map $extra
     * @return int|mixed|void
     */
    protected function getPDOParam(Map $extra){

        return ($extra->containsKey('pdo_param')) ? $extra->get('pdo_param')->get() : \PDO::PARAM_STR;
    }
}