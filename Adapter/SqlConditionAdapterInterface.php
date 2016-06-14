<?php

namespace Ict\FormFilterBundle\Adapter;

use Ict\EasyFormFilterBundle\Comparission\Comparision;

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