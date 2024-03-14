<?php

namespace App\src\Domain\ExcelDataUploads\Actions\Command;

use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Maatwebsite\Excel\Facades\Excel;

class StoreExcelDataAction
{
    public function execute(ExcelDataUploaderStatus $dataUploaderStatus): void
    {
        Excel::import(new ImportExcelDataFromUploadedAction, $dataUploaderStatus->file_path);
    }
}