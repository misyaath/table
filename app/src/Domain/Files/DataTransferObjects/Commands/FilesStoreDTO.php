<?php

namespace App\src\Domain\Files\DataTransferObjects\Commands;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FilesStoreDTO
{

    public string $name;
    public string $path;
    public string $fileSize;
    public string $uuid;

    public function __construct(string $filePath, UploadedFile $file)
    {
        $this->name = $file->getFilename();
        $this->path = $filePath;
        $this->fileSize = $file->getSize();
        $this->uuid = Str::uuid()->toString();
    }
}
