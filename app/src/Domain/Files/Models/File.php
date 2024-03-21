<?php

namespace App\src\Domain\Files\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class File extends Model
{
    protected $fillable = [
        'name',
        'uuid',
        'path',
        'file_size'
    ];
}