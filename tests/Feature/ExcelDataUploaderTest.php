<?php

namespace Tests\Feature;

use App\src\Domain\Enums\ExcelDataUploadStatus;
use App\src\Domain\Models\ExcelDataUploaderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExcelDataUploaderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */

    public function canUploadExcelFiles()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('data.xlsx', 250000);
        $this->json('post', '/api/v1/excel-data-uploader',
            [
                'file' => $file
            ])->assertStatus(201);

        Storage::disk('local')
            ->assertExists("public/excel-data-uploads/{$file->hashName()}");

        $this->assertDatabaseHas('excel_data_uploader_status', [
            'file_path' => "public/excel-data-uploads/{$file->hashName()}",
            'status' => ExcelDataUploadStatus::UPLOADED->key()
        ]);
    }
}