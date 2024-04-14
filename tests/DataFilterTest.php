<?php

use PHPUnit\Framework\TestCase;
use App\Classes\DataFilter;

class DataFilterTest extends TestCase
{
    public function testFilter()
    {
        $data = [
            ['id' => 1, 'status' => 'authorised'],
            ['id' => 2, 'status' => 'decline'],
            ['id' => 3, 'status' => 'authorised']
        ];

        $filter = new DataFilter($data);
        $filteredData = $filter->filter(['status' => 'authorised']);

        $this->assertCount(2, $filteredData);
    }
}
