<?php

namespace App\Kafka;

use Illuminate\Queue\Queue;
use \Illuminate\Contracts\Queue\Queue as QueueContract;
use Junges\Kafka\Exceptions\ConsumerException;
use Junges\Kafka\Facades\Kafka;
use RdKafka\Exception;

class KafkaQueue extends Queue implements QueueContract
{

    public function size($queue = null)
    {
        // TODO: Implement size() method.
    }

    /**
     * @throws \Exception
     */
    public function push($job, $data = '', $queue = null): void
    {
        (new KafkaPush($job, $queue, $data))->push();
    }

    public function pushRaw($payload, $queue = null, array $options = [])
    {
        // TODO: Implement pushRaw() method.
    }

    public function later($delay, $job, $data = '', $queue = null)
    {
        // TODO: Implement later() method.
    }

    /**
     * @throws Exception
     * @throws ConsumerException|\Carbon\Exceptions\Exception
     */
    public function pop($queue = null): void
    {
        try {
            var_dump($queue);
            Kafka::consumer()->subscribe([$queue])
                ->withHandler(function ($message) {
                    var_dump($message);
                    if ($message->err === RD_KAFKA_RESP_ERR_NO_ERROR && $message->payload !== null && unserialize($message->payload) !== false) {
                        $payload = unserialize($message->payload);
                        var_dump($payload);
                        $payload->handle();
                    }
                })
                ->build()->consume();

        } catch (\Exception $exception) {
            throw new ConsumerException($exception->getMessage());
        }
    }
}