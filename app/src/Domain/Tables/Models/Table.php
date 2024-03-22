<?php

namespace App\src\Domain\Tables\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $array)
 */
class Table extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'file',
        'description'
    ];
}