<?php

namespace App\src\Domain\Tables\Models;

use App\src\Domain\Files\Models\File;
use App\src\Domain\Tables\Observers\TableObserver;
use Database\Factories\TableFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(string[] $array)
 * @property mixed $file
 */
#[ObservedBy(TableObserver::class)]
class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'file',
        'description'
    ];

    public function tableFile(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file');
    }

    protected static function newFactory(): TableFactory
    {
        return TableFactory::new();
    }
}
