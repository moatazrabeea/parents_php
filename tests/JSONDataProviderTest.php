<?php

use PHPUnit\Framework\TestCase;
use App\Classes\JSONDataProvider;

class JSONDataProviderTest extends TestCase
{
    public function testGetData()
    {
        $provider = new JSONDataProvider('data/DataProviderX.json');
        $data = $provider->getData();

        $this->assertIsArray($data);
    }
}
