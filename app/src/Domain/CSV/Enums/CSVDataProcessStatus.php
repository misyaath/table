<?php

namespace App\src\Domain\CSV\Enums;

use App\src\Domain\CSV\Statuses\CSVProcessedStatus;
use App\src\Domain\CSV\Statuses\CSVProcessingStatus;
use App\src\Domain\CSV\Statuses\CSVTerminatedStatus;
use App\src\Domain\CSV\Statuses\Interfaces\UpdatableStatus;

enum CSVDataProcessStatus: string
{
    case PROCESSING = 'processing';
    case PROCESSED = 'processed';
    case TERMINATED = 'terminated';

    public function key(): string
    {
        return match ($this) {
            CSVDataProcessStatus::PROCESSED => 'processed',
            CSVDataProcessStatus::PROCESSING => 'processing',
            CSVDataProcessStatus::TERMINATED => 'terminated',
        };
    }

    public function name(): string
    {
        return match ($this) {
            CSVDataProcessStatus::PROCESSED => 'Processed',
            CSVDataProcessStatus::PROCESSING => 'Processing',
            self::TERMINATED => "Terminated",
        };
    }

    public function status(): UpdatableStatus
    {
        return match ($this) {
            CSVDataProcessStatus::PROCESSED => new CSVProcessedStatus(),
            CSVDataProcessStatus::PROCESSING => new CSVProcessingStatus(),
            self::TERMINATED => new CSVTerminatedStatus(),
        };
    }

    public static function statuses(): array
    {
        return [
            CSVDataProcessStatus::PROCESSING->value,
            CSVDataProcessStatus::PROCESSED->value,
            CSVDataProcessStatus::TERMINATED->value,
        ];
    }
}
