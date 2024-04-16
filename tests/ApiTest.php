<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetAllUsers()
    {
        $response = $this->sendRequest('/api/v1/users');
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
                "parentAmount" => 150,
                "Currency" => "EUR",
                "parentEmail" => "parent2@parent.eu",
                "statusCode" => 2,
                "registerationDate" => "2019-05-15",
                "parentIdentification" => "e4e4e810-23c8-11e4-8c21-0800200c9a66"
                        ],
            [
                'parentAmount' => 300,
                'Currency' => 'GBP',
                'parentEmail' => 'parent3@parent.eu',
                'statusCode' => 1,
                'registerationDate' => '2020-02-28',
                'parentIdentification' => 'f5f5f920-3456-11e5-8743-0800200c9a66'
            ],
            [
                "balance" => 300,
                "currency" => "AED",
                "email" => "parent4@parent.eu",
                "status" => 100,
                "created_at" => "2021-08-10",
                "id" => "4fc2-a8d1"
            ],
            [
                "balance" => 100,
                "currency" => "USD",
                "email" => "parent5@parent.eu",
                "status" => 200,
                "created_at" => "2022-01-20",
                "id" => "5ab2-b9e2"
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
        $this->assertEquals(200, $response['status']);
        $expectedResults = array_values($expectedResults);
        $actualData = array_values($response['data']);
        $this->assertEquals($expectedResults, $actualData);

    }

    public function testFilterByProvider()
    {
        $response = $this->sendRequest('/api/v1/users?provider=DataProviderX');
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
                        "parentAmount" => 150,
                        "Currency" => "EUR",
                        "parentEmail" => "parent2@parent.eu",
                        "statusCode" => 2,
                        "registerationDate" => "2019-05-15",
                        "parentIdentification" => "e4e4e810-23c8-11e4-8c21-0800200c9a66"
                    ],
                    [
                        'parentAmount' => 300,
                        'Currency' => 'GBP',
                        'parentEmail' => 'parent3@parent.eu',
                        'statusCode' => 1,
                        'registerationDate' => '2020-02-28',
                        'parentIdentification' => 'f5f5f920-3456-11e5-8743-0800200c9a66'
                    ],
            ];
        $this->assertEquals(200, $response['status']);
        $expectedResults = array_values($expectedResults);
        $actualData = array_values($response['data']);
        $this->assertEquals($expectedResults, $actualData);
    }

    public function testFilterByStatusCode()
    {
        $response = $this->sendRequest('/api/v1/users?statusCode=authorised');
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
            ],
            [
                "balance" => 300,
                "currency" => "AED",
                "email" => "parent4@parent.eu",
                "status" => 100,
                "created_at" => "2021-08-10",
                "id" => "4fc2-a8d1"
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
        $this->assertEquals(200, $response['status']);
        $expectedResults = array_values($expectedResults);
        $actualData = array_values($response['data']);
        $this->assertEquals($expectedResults, $actualData);
    }

    private function sendRequest($url)
    {
        $baseUrl = 'http://localhost:8000';
        $ch = curl_init($baseUrl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ['status' => $statusCode, 'data' => json_decode($response, true)];
    }
}
