<?php

namespace App\src\Domain\CSV\Statuses;

use App\src\Domain\CSV\Enums\CSVDataProcessStatus;
use App\src\Domain\CSV\Statuses\Interfaces\UpdatableStatus;
use Illuminate\Database\Eloquent\Model;

class CSVTerminatedStatus implements UpdatableStatus
{

    public function update(Model $model): void
    {
        $model->update([
            'status' => CSVDataProcessStatus::TERMINATED->key()
        ]);
    }
}
