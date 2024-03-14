<?php

namespace App\src\Domain\SectorFinancialData\Models;

use Database\Factories\SectorFinancialDataFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate()
 */
class SectorFinancialData extends Model
{
    use HasFactory;

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
        'gross_sales',
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

    protected static function newFactory(): SectorFinancialDataFactory
    {
        return SectorFinancialDataFactory::new();
    }
}