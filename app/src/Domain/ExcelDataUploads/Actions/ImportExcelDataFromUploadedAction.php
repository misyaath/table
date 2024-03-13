<?php

namespace App\src\Domain\ExcelDataUploads\Actions;

use App\src\Domain\SectorFinancialData\Models\SectorFinancialData;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportExcelDataFromUploadedAction implements ToModel, WithBatchInserts, WithValidation
{

    public function model(array $row): ?SectorFinancialData
    {
        if ($row[0] === 'Segment') {
            return null;
        }

        return new SectorFinancialData([
            'uuid' => Str::uuid()->toString(),
            'segment' => $row[0],
            'country' => $row[1],
            'product' => $row[2],
            'discount_band' => $row[3],
            'units_sold' => $row[4],
            'manufacturing_price' => $row[5],
            'sale_price' => $row[6],
            'gross_sale' => $row[7],
            'discounts' => $row[8],
            'sales' => $row[9],
            'cogs' => $row[10],
            'profit' => $row[11],
            'month_number' => $row[13],
            'month_name' => $row[14],
            'year' => $row[15],
        ]);

    }

    public function batchSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [

        ];
    }
}