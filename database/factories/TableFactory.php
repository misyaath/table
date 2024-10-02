<?php

namespace Database\Factories;

use App\src\Domain\Tables\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
        ];
    }
}
