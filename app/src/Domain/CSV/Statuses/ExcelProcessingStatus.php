<?php

namespace App\src\Domain\ExcelDataUploads\Statuses;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use App\src\Domain\ExcelDataUploads\Statuses\Interfaces\UpdatableStatus;
use Illuminate\Database\Eloquent\Model;

class ExcelProcessingStatus implements UpdatableStatus
{

    public function update(Model $model): void
    {
        $model->update([
            'status' => ExcelDataUploadStatus::PROCESSING->key()
        ]);
    }
}