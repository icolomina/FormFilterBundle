<?php

namespace Ict\FormFilterBundle\Adapter;

use Ict\FormFilterBundle\Comparission\Comparision;

interface SqlConditionAdapterInterface extends ConditionAdapterInterface
{
    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function like(Comparision $comp, $value);

    /**
     * @param $fieldname
     * @param $value
     * @return mixed
     */
    public function notLike(Comparision $comp, $value);
}