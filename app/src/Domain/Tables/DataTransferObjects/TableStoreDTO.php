<?php

namespace App\src\Domain\Tables\DataTransferObjects;

class TableStoreDTO
{
    public function __construct(
        public string $name,
        public string $file,
        public ?string $description
    )
    {
    }
}