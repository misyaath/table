<?php

namespace App\src\Domain\ExcelDataUploads\Actions\Command;

use App\src\Domain\SectorFinancialData\Models\SectorFinancialData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportExcelDataFromUploadedAction implements
    ToModel, WithBatchInserts, WithValidation, WithHeadingRow
{

    public function model(array $row): ?SectorFinancialData
    {
        $row['uuid'] = Str::uuid()->toString();
        return new SectorFinancialData($row);

    }

    public function batchSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'segment' => 'required|string',
            'country' => 'required|string',
            'product' => 'required|string',
            'discount_band' => 'required|string',
            'units_sold' => 'required|decimal:0,4',
            'manufacturing_price' => 'required|decimal:0,4',
            'sale_price' => 'required|decimal:0,4',
            'gross_sales' => 'required|decimal:0,4',
            'discounts' => 'required|decimal:0,4',
            'sales' => 'required|decimal:0,4',
            'cogs' => 'required|decimal:0,4',
            'profit' => 'required|decimal:0,4',
            'month_number' => [
                'required',
                'int',
                Rule::in(range(1, 12))
            ],
            'month_name' => [
                'required',
                'string',
                Rule::in(
                    array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12))
                )
            ],
            'year' => 'required|int',
        ];
    }
}