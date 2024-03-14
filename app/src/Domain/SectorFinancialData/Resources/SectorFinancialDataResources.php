<?php

namespace App\src\Domain\SectorFinancialData\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectorFinancialDataResources extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'segment' => $this->uuid,
            'country' => $this->uuid,
            'product' => $this->uuid,
            'discount_band' => $this->uuid,
            'units_sold' => $this->uuid,
            'manufacturing_price' => $this->uuid,
            'sale_price' => $this->uuid,
            'gross_sales' => $this->uuid,
            'discounts' => $this->uuid,
            'sales' => $this->uuid,
            'cogs' => $this->uuid,
            'profit' => $this->profit,
            'month_number' => $this->uuid,
            'month_name' => $this->uuid,
            'year' => $this->uuid,
        ];
    }
}
