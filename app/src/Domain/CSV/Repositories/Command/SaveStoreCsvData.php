<?php

namespace App\src\Domain\CSV\Repositories\Command;

use App\src\Domain\CSV\DataTransferObjects\CsvDataDTO;
use App\src\Domain\ExcelDataUploads\Exceptions\CSVDataFileStoreException;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

class SaveStoreCsvData
{
    public function __construct(protected Client $elasticSearch)
    {
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function execute(CsvDataDTO $data): bool
    {

        $response = $this->elasticSearch->bulk($data->body);

        if ($response->getStatusCode() !== 200) {
            throw new CSVDataFileStoreException($response->getBody()->getContents());
        }
        return $response->asBool();
    }


}
