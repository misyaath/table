<?php

namespace App\src\Domain\ExcelDataUploads\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ExcelUploaderStatusResources extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'file_path' => $this->file_path,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->format('M d Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('M d Y'),
        ];
    }
}
