<?php

namespace App\src\Domain\ExcelDataUploads\Console\Commands;

use Carbon\Exceptions\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Junges\Kafka\Facades\Kafka;
use RdKafka\KafkaConsumer;

class PublishExampleKafkaConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-example-kafka-consumer';

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
            Kafka::consumer()
                ->subscribe(['example-topic'])
                ->withConsumerGroupId(Str::uuid()->toString())
                ->withHandler(function ($message) {
                    Log::info($message->body);
                })
                ->beforeConsuming(function () {
                    $this->info("Starting...\n");
                })->afterConsuming(function () {
                    $this->info("Finished...\n");
                })->withErrorCb(function ($exception) {
                    $this->error($exception->getMessage());
                })
                ->withMaxTime(20000)
                ->build()->consume();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
