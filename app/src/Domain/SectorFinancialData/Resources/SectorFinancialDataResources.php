<?php

namespace App\src\Domain\SectorFinancialData\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class SectorFinancialDataResources extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'segment' => $this->segment,
            'country' => $this->country,
            'product' => $this->product,
            'discount_band' => $this->discount_band,
            'units_sold' => $this->units_sold,
            'manufacturing_price' => Number::currency($this->manufacturing_price, 'USD'),
            'sale_price' => Number::currency($this->sale_price),
            'gross_sales' => Number::currency($this->gross_sales),
            'discounts' => Number::currency($this->discounts),
            'sales' => Number::currency($this->sales),
            'cogs' => Number::currency($this->cogs),
            'profit' => Number::currency($this->profit),
            'month_number' => $this->month_number,
            'month_name' => $this->month_name,
            'year' => $this->year,
        ];
    }
}
