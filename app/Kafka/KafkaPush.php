<?php

namespace App\Kafka;

use App\Kafka\Contracts\WithHeaders;
use App\Kafka\Contracts\WithKafkaKey;
use App\Kafka\Contracts\WithKey;
use Exception;
use Junges\Kafka\Contracts\MessageProducer;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaPush
{
    protected MessageProducer $kafka;

    public function __construct(protected object $queue, protected string $topic, protected array|string $data)
    {
        $this->kafka = Kafka::publish()->onTopic($this->topic);
    }

    /**
     * @throws Exception
     */
    public function push(): void
    {
        try {
            $this->setHeader();
            $this->setKafkaKey();
            $this->setBodyKey();
            $this->kafka->send(true);
        } catch (Exception $exception) {
            if (method_exists($this->queue, 'errorHandler')) {
                $this->queue->errorHandler($exception);
            } else {
                throw $exception;
            }

        }
    }


    private function setHeader(): void
    {
        if ($this->queue instanceof WithHeaders) {
            $this->kafka->withHeaders($this->queue->headers());
        }
    }

    private function setKafkaKey(): void
    {
        if ($this->queue instanceof WithKafkaKey) {
            $this->kafka->withKafkaKey($this->queue->getKafkaKey());
        }
    }

    private function setBodyKey(): void
    {
        if ($this->queue instanceof WithKey) {
            $this->kafka->withBodyKey($this->queue->getKey(), serialize($this->queue));
        } else {
            $this->kafka->withMessage(new Message(body: serialize($this->queue)));
        }
    }
}