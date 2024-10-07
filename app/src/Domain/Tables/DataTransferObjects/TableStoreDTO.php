<?php

namespace App\src\Domain\Tables\DataTransferObjects;

use Illuminate\Support\Str;

class TableStoreDTO
{
    public string $uuid;
    public function __construct(
        public string $name,
        public string $file,
        public ?string $description
    )
    {
        $this->uuid = Str::uuid()->toString();
    }
}
