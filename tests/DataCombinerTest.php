<?php

use PHPUnit\Framework\TestCase;
use App\Classes\JSONDataProvider;
use App\Classes\DataCombiner;

class DataCombinerTest extends TestCase
{
    public function testCombineData()
    {
        $providerX = new JSONDataProvider('data/DataProviderX.json');
        $providerY = new JSONDataProvider('data/DataProviderY.json');

        $combiner = new DataCombiner();
        $combiner->addProvider($providerX);
        $combiner->addProvider($providerY);

        $combinedData = $combiner->combineData();

        $this->assertIsArray($combinedData);
    }
}
