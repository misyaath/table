<?php

namespace App\Kafka\Contracts;

interface WithHeaders
{
    public function headers(): array;
}