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

        // Extract provider filter if provided
        $providerFilter = isset($filters['provider']) ? 'App\\Classes\\' . $filters['provider'] : null;
        foreach ($this->providers as $provider) {
            if ($providerFilter && $provider instanceof $providerFilter) {
                $results = array_merge($results, $provider->getData($filters));
            }
            elseif (!$providerFilter) {
                $results = array_merge($results, $provider->getData($filters));

            }
        }
        return $results;
    }
}