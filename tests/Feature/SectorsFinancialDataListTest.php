<?php

namespace Tests\Feature;

use App\src\Domain\SectorFinancialData\Models\SectorFinancialData;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectorsFinancialDataListTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */

    public function canGetListOfSectorFinancialDataList()
    {
        SectorFinancialData::factory()->count(50)->create();

        $this->json('get', '/api/v1/sectors-financial-data')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'uuid',
                        'segment',
                        'country',
                        'product',
                        'discount_band',
                        'units_sold',
                        'manufacturing_price',
                        'sale_price',
                        'gross_sales',
                        'discounts',
                        'sales',
                        'cogs',
                        'profit',
                        'month_number',
                        'month_name',
                        'year',
                    ]
                ],
                'links',
                'meta',
            ]);
    }
}