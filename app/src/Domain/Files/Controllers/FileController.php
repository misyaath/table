<?php

namespace App\src\Domain\Files\Controllers;

use App\Http\Controllers\Controller;
use App\src\Domain\Files\Actions\Command\StoreFileDetails;
use App\src\Domain\Files\Actions\Command\UploadFile;
use App\src\Domain\Files\DataTransferObjects\Commands\FilesStoreDTO;
use App\src\Domain\Files\Exceptions\SpreadSheetUploadsException;
use App\src\Domain\Files\Requests\FileStoreRequest;
use App\src\Domain\Shared\ErrorHTTPResponse;
use App\src\Domain\Shared\SuccessHTTPResponse;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{

    public function uploadFile(
        FileStoreRequest $request,
        UploadFile       $uploadFile,
        StoreFileDetails $storeFileDetails
    ): JsonResponse
    {
        try {
            $file = $request->file('file');
            $storeFileDetails->execute(
                new FilesStoreDTO($uploadFile->execute($file), $request->file('file'))
            );
        } catch (\Exception $exception) {
            return (new ErrorHTTPResponse($exception))->response();
        }

        return (new SuccessHTTPResponse([],
            201, 'file uploaded successfully '))->response();
    }
}