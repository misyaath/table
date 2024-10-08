<?php

namespace App\src\Domain\Files\Repositories\Command;

use App\src\Domain\Files\DataTransferObjects\Commands\FilesStoreDTO;
use App\src\Domain\Files\Exceptions\FileStoreException;
use App\src\Domain\Files\Models\File;
use Illuminate\Support\Str;

class StoreFileDetails
{
    /**
     * @throws FileStoreException
     */
    public function execute(FilesStoreDTO $DTO): void
    {
        if (!File::create([
            'name' => $DTO->name,
            'uuid' => $DTO->uuid,
            'path' => $DTO->path,
            'file_size' => $DTO->fileSize
        ])) {
            throw new FileStoreException('Unable to store file details ');
        }
    }
}
