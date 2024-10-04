<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\HasMany;


class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    public function translations(): HasMany
    {
        return $this->hasMany(TagTranslation::class);
    }

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class);
    }
}
