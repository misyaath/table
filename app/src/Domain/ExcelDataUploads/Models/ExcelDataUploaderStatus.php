<?php

namespace App\src\Domain\ExcelDataUploads\Models;

use App\src\Domain\ExcelDataUploads\Enums\ExcelDataUploadStatus;
use Database\Factories\ExcelDataUploaderStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static paginate()
 */
class ExcelDataUploaderStatus extends Model
{
    use HasFactory;

    protected $table = 'excel_data_uploader_status';

    protected $fillable = [
        'uuid',
        'file_path',
        'status'
    ];

    protected $casts = [
        'status' => ExcelDataUploadStatus::class,
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected static function newFactory(): ExcelDataUploaderStatusFactory
    {
        return ExcelDataUploaderStatusFactory::new();
    }
}