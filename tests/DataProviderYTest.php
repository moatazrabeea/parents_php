<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\DataProviderY;

class DataProviderYTest extends TestCase
{
    private $filePath = __DIR__ . '/../data/DataProviderY.json';

    public function testGetData()
    {
        if (!file_exists($this->filePath)) {
            $this->fail('JSON file does not exist: ' . $this->filePath);
        }

        $dataProvider = new DataProviderY($this->filePath);

        // Test filtering by status code 'authorised' which translates to 100
        $filters = ['statusCode' => 'authorised'];
        $expectedResults = [
            [
                'balance' => 300,
                'currency' => 'AED',
                'email' => 'parent4@parent.eu',
                'status' => 100,
                'created_at' => '2021-08-10',
                'id' => '4fc2-a8d1'
            ],
            [
                "balance" => 250,
                "currency" => "EUR",
                "email" => "parent6@parent.eu",
                "status" => 100,
                "created_at" => "2020-11-05",
                "id" => "6cd3-c0f3"
            ]
        ];
        $actualResults = $dataProvider->getData($filters);
        // Reindex the arrays to ensure sequential keys
        $expectedResults = array_values($expectedResults);
        $actualResults = array_values($actualResults);
        $this->assertEquals($expectedResults, $actualResults);

        // Test filtering by a status code that does not exist in the data
        $filters = ['statusCode' => 'refunded'];
        $expectedResults = [];
        $this->assertEquals($expectedResults, $dataProvider->getData($filters));
    }
}
