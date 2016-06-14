<?php

namespace Ict\FormFilterBundle\Adapter;

use Ict\FormFilterBundle\Comparission\Comparision;

interface ConditionAdapterInterface
{
    /**
     * @param $queryObject
     * @return mixed
     */
    public function setQueryObject($queryObject);

    /**
     * @param $queryObject
     * @return mixed
     */
    public function getQueryObject();

    /**
     * @param Comparision $comp
     * @param $value
     * @return mixed
     */
    public function eq(Comparision $comp, $value);

    /**
     * @param Comparision $comp
     * @param $value
     * @return mixed
     */
    public function gt(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function lt(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function gte(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function lte(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function isNull(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function isNotNull(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @param $callable
     * @return mixed
     */
    public function fromClosure(Comparision $comp, $value);
}