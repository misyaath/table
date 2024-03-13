<?php

namespace App\Http\Controllers;

use App\src\Domain\Actions\SaveStoreExcelDataFileStatusAction;
use App\src\Domain\Actions\StoreExcelDataFile;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExcelDataUploaderController extends Controller
{
    public function index(
        Request                            $request,
        StoreExcelDataFile                 $storeExcelDataFile,
        SaveStoreExcelDataFileStatusAction $saveStoreExcelDataFileStatusAction): Response|ResponseFactory
    {
        $saveStoreExcelDataFileStatusAction->execute(
            $storeExcelDataFile->store($request->file('file'))
        );
        return response([], 201);
    }
}
