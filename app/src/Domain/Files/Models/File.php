<?php

namespace App\src\Domain\Files\Models;

use App\src\Domain\Files\database\factories\FileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uuid',
        'path',
        'file_size'
    ];

    protected static function newFactory(): FileFactory
    {
        return FileFactory::new();
    }
}