<?php

namespace Tests;
use PHPUnit\Framework\TestCase;
use App\Classes\DataProviderX;


class DataProviderXTest extends TestCase
{
    private $filePath = __DIR__ . '/../data/DataProviderX.json';
    public function testGetData()
    {
        if (!file_exists($this->filePath)) {
            $this->fail('JSON file does not exist: ' . $this->filePath);
        }
        $dataProvider = new DataProviderX($this->filePath);

        // Test filtering by statusCode 'authorised' which translates to 1
        $filters = ['statusCode' => 'authorised'];
        $expectedResults = [
            [
                'parentAmount' => 200,
                'Currency' => 'USD',
                'parentEmail' => 'parent1@parent.eu',
                'statusCode' => 1,
                'registerationDate' => '2018-11-30',
                'parentIdentification' => 'd3d29d70-1d25-11e3-8591-034165a3a613'
            ],
            [
                'parentAmount' => 300,
                'Currency' => 'GBP',
                'parentEmail' => 'parent3@parent.eu',
                'statusCode' => 1,
                'registerationDate' => '2020-02-28',
                'parentIdentification' => 'f5f5f920-3456-11e5-8743-0800200c9a66'
            ]
        ];
        $actualResults = $dataProvider->getData($filters);

        // Reindex the arrays to ensure sequential keys
        $expectedResults = array_values($expectedResults);
        $actualResults = array_values($actualResults);
        $this->assertEquals($expectedResults, $actualResults);

        // Test filtering by a statusCode that does not exist in the data
        $filters = ['statusCode' => 'refunded'];
        $expectedResults = [];
        $this->assertEquals($expectedResults, $dataProvider->getData($filters));
    }

}