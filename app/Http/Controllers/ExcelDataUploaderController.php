<?php

namespace App\Http\Controllers;

use App\src\Domain\ExcelDataUploads\Actions\Command\SaveStoreExcelDataFileStatusAction;
use App\src\Domain\ExcelDataUploads\Actions\Command\StoreExcelDataFile;
use App\src\Domain\ExcelDataUploads\Actions\Queries\GetAllExcelUploaderStatuses;
use App\src\Domain\ExcelDataUploads\Requests\ExcelDataFileUploadRequest;
use App\src\Domain\ExcelDataUploads\Resources\ExcelUploaderStatusResources;
use App\src\Domain\Shared\ErrorHTTPResponse;
use App\src\Domain\Shared\SuccessHTTPResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class ExcelDataUploaderController extends Controller
{
    public function index(
        ExcelDataFileUploadRequest         $request,
        StoreExcelDataFile                 $storeExcelDataFile,
        SaveStoreExcelDataFileStatusAction $saveStoreExcelDataFileStatusAction): JsonResponse
    {
        try {
            $saveStoreExcelDataFileStatusAction->execute(
                $storeExcelDataFile->store($request->file('file'))
            );
        } catch (Exception $exception) {
            return (new ErrorHTTPResponse($exception))->response();
        }
        return (new SuccessHTTPResponse([], 201, "Successfully Updated"))->response();
    }

    public function statuses(GetAllExcelUploaderStatuses $statuses): JsonResponse
    {
        try {
            return (new SuccessHTTPResponse(
                ExcelUploaderStatusResources::collection($statuses->query())
                    ->response()->getData(true),
                200))->response();
        } catch (Exception $exception) {
            return (new ErrorHTTPResponse($exception))->response();
        }
    }
}
