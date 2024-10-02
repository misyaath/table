<?php

namespace App\src\Domain\Files\Actions\Command;

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
            'uuid' => Str::uuid()->toString(),
            'path' => $DTO->path,
            'file_size' => $DTO->fileSize
        ])) {
            throw new FileStoreException('Unable to store file details ');
        }
    }
}