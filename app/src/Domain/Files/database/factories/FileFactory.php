<?php

namespace App\src\Domain\Files\database\factories;

use App\src\Domain\Files\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory
{

    protected $model = File::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'name' => $this->faker->name,
            'path' => $this->faker->filePath(),
            'file_size' => $this->faker->numberBetween()
        ];
    }
}