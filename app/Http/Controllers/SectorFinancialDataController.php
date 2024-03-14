<?php

namespace App\Http\Controllers;

use App\src\Domain\SectorFinancialData\Actions\Queries\SectorFinancialDataListAction;
use App\src\Domain\SectorFinancialData\Resources\SectorFinancialDataResources;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SectorFinancialDataController extends Controller
{
    public function index(SectorFinancialDataListAction $dataListAction): Response|ResponseFactory
    {
        return response(SectorFinancialDataResources::collection($dataListAction->query())
            ->response()->getData(true));
    }
}
