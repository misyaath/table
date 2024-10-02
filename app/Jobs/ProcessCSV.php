<?php

namespace App\Jobs;

use App\ElasticSearch\ElasticSearch;
use App\src\Domain\CSV\Applications\CSVHeader;
use App\src\Domain\CSV\Applications\CSVImporter;
use App\src\Domain\CSV\DataTransferObjects\CsvDataDTO;
use App\src\Domain\CSV\Repositories\Command\SaveStoreCsvData;
use App\src\Domain\CSV\Repositories\Command\UpdateCSVProcessStatusAction;
use App\src\Domain\Tables\Models\Table;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Table $table
    )
    {

    }


    public function handle(CSVHeader $csvHeader, ElasticSearch $elasticSearch): void
    {
        UpdateCSVProcessStatusAction::processing($this->table);

        try {
            $rows = (new CSVImporter($this->table, $csvHeader))
                ->csvRead()->getRows();
            (new SaveStoreCsvData($elasticSearch->client()))
                ->execute(new CsvDataDTO($rows, $this->table));
            UpdateCSVProcessStatusAction::processed($this->table);
        } catch (\Throwable $exception) {
            UpdateCSVProcessStatusAction::terminated($this->table);
        }

    }


    public function fail($exception = null): void
    {
        UpdateCSVProcessStatusAction::terminated($this->table);
    }
}
