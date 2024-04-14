<?php

namespace App\Classes;

class DataCombiner
{
    protected $providers = [];

    public function addProvider(JSONDataProvider $provider)
    {
        $this->providers[] = $provider;
    }

    public function combineData()
    {
        $combinedData = [];

        foreach ($this->providers as $provider) {
            $data = $provider->getData();
            if ($data) {
                $combinedData = array_merge($combinedData, $data);
            }
        }

        return $combinedData;
    }
}