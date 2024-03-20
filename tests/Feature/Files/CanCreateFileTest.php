<?php

namespace Tests\Feature\Files;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\RefreshDatabase;
use Tests\TestCase;

class CanCreateFileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */

    public function canCreateFile()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('test.xlsx', 2 * 1024 * 1024);
        $this->json('post', '/api/v1/files', [
            'file' => $file,
        ]);

        $this->assertDatabaseHas('files', [
            'name' => 'test.xlsx',
            'path' => '/private/files/' . $file->hashName()
        ]);
    }
}