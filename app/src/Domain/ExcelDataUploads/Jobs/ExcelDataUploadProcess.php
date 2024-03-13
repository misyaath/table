<?php

namespace App\src\Domain\ExcelDataUploads\Jobs;

use App\src\Domain\ExcelDataUploads\Models\ExcelDataUploaderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExcelDataUploadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(protected ExcelDataUploaderStatus $dataUploaderStatus)
    {

    }

    public function handle(): void
    {
        echo $this->dataUploaderStatus;
    }
}
