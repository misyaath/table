<?php

namespace App\src\Domain\SectorFinancialData\Models;

use Illuminate\Database\Eloquent\Model;

class SectorFinancialData extends Model
{
    protected $table = 'financial_data_by_sectors';
    protected $fillable = [
        'uuid',
        'segment',
        'country',
        'product',
        'discount_band',
        'units_sold',
        'manufacturing_price',
        'sale_price',
        'gross_sale',
        'discounts',
        'sales',
        'cogs',
        'profit',
        'month_number',
        'month_name',
        'year',
    ];
    protected $casts = [
        'date' => 'datetime:m/d/Y'
    ];
}