<?php

namespace App\src\Domain\Tables\Controllers;

use App\Http\Controllers\Controller;
use App\src\Domain\Files\Actions\Command\StoreFileDetails;
use App\src\Domain\Files\Actions\Command\UploadFile;
use App\src\Domain\Files\DataTransferObjects\Commands\FilesStoreDTO;
use App\src\Domain\Files\Requests\FileStoreRequest;
use App\src\Domain\Shared\ErrorHTTPResponse;
use App\src\Domain\Shared\SuccessHTTPResponse;
use App\src\Domain\Tables\Actions\Command\StoreTables;
use App\src\Domain\Tables\DataTransferObjects\TableStoreDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function store(
        Request     $request,
        StoreTables $tables
    ): JsonResponse
    {
        try {
            $tables->execute(new TableStoreDTO(
                name: $request->get('name'),
                file: $request->get('file'),
                description: $request->get('description')
            ));

        } catch (\Exception $exception) {
            return (new ErrorHTTPResponse($exception))->response();
        }

        return (new SuccessHTTPResponse([],
            201, 'file uploaded successfully '))->response();
    }
}