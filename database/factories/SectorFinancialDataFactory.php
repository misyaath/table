<?php

namespace Database\Factories;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use App\src\Domain\SectorFinancialData\Models\SectorFinancialData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectorFinancialDataFactory extends Factory
{

    protected $model = SectorFinancialData::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'segment' => $this->faker->name(),
            'country' => $this->faker->country(),
            'product' => $this->faker->sentence(1),
            'discount_band' => $this->faker->word(),
            'units_sold' => $this->faker->numerify(),
            'manufacturing_price' => $this->faker->numerify(),
            'sale_price' => $this->faker->numerify(),
            'gross_sales' => $this->faker->numerify(),
            'discounts' => $this->faker->numerify(),
            'sales' => $this->faker->numerify(),
            'cogs' => $this->faker->numerify(),
            'profit' => $this->faker->numerify(),
            'month_number' => $this->faker->numerify(),
            'month_name' => $this->faker->monthName(),
            'year' => $this->faker->year(),
        ];
    }
}