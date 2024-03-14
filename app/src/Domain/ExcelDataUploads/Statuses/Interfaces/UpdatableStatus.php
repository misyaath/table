<?php

namespace App\src\Domain\ExcelDataUploads\Statuses\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UpdatableStatus
{
    public function update(Model $model);
}