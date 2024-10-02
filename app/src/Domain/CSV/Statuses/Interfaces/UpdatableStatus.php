<?php

namespace App\src\Domain\CSV\Statuses\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UpdatableStatus
{
    public function update(Model $model);
}
