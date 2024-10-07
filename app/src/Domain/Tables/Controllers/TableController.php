<?php

namespace App\src\Domain\Tables\Controllers;

use App\Http\Controllers\Controller;
use App\src\Domain\Shared\ErrorHTTPResponse;
use App\src\Domain\Shared\SuccessHTTPResponse;
use App\src\Domain\Tables\Repositories\Command\StoreTables;
use App\src\Domain\Tables\DataTransferObjects\TableStoreDTO;
use App\src\Domain\Tables\Requests\TableStoreRequest;
use Illuminate\Http\JsonResponse;

class TableController extends Controller
{

    public function store(
        TableStoreRequest     $request,
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
            return (new ErrorHTTPResponse($exception,
                'unable to save table please try again'))->response();
        }

        return (new SuccessHTTPResponse([],
            201, 'Table saved successfully'))->response();
    }
}
