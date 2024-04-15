<?php

namespace App\Classes;

class DataCombiner
{
    protected $providers = [];

    public function addProvider(DataProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    public function combineData(array $filters): array
    {
        $results = [];
        foreach ($this->providers as $provider) {
            $results = array_merge($results, $provider->getData($filters));
        }
        return $results;
    }
}