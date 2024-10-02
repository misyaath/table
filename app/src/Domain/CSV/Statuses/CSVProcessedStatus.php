<?php

namespace App\src\Domain\CSV\Statuses;

use App\src\Domain\CSV\Enums\CSVDataProcessStatus;
use App\src\Domain\CSV\Statuses\Interfaces\UpdatableStatus;
use Illuminate\Database\Eloquent\Model;

class CSVProcessedStatus implements UpdatableStatus
{
    public function update(Model $model): void
    {
        $model->update([
            'status' => CSVDataProcessStatus::PROCESSED->key()
        ]);
    }
}
