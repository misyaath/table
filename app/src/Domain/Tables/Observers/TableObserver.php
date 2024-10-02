<?php

namespace App\src\Domain\Tables\Observers;


use App\Jobs\ProcessCSV;
use App\src\Domain\Tables\Models\Table;

class TableObserver
{
    public function created(Table $table): void
    {
        ProcessCSV::dispatch($table);
    }
}
