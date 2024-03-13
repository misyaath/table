<?php

namespace App\src\Domain\ExcelDataUploads\Enums;

enum ExcelDataUploadStatus
{
    case UPLOADED;
    case PROCESSING;
    case PROCESSED;

    public function key(): string
    {
        return match ($this) {
            ExcelDataUploadStatus::UPLOADED => 'uploaded',
            ExcelDataUploadStatus::PROCESSED => 'processed',
            ExcelDataUploadStatus::PROCESSING => 'processing',
        };
    }

    public function name(): string
    {
        return match ($this) {
            ExcelDataUploadStatus::UPLOADED => 'Uploaded',
            ExcelDataUploadStatus::PROCESSED => 'Processed',
            ExcelDataUploadStatus::PROCESSING => 'Processing',
        };
    }
}
