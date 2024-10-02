<?php

namespace App\src\Domain\ExcelDataUploads\Actions\Queries;

use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Illuminate\Database\Eloquent\Collection;

class GetAllExcelUploaderStatuses
{
    public function query()
    {
        return ExcelDataUploaderStatus::paginate();
    }
}