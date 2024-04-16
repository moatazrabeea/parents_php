<?php

use PHPUnit\Framework\TestCase;
use App\Classes\DataCombiner;
use App\Classes\DataProviderX;
use App\Classes\DataProviderY;

class DataCombinerTest extends TestCase
{
    public function testCombineData()
    {
        // Mocking data provider X
        $dataProviderX = $this->createMock(DataProviderX::class);
        $dataProviderX->method('getData')
            ->with(['statusCode' => 'authorised'])
            ->willReturn([
                ['id' => 1, 'name' => 'John', 'statusCode' => 1],
                ['id' => 2, 'name' => 'Jane', 'statusCode' => 1],
            ]);

        // Mocking data provider Y
        $dataProviderY = $this->createMock(DataProviderY::class);
        $dataProviderY->method('getData')
            ->with(['statusCode' => 'authorised'])
            ->willReturn([
                ['id' => 3, 'name' => 'Alice', 'status' => 100],
                ['id' => 4, 'name' => 'Bob', 'status' => 100],
            ]);

        // Setting up DataCombiner with mocked providers
        $dataCombiner = new DataCombiner();
        $dataCombiner->addProvider($dataProviderX);
        $dataCombiner->addProvider($dataProviderY);

        // Expected combined data
        $expectedData = [
            ['id' => 1, 'name' => 'John', 'statusCode' => 1],
            ['id' => 2, 'name' => 'Jane', 'statusCode' => 1],
            ['id' => 3, 'name' => 'Alice', 'status' => 100],
            ['id' => 4, 'name' => 'Bob', 'status' => 100],
        ];

        // Testing the combineData method
        $this->assertEquals($expectedData, $dataCombiner->combineData(['statusCode' => 'authorised']));
    }
}
