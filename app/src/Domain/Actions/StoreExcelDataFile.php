<?php

namespace App\src\Domain\Actions;

use App\src\Domain\Exceptions\ExcelDataFileStoreException;
use Illuminate\Http\UploadedFile;

class StoreExcelDataFile
{
    public function store(UploadedFile $file): string
    {
        if (!($path = $file->store('public/excel-data-uploads'))) {
            throw new ExcelDataFileStoreException(500,
                "Unable Store SpreadSheet Please Try Again");
        }

        return $path;
    }
}