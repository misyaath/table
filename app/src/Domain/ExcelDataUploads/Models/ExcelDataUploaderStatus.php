<?php

namespace App\src\Domain\ExcelDataUploads\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ExcelDataUploaderStatus extends Model
{
    protected $table = 'excel_data_uploader_status';

    protected $fillable = [
        'uuid',
        'file_path',
        'status'
    ];
}