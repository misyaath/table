<?php

namespace App\src\Domain\ExcelDataUploads\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcelUploaderStatusResources extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'file_path' => $this->file_path,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
