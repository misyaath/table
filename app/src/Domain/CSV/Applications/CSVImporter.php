<?php

namespace App\src\Domain\CSV\Applications;

use App\src\Domain\CSV\Exceptions\UnableToReadCSVDataException;
use App\src\Domain\Tables\Models\Table;

class CSVImporter
{
    protected $stream;
    protected array $header;
    protected array $rows;

    public function __construct(protected Table $table)
    {
        $this->stream = fopen($this->table->tableFile->path, "r");
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @throws UnableToReadCSVDataException
     */
    public function csvRead(): CSVImporter
    {
        $row = 0;

        $this->throwErrorWhenCantAbleToReadFile();

        while (($data = fgetcsv($this->stream, 0, ',')) !== false) {

            $this->setupData($row, $data);

            if ($this->isReachedLimit($row)) {
                break;
            }

            $row++;
        }
        fclose($this->stream);

        return $this;
    }

    public function setupData(int $row, bool|array $data): void
    {
        if (0 == $row) {
            $this->header = $data;
        } else {
            $this->rows[] = array_combine($this->header, $data);
        }
    }

    public function isReachedLimit(int $row): bool
    {
        return $row === config('csv.import.limit', 100);
    }

    /**
     * @throws UnableToReadCSVDataException
     */
    public function throwErrorWhenCantAbleToReadFile(): void
    {
        if ($this->stream === false) {
            throw new UnableToReadCSVDataException("Unable to read CSV data " . $this->table->file->path);
        }
    }
}
