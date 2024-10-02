<?php

namespace App\src\Domain\ExcelDataUploads\DataTransferObjects;

use Illuminate\Support\Collection;

class ExcelDataDTO
{
    public function __construct(protected Collection $collection)
    {
    }

    public function data(): Collection
    {
        return $this->transferToKeyValueObjects();
    }

    protected function transferToKeyValueObjects(): Collection
    {
       return $this->collection->map(function ($array) {
            dd($array);
        });
    }
}
