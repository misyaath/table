<?php

namespace App\src\Domain\SectorFinancialData\Actions\Queries;

use App\src\Domain\SectorFinancialData\Models\SectorFinancialData;

class SectorFinancialDataListAction
{
    public function query()
    {
        return SectorFinancialData::paginate();
    }
}