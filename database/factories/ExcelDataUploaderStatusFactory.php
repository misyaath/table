<?php

namespace Database\Factories;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExcelDataUploaderStatusFactory extends Factory
{

    protected $model = ExcelDataUploaderStatus::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'status' => ExcelDataUploadStatus::UPLOADED->key()
        ];
    }
}