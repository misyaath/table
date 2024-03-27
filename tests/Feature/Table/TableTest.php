<?php

namespace Tests\Feature\Table;

use App\src\Domain\Files\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */

    public function canCreateTable()
    {
        $file = File::factory()->create();
        $data = [
            'name' => $this->faker->word(),
            'file' => $file->uuid,
            'description' => $this->faker->sentence()
        ];
        $this->json('post', '/api/v1/tables', $data)->assertStatus(201);

        $this->assertDatabaseHas('tables', $data);
    }

    /**
     * @test
     */

    public function cannotCreateTableWithoutRequiredFields()
    {
        $file = File::factory()->create();
        $data = [
            'name' => null,
            'file' => null,
        ];

        $this->json('post', '/api/v1/tables', $data)
            ->assertStatus(422)->assertJsonStructure([
                'errors' => [
                    'name',
                    'file'
                ]
            ]);
    }

    /**
     * @test
     */

    public function fileShouldBeUUID()
    {
        $file = File::factory()->create();
        $data = [
            'name' => $this->faker->word(),
            'file' => 'mnkjn434545',
        ];

        $this->json('post', '/api/v1/tables', $data)
            ->assertStatus(422)->assertJsonStructure([
                'errors' => [
                    'file'
                ]
            ]);
    }
}