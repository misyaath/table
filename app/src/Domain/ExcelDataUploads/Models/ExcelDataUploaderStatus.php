<?php

namespace App\src\Domain\ExcelDataUploads\Models;

use Database\Factories\ExcelDataUploaderStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
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

    protected static function newFactory(): ExcelDataUploaderStatusFactory
    {
        return ExcelDataUploaderStatusFactory::new();
    }
}