<?php

namespace App\src\Domain\ExcelDataUploads\Jobs;

use App\src\Domain\ExcelDataUploads\Actions\StoreExcelDataAction;
use App\src\Domain\ExcelDataUploads\Actions\UpdateExcelUploadStatusAction;
use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExcelDataUploadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected ExcelDataUploaderStatus $dataUploaderStatus)
    {

    }

    public function handle(StoreExcelDataAction $storeExcelDataAction): void
    {
        UpdateExcelUploadStatusAction::processing($this->dataUploaderStatus);
        try {
            $storeExcelDataAction->execute($this->dataUploaderStatus);
            UpdateExcelUploadStatusAction::processed($this->dataUploaderStatus);
        } catch (\Exception $exception) {
            UpdateExcelUploadStatusAction::terminated($this->dataUploaderStatus);
            Log::error('Error When Process excel file Error is: ' . $exception->getMessage());
        }
    }
}
