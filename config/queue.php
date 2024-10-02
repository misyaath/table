<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 90,
            'block_for' => null,
            'after_commit' => false,
        ],
        'kafka' => [
            'driver' => 'kafka',
            'queue' => env('KAFKA_QUEUE', 'default'),
            'brokers' => env('KAFKA_BROKERS', 'kafka:9092'),
            'securityProtocol' => env('KAFKA_SECURITY_PROTOCOL', 'PLAINTEXT'),
            'sasl' => [
                'mechanisms' => env('KAFKA_MECHANISMS', 'PLAINTEXT'),
                'username' => env('KAFKA_USERNAME', null),
                'password' => env('KAFKA_PASSWORD', null)
            ],
            'consumer_group_id' => env('KAFKA_CONSUMER_GROUP_ID', 'group'),
            'consumer_timeout_ms' => env("KAFKA_CONSUMER_DEFAULT_TIMEOUT", 20000),
            'offset_reset' => env('KAFKA_OFFSET_RESET', 'latest'),
            'auto_commit' => env('KAFKA_AUTO_COMMIT', true),
            'sleep_on_error' => env('KAFKA_ERROR_SLEEP', 5),
            'partition' => env('KAFKA_PARTITION', 0),
            'compression' => env('KAFKA_COMPRESSION_TYPE', 'snappy'),
            'debug' => env('KAFKA_DEBUG', true),
            'batch_repository' => env('KAFKA_BATCH_REPOSITORY', \Junges\Kafka\BatchRepositories\InMemoryBatchRepository::class),
            'flush_retry_sleep_in_ms' => 100,
            'cache_driver' => env('KAFKA_CACHE_DRIVER', env('CACHE_DRIVER', 'file')),
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Job Batching
    |--------------------------------------------------------------------------
    |
    | The following options configure the database and table that store job
    | batching information. These options can be updated to any database
    | connection and table which has been defined by your application.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];
