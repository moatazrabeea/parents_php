<?php

namespace App;

use App\Classes\DataCombiner;
use App\Classes\DataFilter;

class UserAPI
{
    protected $dataCombiner;

    public function __construct(DataCombiner $dataCombiner)
    {
        $this->dataCombiner = $dataCombiner;
    }

    public function getUsers($filters)
    {
        $combinedData = $this->dataCombiner->combineData();
        $dataFilter = new DataFilter($combinedData);
        return $dataFilter->filter($filters);
    }
}
