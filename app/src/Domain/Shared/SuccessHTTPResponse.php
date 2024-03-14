<?php

namespace App\src\Domain\Shared;

use Illuminate\Http\JsonResponse;

class SuccessHTTPResponse
{
    public function __construct(protected array $data, protected int $status = 200, protected string $message = '')
    {

    }

    public function response(): JsonResponse
    {
        return new JsonResponse(array_merge([
            'status' => 'Success',
            'message' => $this->message,
        ], $this->data), $this->status);
    }
}