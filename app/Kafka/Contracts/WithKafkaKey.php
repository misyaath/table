<?php

namespace App\Kafka\Contracts;

interface WithKafkaKey
{
    public function kafkaKey(): string;
}