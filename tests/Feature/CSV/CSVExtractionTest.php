<?php

namespace Tests\Feature\CSV;

use App\src\Domain\CSV\Applications\CSVImporter;
use App\src\Domain\CSV\Exceptions\UnableToReadCSVDataException;
use App\src\Domain\Files\Models\File;
use App\src\Domain\Tables\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CSVExtractionTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /**
     * @test
     * @throws UnableToReadCSVDataException
     */

    public function canExtractCSV()
    {
        $headers = [
            'Series_reference',
            'Period',
            'Data_value',
            'Suppressed',
            'STATUS',
            'UNITS',
            'Magnitude',
            'Subject',
            'Group',
            'Series_title_1',
            'Series_title_2',
            'Series_title_3',
            'Series_title_4',
            'Series_title_5',

        ];
        $path = storage_path(Str::uuid()->toString() . '.csv');

        $fp = fopen($path, 'w');
        fputcsv($fp, $headers);

        $csvData = [];

        for ($i = 0; $i < 100; $i++) {
            $data = [
                $this->faker()->word(),
                $this->faker()->year() . '.' . $this->faker->month(),
                $this->faker()->numberBetween(10000, 100000),
                $this->faker()->word(),
                $this->faker()->randomLetter(),
                $this->faker()->word(),
                $this->faker()->numberBetween(1, 10),
                $this->faker()->sentence(),
                $this->faker()->word(),
                $this->faker()->word(),
                $this->faker()->word(),
                $this->faker()->word(),
                $this->faker()->word(),
                $this->faker()->word(),
            ];
            $csvData[] = $data;
            fputcsv($fp, $data);
        }

        fclose($fp);

        $file = File::factory()->create([
            'path' => $path
        ]);

        $table = Table::withoutEvents(function () use ($file) {
            return Table::factory()->create([
                'file' => $file->id,
            ]);
        });

        $rows = (new CSVImporter($table))->csvRead()->getRows();
        foreach ($csvData as $key => $row) {
            $this->assertEquals(array_values($row), array_values($rows[$key]));
        }
    }
}
