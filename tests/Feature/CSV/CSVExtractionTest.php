<?php

namespace Tests\Feature\CSV;

use App\ElasticSearch\Config;
use App\ElasticSearch\ElasticSearch;
use App\src\Domain\CSV\Applications\CSVHeader;
use App\src\Domain\CSV\Applications\CSVImporter;
use App\src\Domain\CSV\DataTransferObjects\CsvDataDTO;
use App\src\Domain\CSV\Enums\CSVDataProcessStatus;
use App\src\Domain\CSV\Exceptions\UnableToReadCSVDataException;
use App\src\Domain\CSV\Repositories\Command\SaveStoreCsvData;
use App\src\Domain\Files\Models\File;
use App\src\Domain\Tables\Models\Table;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientInterface;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Feature\CSV\Utils\GenerateCSV;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class CSVExtractionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected function generateCSV(string $path): array
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

        return $csvData;
    }

    /**
     * @test
     * @throws UnableToReadCSVDataException
     */

    public function canExtractCSV()
    {
        $path = storage_path(Str::uuid()->toString() . '.csv');
        $csvData = $this->generateCSV($path);

        $file = File::factory()->create([
            'path' => $path
        ]);

        $table = Table::withoutEvents(function () use ($file) {
            return Table::factory()->create([
                'file' => $file->id,
            ]);
        });

        $rows = (new CSVImporter($table, new CSVHeader()))->csvRead()->getRows();
        foreach ($csvData as $key => $row) {
            $this->assertEquals(array_values($row), array_values($rows[$key]));
        }
    }

    /**
     * @test
     * @throws UnableToReadCSVDataException
     * @throws AuthenticationException
     * @throws Exception
     */

    public function canSaveCSV()
    {
        $path = storage_path(Str::uuid()->toString() . '.csv');
        $this->generateCSV($path);

        $file = File::factory()->create([
            'path' => $path
        ]);

        $table = Table::withoutEvents(function () use ($file) {
            return Table::factory()->create([
                'name' => $this->faker->slug(1),
                'file' => $file->id,
            ]);
        });


        $rows = (new CSVImporter($table, new CSVHeader()))->csvRead()->getRows();
        $response = (new SaveStoreCsvData((new ElasticSearch(new Config()))->client()))
            ->execute(new CsvDataDTO($rows, $table));

        $this->assertTrue($response);

    }
}
