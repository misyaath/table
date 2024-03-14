<?php

namespace App\Http\Controllers;


use App\src\Domain\SectorFinancialData\Actions\Queries\SectorFinancialDataListAction;
use App\src\Domain\SectorFinancialData\Resources\SectorFinancialDataResources;
use App\src\Domain\Shared\ErrorHTTPResponse;
use App\src\Domain\Shared\SuccessHTTPResponse;

class SectorFinancialDataController extends Controller
{
    public function index(SectorFinancialDataListAction $dataListAction): \Illuminate\Http\JsonResponse
    {
        try {
            return (new SuccessHTTPResponse(
                SectorFinancialDataResources::collection($dataListAction->query())
                    ->response()->getData(true),
                200))->response();

        } catch (\Exception $exception) {
            return (new ErrorHTTPResponse($exception))->response();
        }
    }
}
