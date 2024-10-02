<?php

namespace App\src\Domain\Files\Repositories\Command;

use App\src\Domain\Files\Exceptions\SpreadSheetUploadsException;
use Illuminate\Http\UploadedFile;

class UploadFile
{
    /**
     * @throws SpreadSheetUploadsException
     */
    public function execute(UploadedFile $file): string
    {
        $filePath = $file->store('uploads');

        if (!$filePath) {
            throw new SpreadSheetUploadsException('Cannot upload File.');
        }

        return $filePath;
    }
}
