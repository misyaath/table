<?php

namespace Tests\Feature;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use App\src\Domain\ExcelDataUploads\Jobs\ExcelDataUploadProcess;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExcelDataUploaderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

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

        Queue::assertPushed(ExcelDataUploadProcess::class);
    }

    /**
     * @test
     */

    public function cannotUploadExcelFilesMoreThan250Mb()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('data.xlsx', 300 * 1024);
        $this->json('post', '/api/v1/excel-data-uploader',
            [
                'file' => $file
            ])->assertStatus(422);

        Storage::disk('local')
            ->assertMissing("public/excel-data-uploads/{$file->hashName()}");
    }

    /**
     * @test
     */

    public function cannotUploadExcelFilesShouldBeSpreadsheet()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('data.docs', 200 * 1024);
        $this->json('post', '/api/v1/excel-data-uploader',
            [
                'file' => $file
            ])->assertStatus(422);

        Storage::disk('local')
            ->assertMissing("public/excel-data-uploads/{$file->hashName()}");
    }
}