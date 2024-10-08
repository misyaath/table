<?php

namespace App\src\Domain\Tables\Repositories\Command;

use App\src\Domain\Tables\DataTransferObjects\TableStoreDTO;
use App\src\Domain\Tables\Exceptions\TableStoreException;
use App\src\Domain\Tables\Models\Table;

class StoreTables
{

    /**
     * @throws TableStoreException
     */
    public function execute(TableStoreDTO $dto): void
    {
        if (!Table::create([
            'uuid' => $dto->uuid,
            'name' => $dto->name,
            'file' => $dto->file,
            'description' => $dto->description
        ])) {
            throw new TableStoreException('unable to store table');
        };
    }
}
