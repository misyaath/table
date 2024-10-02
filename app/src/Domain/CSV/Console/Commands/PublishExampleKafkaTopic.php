<?php

namespace App\src\Domain\ExcelDataUploads\Console\Commands;

use App\Jobs\PushToKafka;
use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class PublishExampleKafkaTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-example-kafka-topic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $this->info("Starting...\n");
            PushToKafka::dispatch(['test' => 'hello world2!'])
                ->onQueue('example-topic');
            $this->info("Finished...\n");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
