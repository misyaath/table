<?php

namespace App\Kafka\Contracts;

interface WithKey
{
    public function getKey(): string;
}