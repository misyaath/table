<?php

namespace App\Providers;

use App\Kafka\KafkaConfig;
use App\Kafka\KafkaConnector;
use Illuminate\Support\ServiceProvider;
use RdKafka\Conf;

class KafkaServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $manager = $this->app['queue'];
        $manager->addConnector('kafka', function () {
            return new KafkaConnector(new KafkaConfig(new Conf()));
        });
    }
}