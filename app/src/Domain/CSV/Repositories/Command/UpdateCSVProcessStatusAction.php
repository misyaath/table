<?php

namespace App\src\Domain\CSV\Repositories\Command;

use App\src\Domain\CSV\Enums\CSVDataProcessStatus;
use App\src\Domain\Tables\Models\Table;

class UpdateCSVProcessStatusAction
{
    public static function processing(Table $table): void
    {
        CSVDataProcessStatus::PROCESSING->status()->update($table);
    }

    public static function processed(Table $table): void
    {
        CSVDataProcessStatus::PROCESSED->status()->update($table);
    }

    public static function terminated(Table $table): void
    {
        CSVDataProcessStatus::TERMINATED->status()->update($table);
    }
}
