<?php

namespace Tests\Feature\Files;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CanCreateFileTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */

    public function canCreateFile()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('test.xlsx', 2 * 1024 * 1024);
        $this->json('post', '/api/v1/files', [
            'file' => $file,
        ])->assertStatus(201);

        $this->assertDatabaseHas('files', [
            'name' => $file->getFilename(),
            'path' => 'uploads/' . $file->hashName(),
            'file_size'=> $file->getSize()
        ]);
    }
}