<?php

namespace App\src\Domain\CSV\DataTransferObjects;

use App\src\Domain\Tables\Models\Table;

class CsvDataDTO
{
    public array $body = [];

    public function __construct(protected array $rows, protected Table $table)
    {
        $this->setupBody();
    }

    protected function setupBody(): void
    {
        foreach ($this->rows as $row) {
            $this->body['body'][] = [
                'index' => [
                    '_index' => $this->table->name,
                ]
            ];

            $this->body['body'][] = $row;

        }
    }
}
