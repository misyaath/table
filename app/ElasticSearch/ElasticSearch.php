<?php

namespace App\ElasticSearch;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;

class ElasticSearch
{

    protected ClientBuilder $client;

    public function __construct(protected Config $config)
    {
        $this->client = ClientBuilder::create()
            ->setHosts([$this->config->host()])
            ->setBasicAuthentication(
                $this->config->username(),
                $this->config->password()
            )->setCABundle($this->config->certificate());
    }

    /**
     * @throws AuthenticationException
     */
    public function client(): Client
    {
        return $this->client->build();
    }
}
