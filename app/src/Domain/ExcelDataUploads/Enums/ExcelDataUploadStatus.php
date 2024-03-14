<?php

namespace App\src\Domain\ExcelDataUploads\Enums;

use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use App\src\Domain\ExcelDataUploads\Statuses\ExcelProcessedStatus;
use App\src\Domain\ExcelDataUploads\Statuses\ExcelProcessingStatus;
use App\src\Domain\ExcelDataUploads\Statuses\ExcelTerminatedStatus;
use App\src\Domain\ExcelDataUploads\Statuses\Interfaces\UpdatableStatus;

enum ExcelDataUploadStatus: string
{
    case UPLOADED = 'uploaded';
    case PROCESSING = 'processing';
    case PROCESSED = 'processed';
    case TERMINATED = 'terminated';

    public function key(): string
    {
        return match ($this) {
            ExcelDataUploadStatus::UPLOADED => 'uploaded',
            ExcelDataUploadStatus::PROCESSED => 'processed',
            ExcelDataUploadStatus::PROCESSING => 'processing',
            ExcelDataUploadStatus::TERMINATED => 'terminated',
        };
    }

    public function name(): string
    {
        return match ($this) {
            ExcelDataUploadStatus::UPLOADED => 'Uploaded',
            ExcelDataUploadStatus::PROCESSED => 'Processed',
            ExcelDataUploadStatus::PROCESSING => 'Processing',
            self::TERMINATED => "Terminated",
        };
    }

    public function status(): UpdatableStatus
    {
        return match ($this) {
            ExcelDataUploadStatus::UPLOADED => '',
            ExcelDataUploadStatus::PROCESSED => new ExcelProcessedStatus(),
            ExcelDataUploadStatus::PROCESSING => new ExcelProcessingStatus(),
            self::TERMINATED => new ExcelTerminatedStatus(),
        };
    }
}
