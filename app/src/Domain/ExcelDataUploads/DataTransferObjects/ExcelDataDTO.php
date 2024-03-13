<?php

namespace App\src\Domain\ExcelDataUploads\DataTransferObjects;

use Illuminate\Support\Collection;

class ExcelDataDTO
{
    public function __construct(protected Collection $collection)
    {
    }

    public function data()
    {
        return $this->transferToKeyValueObjects();
    }

    protected function transferToKeyValueObjects()
    {
        $this->collection->map(function ($array) {
            dd($array);
        });
    }
}