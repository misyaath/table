<?php

namespace App\src\Domain\CSV\Applications;

use Illuminate\Support\Str;

class CSVHeader
{
    protected array $header;

    protected array $indexes;

    public function set(array $headers): CSVHeader
    {
        foreach ($headers as $header) {
            $this->header[Str::slug($header, '_')] = $header;
        }

        return $this;
    }

    public function indexes(): array
    {
        return array_keys($this->header);
    }

    public function headers(): array
    {
        return $this->header;
    }
}
