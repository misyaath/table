<?php

namespace App\src\Domain\Shared;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorHTTPResponse
{

    public function __construct(protected Exception $exception, protected string $message = '')
    {
        Log::error($this->exception->getMessage());
    }

    public function response(): JsonResponse
    {
        return new JsonResponse($this->getContent(), $this->getStatusCode());
    }

    private function getContent(): array
    {
        return [
            'status' => 'error',
            'message' => empty($this->message) ? $this->exception->getMessage() : $this->message
        ];
    }

    private function getStatusCode(): int
    {
        if ($this->exception instanceof HttpException) {
            return $this->exception->getStatusCode();
        }

        return 500;
    }
}