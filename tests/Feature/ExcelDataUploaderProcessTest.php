<?php

namespace Feature;

use App\src\Domain\ExcelDataUploads\Actions\ImportExcelDataFromUploadedAction;
use App\src\Domain\ExcelDataUploads\DataTransferObjects\ExcelDataDTO;
use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExcelDataUploaderProcessTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */

    public function canAbleToProcessQueuedSpreadsheet()
    {
        $status = ExcelDataUploaderStatus::factory()->create([
            'file_path' => 'tests/Feature/Data/financial_sample.xlsx'
        ]);

        Excel::import(new ImportExcelDataFromUploadedAction, $status->file_path);
        $data = Excel::toArray(new ImportExcelDataFromUploadedAction, $status->file_path);
        unset($data[0][0]);

        $this->assertDatabaseCount('financial_data_by_sectors', count($data[0]));

    }
}