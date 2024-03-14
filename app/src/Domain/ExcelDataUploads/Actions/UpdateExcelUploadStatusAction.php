<?php

namespace App\src\Domain\ExcelDataUploads\Actions;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;

class UpdateExcelUploadStatusAction
{
    public static function processing(ExcelDataUploaderStatus $dataUploaderStatus): void
    {
        ExcelDataUploadStatus::PROCESSING->status()->update($dataUploaderStatus);
    }

    public static function processed(ExcelDataUploaderStatus $dataUploaderStatus): void
    {
        ExcelDataUploadStatus::PROCESSED->status()->update($dataUploaderStatus);
    }

    public static function terminated(ExcelDataUploaderStatus $dataUploaderStatus): void
    {
        ExcelDataUploadStatus::TERMINATED->status()->update($dataUploaderStatus);
    }
}