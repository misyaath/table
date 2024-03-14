<?php

namespace App\Http\Controllers;

use App\src\Domain\ExcelDataUploads\Actions\Command\SaveStoreExcelDataFileStatusAction;
use App\src\Domain\ExcelDataUploads\Actions\Command\StoreExcelDataFile;
use App\src\Domain\ExcelDataUploads\Requests\ExcelDataFileUploadRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ExcelDataUploaderController extends Controller
{
    public function index(
        ExcelDataFileUploadRequest         $request,
        StoreExcelDataFile                 $storeExcelDataFile,
        SaveStoreExcelDataFileStatusAction $saveStoreExcelDataFileStatusAction): Response|ResponseFactory
    {
        $saveStoreExcelDataFileStatusAction->execute(
            $storeExcelDataFile->store($request->file('file'))
        );
        return response([], 201);
    }

    public function statuses()
    {

    }
}
