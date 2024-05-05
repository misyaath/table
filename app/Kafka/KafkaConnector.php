<?php

namespace App\Kafka;

use Illuminate\Queue\Connectors\ConnectorInterface;
use RdKafka\KafkaConsumer;
use RdKafka\Producer;

class KafkaConnector implements ConnectorInterface
{
    public function __construct(protected KafkaConfig $config)
    {

    }

    public function connect(array $config): KafkaQueue
    {
        return new KafkaQueue();
    }
}