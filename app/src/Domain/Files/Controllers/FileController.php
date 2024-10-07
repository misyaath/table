<?php

namespace App\src\Domain\Files\Controllers;

use App\Http\Controllers\Controller;
use App\src\Domain\Files\Repositories\Command\StoreFileDetails;
use App\src\Domain\Files\Repositories\Command\UploadFile;
use App\src\Domain\Files\DataTransferObjects\Commands\FilesStoreDTO;
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
            $dto = new FilesStoreDTO($uploadFile->execute($file), $request->file('file'));
            $storeFileDetails->execute($dto);
        } catch (\Exception $exception) {
            return (new ErrorHTTPResponse($exception,
                'unable to save files please try again'))->response();
        }

        return (new SuccessHTTPResponse(['uuid' => $dto->uuid],
            201, 'file uploaded successfully '))->response();
    }
}
