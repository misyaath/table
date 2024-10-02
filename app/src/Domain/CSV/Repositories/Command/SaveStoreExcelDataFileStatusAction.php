<?php

namespace App\src\Domain\ExcelDataUploads\Actions\Command;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use App\src\Domain\ExcelDataUploads\Exceptions\UnableToReadCSVDataException;
use App\src\Domain\ExcelDataUploads\Jobs\ExcelDataUploadProcess;
use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Illuminate\Support\Str;

class SaveStoreExcelDataFileStatusAction
{
    public function execute(string $path): void
    {
        $status = ExcelDataUploaderStatus::create([
            'uuid' => Str::uuid()->toString(),
            'file_path' => $path,
            'status' => ExcelDataUploadStatus::UPLOADED->key()
        ]);
        if (!$status) {
            throw new UnableToReadCSVDataException(500, "Unable to Save uploaded file status");
        }
        //@TODO It should go to observer
        dispatch(new ExcelDataUploadProcess($status));
    }
}
