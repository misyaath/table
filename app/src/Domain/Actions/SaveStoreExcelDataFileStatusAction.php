<?php

namespace App\src\Domain\Actions;

use App\src\Domain\Enums\ExcelDataUploadStatus;
use App\src\Domain\Exceptions\ExcelDataFileSaveStatusException;
use App\src\Domain\Models\ExcelDataUploaderStatus;
use Illuminate\Support\Str;

class SaveStoreExcelDataFileStatusAction
{
    public function execute(string $path): void
    {
        if (!ExcelDataUploaderStatus::create([
            'uuid' => Str::uuid()->toString(),
            'file_path' => $path,
            'status' => ExcelDataUploadStatus::UPLOADED->key()
        ])) {
            throw new ExcelDataFileSaveStatusException(500, "Unable to Save uploaded file status");
        }
    }
}